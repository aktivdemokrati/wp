<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div id="container">
<div id="content" role="main">

<h2>Javascript</h2>

<div id="user-info"></div>

  <a id="fb-auth" class="fb_button fb_button_medium"><span class="fb_button_text">&nbsp;</span></a>

<h2>PHP</h2>

<?php
global $ad_fb;
// See if there is a user from a cookie
$user = $ad_fb->getUser();
//error_log(var_export($ad_fb,1));
//echo "<script>log('Test: $out');</script>";

if($user)
  {
    try
      {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $ad_fb->api('/me');
      }
    catch(FacebookApiException $e)
      {
        echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
        $user = null;
      }
  }

if($user):
?>
Your user profile is
<pre>
<?php print htmlspecialchars(print_r($user_profile, true)) ?>
</pre>
<?php else: ?>
<fb:login-button></fb:login-button>
<?php endif; ?>

</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
