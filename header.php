<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ad' ), max( $paged, $page ) );

	?></title>
<link href="https://plus.google.com/117631766948561738723/" rel="publisher" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="icon" type="image/vnd.microsoft.icon" href="http://aktivdemokrati.se/favicon.ico" />
<link rel="icon" type="image/png" href="<?php echo(ADHOMEURL) ?>/images/favicon64.png"/>
<link rel="apple-touch-icon" href="http://aktivdemokrati.se/apple-touch-icon.png">
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=6" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<script type="text/javascript" src="<?php echo(ADHOMEURL) ?>/js/jquery.ba-bbq.min.js"></script>
<script type="text/javascript">window.ad_wp_logged_in="<?PHP echo is_user_logged_in();?>";</script>
<script type="text/javascript" src="<?php echo(ADHOMEURL) ?>/js/ad.js?v=6"></script>
<script type="text/javascript" src="<?php echo(ADHOMEURL) ?>/js/iframe_resize.js"></script>
<?php
/* Google Analytics tracking code */
?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20939045-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</head>


<body <?php body_class("section-" . ad_section()->post_name); ?>>

<div id="wrapper" class="hfeed">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'ad' ); ?>"><?php _e( 'Skip to content', 'ad' ); ?></a></div>

<a href="<?php echo home_url( '/' ); ?>"><img alt="Hem" id="ad-logo" src="<?php echo(ADHOMEURL) ?>/images/Aktivdemokrati-r16-85px.png"></a>
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</<?php echo $heading_tag; ?>>
				<div id="site-description"><a href="/dd/">Demokrati mellan valen</a></div>
				<div id="member-menu">
<div style="float:right"><a href="<?php echo home_url( '/member/' ); ?>">Medlemsarea</a></div>
<?php
if( is_front_page() )
  $login_target = '/member/';
else
  $login_target = $_SERVER["REQUEST_URI"];


if( is_user_logged_in() )
  {
    global $current_user;
    echo('<div style="float:right" id="account-menu">');
    echo('<img src="http://www.gravatar.com/avatar/' . md5($current_user->user_email) . '?s=16&d=retro&r=G" style="float:left;border:0;margin:1px">'  );
    echo('<span>Ditt konto</span><ul>');
    echo('<li><a href="http://aktivdemokrati.se/wp-admin/profile.php">Kontaktuppgifter</a></li>');
    echo('<li><a href="http://aktivdemokrati.se/wp-admin/profile.php#helpus">&nbsp;&nbsp;&nbsp;&nbsp;Vad du kan erbjuda AD</a></li>');
    
    echo('<li><a href="http://aktivdemokrati.se/wp-admin/profile.php#membership">&nbsp;&nbsp;&nbsp;&nbsp;Medlemskap i partiet</a></li>');
    echo('<li><a href="http://aktivdemokrati.se/forum/ucp.php">Forum inställningar</a></li>');
    echo('<li><a href="http://val.aktivdemokrati.se/member/edit.tt">Valsystemet:</a></li>');
    echo('<li><a href="http://val.aktivdemokrati.se/member/delegacy.tt">&nbsp;&nbsp;&nbsp;&nbsp;Delegat</a></li>');
    echo('<li><a href="http://val.aktivdemokrati.se/member/delegating.tt">&nbsp;&nbsp;&nbsp;&nbsp;Delegeringar</a></li>');
    echo('<li>Hantera e-post:</li>');
    echo('<li><a href="http://aktivdemokrati.se/wp-admin/users.php?page=mailpress_subscriptions">&nbsp;&nbsp;&nbsp;&nbsp;Bloggen prenuemration</a></li>');
    echo('<li><a href="http://aktivdemokrati.se/forum/ucp.php?i=digests&mode=basics">&nbsp;&nbsp;&nbsp;&nbsp;Forum sammandrag</a></li>');
    echo('<li><a href="http://aktivdemokrati.se/forum/ucp.php?i=main&mode=subscribed">&nbsp;&nbsp;&nbsp;&nbsp;Forum bevakningar</a></li>');
    echo('<li><a href="http://val.aktivdemokrati.se/member/notifications.tt">&nbsp;&nbsp;&nbsp;&nbsp;Valsystemet bevakningar</a></li>');
    echo('<li><a href="http://aktivdemokrati.se/cas/logout?service=http%3A%2F%2Faktivdemokrati.se%2F">Logga ut nu</a></li>');
    echo('</ul></div>');

    //echo( 'Hej, <a href="'.home_url('/wp-admin/profile.php').'">'.
    //	    $current_user->display_name.'</a> |');
  }
else
  {
    echo '<div style="float:right"><a href="'.home_url('/wp-login.php?redirect_to='.htmlentities(urlencode($login_target))).'">Logga in</a> i&nbsp;</div>';
  }
?>
<div style="float:right; margin-right:.5em"><a href="/manifesto/">In english</a>
  <?php if(!is_user_logged_in()) echo " |";?>
</div>
<?php
/***************************************************
 * Facebook button
 */
?>
<div style="float:right">
<?php
  if(  is_user_logged_in() ):
global $current_user;
$fb_uid = get_user_meta($current_user->ID, 'facebook_uid', true);
if(! $fb_uid ):
?>
<a id="fb-auth" class="fb_button fb_button_medium"><span class="fb_button_text">Koppla till Facebook</span></a>
<?php
   /* <a id="fb-auth" class="fb_button fb_button_medium" href="<?php echo ad_build_url($login_target,array('fb_connect'=>1)); ?>"><span class="fb_button_text">Koppla till Facebook</span></a> */
endif;
else:
?>

<a id="fb-auth" class="fb_button fb_button_medium"><span class="fb_button_text">Logga in utan lösenord</span></a>
<?php
   /*<a id="fb-auth" class="fb_button fb_button_medium" href="<?php echo ad_build_url($login_target,array('autologin'=>1)); ?>"><span class="fb_button_text">Logga in utan lösenord</span></a>*/
endif;
/****************************************************/
?>
</div>

</div>
<?php get_search_form(); ?> 


			</div><!-- #branding -->

			<div id="access" role="navigation">
<div id="ad-menu-bg"></div>

<div class="menu-header">
<ul id="menu-huvud_meny" class="menu">
<li id="menu-item-dd"><a href="<?php echo home_url( '/dd/' ); ?>">Så fungerar det</a></li>
<li id="menu-item-om"><a href="<?php echo home_url( '/om/' ); ?>">om organisationen</a></li>
<li id="menu-item-agera"><a href="<?php echo home_url( '/agera/' ); ?>">Engagera dig</a></li>
<li id="menu-item-press"><a href="<?php echo home_url( '/press/' ); ?>">Press</a></li>
<li id="menu-item-kontakt"><a href="<?php echo home_url( '/kontakt/' ); ?>">Kontakt</a></li>
</ul></div>


			</div><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">
