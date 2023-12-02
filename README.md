# Laravel Sample To Use Zid APIs

## OAuth.
In Zid, we use authorization code grant, The authorization code grant type is used to obtain both access tokens and refresh tokens and is optimized for confidential clients. Since this is a redirection-based flow, the client must be capable of interacting with the resource owner's user-agent (typically a web browser) and capable of receiving incoming requests (via redirection) from the authorization server.
<br>
- ### Generate Client ID and Client Secret
  The first step is to retrieve an API id and API secret key, which you get when you create an app. These API credentials identify your app during the authorization process.

  1) Log in to your Partner Dashboard.
  2) Click Apps.
  3) Choose the type of app that you want to create.
  4) Click Create app.
  5) Enter your application basic details.
  6) Click Create App.
  7) Scroll to API Keys to view your API key and API secret key.
  8) Store these keys in your .env file as `ZID_CLIENT_ID` and `ZID_CLIENT_SECRET`

- ### Update Your application URLs
  In the third step of the application creation, Zid will ask your for application, Redirect, and Callback URLs.
  In this sample project the redirect URL will be `{{your_base_URL}}/auth/zid`, and the callback URL will be `{{your_base_URL}}/auth/zid/callback`
  <br>
  <br>
  - The application URL: should be the base URL for your application, where zid will redirect the users to when they want to use your application
  - Redirect URL: when the users clicks on `install on my store` button, Zid will redirect the user to this URL.
  - Callback URL: after the user confirms the scopes that your application is asking, he will be redirected to this URL, with the OAuth code.
