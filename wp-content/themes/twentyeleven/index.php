<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

include_once "inc/oauth/OAuthStore.php";
include_once "inc/oauth/OAuthRequester.php";

//local
/*
define("MASHABLE_CONSUMER_KEY", "iQoPJeG3");
define("MASHABLE_CONSUMER_SECRET", "24uRSr6jI8uXXjfk");
define("MASHABLE_BASE_URL", "http://mshbl.local");
define("MASHABLE_REQUEST_TOKEN_URL", MASHABLE_BASE_URL."/comments-api/request_token");
define("MASHABLE_AUTHORIZE_URL", MASHABLE_BASE_URL."/comments-api/authorize");
define("MASHABLE_ACCESS_TOKEN_URL", MASHABLE_BASE_URL."/comments-api/access_token");
/**/

define("MASHABLE_CONSUMER_KEY", "clU56l67");
define("MASHABLE_CONSUMER_SECRET", "n6UEWH51mesrMcg8");
define("MASHABLE_BASE_URL", "http://staging.mashable.com");
define("MASHABLE_REQUEST_TOKEN_URL", MASHABLE_BASE_URL."/comments-api/request_token");
define("MASHABLE_AUTHORIZE_URL", MASHABLE_BASE_URL."/comments-api/authorize");
define("MASHABLE_ACCESS_TOKEN_URL", MASHABLE_BASE_URL."/comments-api/access_token");
/**/
define("CALLBACK_URL", "http://wordpress.local");

define('OAUTH_TMP_DIR', function_exists('sys_get_temp_dir') ? sys_get_temp_dir() : realpath($_ENV["TMP"]));

// Start the session
session_start();

$options = array(
        'consumer_key' => MASHABLE_CONSUMER_KEY, 
        'consumer_secret' => MASHABLE_CONSUMER_SECRET,
        'request_token_uri' => MASHABLE_REQUEST_TOKEN_URL,
        'authorize_uri' => MASHABLE_AUTHORIZE_URL,
        'access_token_uri' => MASHABLE_ACCESS_TOKEN_URL,
);
/*
OAuthStore::instance("Session", $options);

// for staging testing
$username = 'development';
$password = '#1omgdontshare';
$curl_options = array( CURLOPT_USERPWD => $username.':'.$password, 
                        CURLOPT_HTTPHEADER => array('Authorization: Basic '.base64_encode("$username:$password"))
                        );

// otherwise
//$curl_options = array();

try
{
        //  STEP 1:  If we do not have an OAuth token yet, go get one
        if (empty($_GET["oauth_token"]))
        {
                // get a request token

                $tokenResultParams = OAuthRequester::requestRequestToken(MASHABLE_CONSUMER_KEY, 0, array(), 'POST', $options, $curl_options);
                $_SESSION['oauth_token'] = $tokenResultParams['token'];

                //  redirect to the mashable authorization page, they will redirect back
                header("Location: " . MASHABLE_AUTHORIZE_URL . "?callbackurl=".CALLBACK_URL."&oauth_token=" . $tokenResultParams['token']);
        }
        else {
                //  STEP 2:  Get an access token
                try {
                    $res = OAuthRequester::requestAccessToken(MASHABLE_CONSUMER_KEY, $_SESSION['oauth_token'], 0, 'POST', $options=array('oauth_token' => $_GET['oauth_token']), $curl_options );
                }
                catch (OAuthException2 $e)
                {
                    var_dump($e);
                    // Something wrong with the oauth_token.
                    // Could be:
                    // 1. Was already ok
                    // 2. We were not authorized
                    return;
                }
                
                // make the comment request.
		$fields = array(
				'api_action' => 'add_comment',
				'mashable_post_id' => '1',
				'mashable_comment_id' => '17166461',
				'user_ip' => '192.168.0.1',
				'comment_content' => time().'testing finals updated'
				);

                $request = new OAuthRequester(MASHABLE_BASE_URL."/comments-api/manageComment/", 'POST', $fields );

                $result = $request->doRequest(0, $curl_options);
                if ($result['code'] == 200) {
            			$apiResponse = json_decode($result['body'], true);
            			var_dump($apiResponse['response']); die;
                }
                else {
                        echo 'Error';
                }
        }
}
catch(OAuthException2 $e) {
        echo "OAuthException:  " . $e->getMessage();
        var_dump($e);
}
*/
get_header(); 
?>
		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
