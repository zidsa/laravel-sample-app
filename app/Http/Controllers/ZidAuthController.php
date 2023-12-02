<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ZidAuthController extends Controller
{
    const OAUTH_URL = 'https://oauth.zid.sa/';

    public function redirectToZid()
    {
        $queries = http_build_query([
            'client_id' => env('ZID_CLIENT_ID'),
            'redirect_uri' => env('APP_URL') . "/auth/zid/callback",
            'response_type' => 'code'
        ]);
        return redirect('https://oauth.zid.sa' . '/oauth/authorize?' . $queries);
    }

    public function callbackFromZid(Request $request)
    {
        // zid will redirect the user to your application again and send you `code` in the query parameters
        $zidCode = $request->get('code');

        // from this code you must retrieve the merchant tokens to use them in your further requests
        $merchantTokens = self::getTokensFromZidByCode($zidCode);


        $managerToken = $merchantTokens['access_token'];
        $authToken = $merchantTokens['authorization'];
        $refreshToken = $merchantTokens['refresh_token'];

        // Check if the user already exists in the database
        $user = User::query()->where('zid-manager-token', $managerToken)->first();

        if (!$user) {
            // create a new user.
        }

        // login your user and redirect him to your application dashboard.
        // auth()->login($user);
        return redirect()->route('index');
    }

    public static function getTokensFromZidByCode(string $oauthCode): array
    {
        $url = self::OAUTH_URL . 'oauth/token';
        $requestBody = [
            'grant_type' => 'authorization_code',
            'client_id' => env('ZID_CLIENT_ID'),
            'client_secret' => env('ZID_CLIENT_SECRET'),
            'redirect_uri' => env('APP_URL') . "/auth/zid/callback",
            'code' => $oauthCode,
        ];

        $response = Http::post($url, $requestBody);

        return $response->json();
    }
}
