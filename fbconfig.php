<?php
ini_set('max_execution_time', 300);
/**
 * it sets the application id and application secret id
 *
 */
$fb_app_id = '1063028303777902';//Please specify app id
$fb_secret_id = '14b6a3ad44c637b53b4c45216749cbed';//Please specify app secret

$fb_login_url = 'http://localhost/rtcamp';


require_once ('libs/Facebook/autoload.php');
/**
 *
 * define the namespace alies
 * for the use of facebook namespace
 * easy to use
 */
session_start();
use Facebook\GraphObject;
		use Facebook\GraphSessionInfo;
		use Facebook\Entities\AccessToken;
		use Facebook\HttpClients\FacebookHttpable;
		use Facebook\HttpClients\FacebookCurl;
		use Facebook\HttpClients\FacebookCurlHttpClient;
		use Facebook\FacebookSession;
		use Facebook\FacebookRedirectLoginHelper;
		use Facebook\FacebookRequest;
		use Facebook\FacebookResponse;
		use Facebook\FacebookSDKException;
		use Facebook\FacebookRequestException;
		use Facebook\FacebookAuthorizationException;
/*setting application configuration
 and session
  */
FacebookSession::setDefaultApplication($fb_app_id, $fb_secret_id);
$helper = new FacebookRedirectLoginHelper($fb_login_url);

if (isset($_SESSION) && isset($_SESSION['fb_token'])) {
	$session = new FacebookSession($_SESSION['fb_token']);
	try {
		if (!$session -> validate()) {
			$session = null;
		}
	} catch ( Exception $e ) {
		$session = null;
	}
}
if (!isset($session) || $session === null) {
	try {
		$session = $helper -> getSessionFromRedirect();

	} catch( FacebookRequestException $ex ) {
		print_r($ex);
	} catch( Exception $ex ) {
		print_r($ex);
	}
}
function datafromfacebook($url){
       $session = new FacebookSession($_SESSION['fb_token']);
       $request = new FacebookRequest($session, 'GET', $url);
	$response = $request -> execute();
	$user = $response -> getGraphObject() -> asArray();

	return $user;
   }
   
?>
