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

<h2>Wordpress</h2>

<div id="user-info"></div>

<?php
  if(  is_user_logged_in() ):
global $current_user;
echo "<p>Logged in to WP as ".$current_user->display_name."</p>";
$fb_uid = get_user_meta($current_user->ID, 'facebook_uid', true);
if( $fb_uid ):
?>

<p>WP user connected to FB <?php echo $fb_uid ?></p>

   <p><a href="<?php echo ad_build_url($_SERVER["REQUEST_URI"], array('fb_disconnect'=>1)) ?>">Disconnect</a></p>
<?php
   if( $_GET['fb_disconnect'] )
     {
       update_user_meta($current_user->ID, 'facebook_autologin', 'no');
       delete_user_meta( $current_user->ID, 'facebook_uid' );
     };
else: ?>

<p>WP user not connected to FB</p>
<a id="fb-auth" class="fb_button fb_button_medium" href="<?php echo ad_build_url($login_target,array('fb_connect'=>1)); ?>"><span class="fb_button_text">Koppla till Facebook</span></a>


<?php
endif;
else:

?>

<p>Not logged in to WP</p>
<a id="fb-auth" class="fb_button fb_button_medium" href="<?php echo ad_build_url($login_target,array('autologin'=>1)); ?>"><span class="fb_button_text">Logga in med Facebook</span></a>
<?php
endif;
?>


<h2>Session</h2>
<?php
  global $ad_fb;
  $fb_uid = $ad_fb->getUser();
?>
<p>Key = <?php echo "$fb_uid/me" ?></p>
<pre>
<!--?php print htmlspecialchars(print_r($_SESSION["$fb_uid/me"], true)) ?-->
</pre>


</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
