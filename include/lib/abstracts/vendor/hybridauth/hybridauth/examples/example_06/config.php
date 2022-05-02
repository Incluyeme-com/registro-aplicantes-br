<?php

session_start();

include '../../../..vendor/autoload.php';

$config = [
    'callback' => 'https://jobstalentoincluir.com.br/wp-content/plugins/incluyeme-login-extension/include/lib/abstracts/vendor/hybridauth/hybridauth/examples/example_06/callback.php',
    'keys' => ['id' => '77enshq5lqkzdk', 'secret' => 'qyQS2hPoW7lDAkrT'], 
];



/**
 * Step 3: Instantiate Github Adapter
 *
 * This example instantiates a GitHub adapter using the array $config we just built.
 */

$github = new Hybridauth\Provider\LinkedIn($config);

/**
 * Step 4: Authenticating Users
 *
 * When invoked, `authenticate()` will redirect users to GitHub login page where they
 * will be asked to grant access to your application. If they do, GitHub will redirect
 * the users back to Authorization callback URL (i.e., this script).
 *
 * Note that GitHub and few other providers will ask their users for authorisation
 * only once.
 */

$github->authenticate();

/**
 * Step 5: Retrieve Users Profiles
 *
 * Calling getUserProfile returns an instance of class Hybridauth\User\Profile which contain the
 * connected user's profile in simple and standardized structure across all the social APIs supported
 * by Hybridauth.
 */

$userProfile = $github->getUserProfile();

echo "<pre>";
die(print_r($userProfile));
exit();

echo 'Hi ' . $userProfile->displayName;

/**
 * Bonus: Access GitHub API
 *
 * Now that the user is authenticated with Gihub, and depending on the authorization given to your
 * application, you should be able to query the said API on behalf of the user.
 *
 * As an example we list the authenticated user's public gists.
 */

$apiResponse = $github->apiRequest('gists');

/**
 * Step 6: Disconnect the adapter
 *
 * This will erase the current user authentication data from session, and any further
 * attempt to communicate with Github API will result on an authorisation exception.
 */

$github->disconnect();

/**
 * Final note: Catching Exceptions
 *
 * Hybridauth use exceptions extensively and it's important that these exceptions
 * be properly caught/handled in your code.
 *
 * Below is a basic example of how to catch exceptions.
 *
 * Note that on the previous step we disconnected from the API; meaning Hybridauth
 * has erased the oauth access token used to sign http requests from the current
 * session, thus, any new request we now make will now throw an exception.
 *
 * It's important that you don't show Hybridauth exception's messages to the end user as
 * they may include sensitive data, and that you use your own error messages instead.
 */

try {
    $github->getUserProfile();
}

/**
 * Catch Curl Errors
 *
 * This kind of error may happen in case of:
 *     - Internet or Network issues.
 *     - Your server configuration is not setup correctly.
 *
 * The full list of curl errors that may happen can be found at http://curl.haxx.se/libcurl/c/libcurl-errors.html
 */
catch (Hybridauth\Exception\HttpClientFailureException $e) {
    echo 'Curl text error message : ' . $github->getHttpClient()->getResponseClientError();
}

/**
 * Catch API Requests Errors
 *
 * This usually happens when requesting a:
 *     - Wrong URI or a mal-formatted http request.
 *     - Protected resource without providing a valid access token.
 */
catch (Hybridauth\Exception\HttpRequestFailedException $e) {
    echo 'Raw API Response: ' . $github->getHttpClient()->getResponseBody();
}

/**
 * Base PHP's exception that catches everything [else]
 */
catch (\Exception $e) {
    echo 'Oops! We ran into an unknown issue: ' . $e->getMessage();
}

