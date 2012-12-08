<?php
/**
 * Aktiv Demokrati functions and definitions
 * based on TwentyTen
 */

define('ADHOMESYS', get_stylesheet_directory());
define('ADHOMEURL', get_stylesheet_directory_uri());

/*
ini_set('display_errors', '0');
if(defined('E_STRICT'))
  error_reporting(E_ALL ^ E_STRICT ^ E_NOTICE );
*/

require_once(ADHOMESYS.'/inc/users.php');
require_once(ADHOMESYS.'/inc/widgets.php');
require_once(ADHOMESYS.'/inc/sections.php');
require_once(ADHOMESYS.'/inc/excerpts.php');
require_once(ADHOMESYS.'/inc/facebook.php');
require_once(ADHOMESYS.'/facebook/facebook.php');


//////////////////////////////////////////////////////////////////////


/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in ad_setup().
 *
 * @since Twenty Ten 1.0
 */
function ad_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
	#headimg #name { }
	#headimg #desc { }
*/
</style>
<?php
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function ad_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function ad_excerpt_length( $length ) {
	return 40;
}

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since Twenty Ten 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function ad_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own ad_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function ad_comment( $comment, $args, $depth )
{
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
  case '' :
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
<div id="comment-<?php comment_ID(); ?>">
<div class="comment-author vcard">
  <?php echo get_avatar( $comment, 40 ); ?>
  <?php printf( __( '%s <span class="says">says:</span>', 'ad' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
</div><!-- .comment-author .vcard -->
<?php if ( $comment->comment_approved == '0' ) : ?>
<em><?php _e( 'Your comment is awaiting moderation.', 'ad' ); ?></em>
<br />
<?php endif; ?>

<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
<?php
  /* translators: 1: date, 2: time */
  printf( __( '%1$s at %2$s', 'ad' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'ad' ), ' ' );
?>
</div><!-- .comment-meta .commentmetadata -->

<div class="comment-body"><?php comment_text(); ?></div>

<div class="reply">
  <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div><!-- .reply -->
</div><!-- #comment-##  -->

<?php
    break;
  case 'pingback'  :
  case 'trackback' :
?>
<li class="post pingback">
  <p><?php _e( 'Pingback:', 'ad' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'ad'), ' ' ); ?></p>
  <?php
    break;
    endswitch;
    }


/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function ad_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function ad_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'ad' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'ad' ), get_the_author() ),
			get_the_author()
		)
	);
}

/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function ad_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ad' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ad' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'ad' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}


////////////////////////////////////////////////////////////

function add_upload_ext($mimes='')
{
  $mimes['svg'] ='image/svg+xml';
  $mimes['svgz']='image/svg+xml';
  $mimes['eps'] ='application/postscript';
  $mimes['sla'] ='application/x-scribus';
  $mimes['xcf'] ='application/x-xcf';
  return $mimes;
}

////////////////////////////////////////////////////////////

function ad_redirect()
{
  //ad_log( "GOT ".$_SERVER['REQUEST_URI']);

  if( preg_match('#/senaste/([^/]+)/#', $_SERVER['REQUEST_URI'], $matches) )
    {
      //ad_log( "  FOUND '".$matches[1]."'");
      global $ad_menu_current;
      $ad_menu_current = "/senaste/".$matches[1]."/";
      $category = get_category_by_slug($matches[1]);
      //ad_log( "  cat id ". $category->term_id);

      global $wp_query;
      $wp_query = new WP_Query(array('cat' => $category->term_id, 'showposts' => 1, 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
      //$wp_query->the_post();
      $posts = $wp_query->get_posts();

      $wp_query = new WP_Query( 'p='.$posts[0]->ID );
      wp_reset_query();
    }
}


////////////////////////////////////////////////////////////


function ad_ap_menu()
{
  if( isset($_GET['csv']) && $_GET['csv'] == "true")
  {
    if ( !current_user_can('edit_users') )
      wpdie('No, that won\'t be working, sorry.');
    require_once(ADHOMESYS.'/inc/users2csv.php');
    createcsv();
    exit;
  }
  else if( isset($_GET['flush_rewrite_rules']) && $_GET['flush_rewrite_rules'] == "true")
  {
    if ( !current_user_can('activate_plugins') )
      wpdie('No, that won\'t be working, sorry.');
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
  }

  //  add_users_page('Medlemsregister', 'AD medlemmar', 'edit_users', 'AD-members', 'ad_ap_members');
  add_management_page('AD verktyg', 'AD verktyg', 'activate_plugins', 'AD-tools', 'ad_ap_tools');
  add_users_page('Medlemsregister export', 'AD export', 'edit_users', 'AD-members-export', 'ad_ap_members_export');
  add_users_page('Import från forum', 'AD import', 'edit_users', 'AD-forum-import', 'ad_ap_forum_import');
}

////////////////////////////////////////////////////////////

function ad_mail_from() { return 'kontakt@aktivdemokrati.se'; }
function ad_mail_from_name() { return 'Aktiv Demokrati'; }

////////////////////////////////////////////////////////////

function ad_admin_footer_text()
{
  return "";
}

////////////////////////////////////////////////////////////

function ad_admin_setup()
{
  // Remove extra admin colour scheme
  global $_wp_admin_css_colors;
  //debug_print_backtrace();
  //ad_log("item ".var_export($_wp_admin_css_colors,1));
  unset( $_wp_admin_css_colors['classic'] );
  wp_admin_css_color('fresh', __('Gray'), ADHOMEURL.'/style-admin.css', array('#464646', '#6D6D6D', '#F1F1F1', '#DFDFDF'));
}

////////////////////////////////////////////////////////////

function ad_login_head()
{
  echo '<link rel="stylesheet" type="text/css" href="' . ADHOMEURL.'/style-login.css?v=3" />';
}

////////////////////////////////////////////////////////////

function ad_login_headerurl()
{
  return "/";
}

////////////////////////////////////////////////////////////

function ad_login_headertitle()
{
  return "Aktiv Demokrati";
}

////////////////////////////////////////////////////////////

function ad_login( $login )
{
  if( $u = get_user_by('login',$login) )
    {
      global $wpdb;
      update_user_meta($u->ID, 'ad_login_timestamp', $wpdb->prepare(time()));
    }
}

////////////////////////////////////////////////////////////

function ad_login_form()
{
  global $rememberme;
  $rememberme = 1;
}

////////////////////////////////////////////////////////////

function ad_register_form()
{
  ?>
  <p class="follow-wrapper"><label><input name="follow" type="checkbox" id="follow" value="yes" tabindex="90" checked="checked" /> Följ blogg och forum</label></p>
  <?php
}


////////////////////////////////////////////////////////////

function ad_follow_phpbb($u)
{
  ad_log("Follow BB digests?");
  if(! $u->user_login)
    return;
  if( $_POST['follow'] )
    {
      global $wpdb;
      $wpdb->query($wpdb->prepare("update phpbb3_users set user_digest_type='WEEK' where username='%s'",$u->user_login));
      ad_log(" + Yes");
    }
}

////////////////////////////////////////////////////////////

function ad_follow_blog( $wp_uid )
{
  ad_log("Follow MP Weekly?");
  if(! $wp_uid )
    return;

  if( $_POST['follow'] or $_GET['follow'] )
    {
      $user 	= get_userdata($wp_uid);
      if( class_exists('MP_Users') )
	{
	  $_POST['keep_newsletters']['weekly']=1;
	  $email 	= $user->user_email;
	  $mp_user_id	= MP_Users::get_id_by_email($email);
	  $object_terms = array( 'weekly' => 1 );
	  MP_Newsletters::set_object_terms( $mp_user_id, $object_terms );
	  ad_log(" + Yes");
	}

      /***********************************************
       * Trigger creation of phpBB user,
       * even then user created without FB connection,
       * meaning the login happens after registration.
       */
      try {
	$user = apply_filters('wp_authenticate_user', $user, 'dummy');
	ad_follow_phpbb($user); // <--- Turn on digest 
      } catch (Exception $e) {
	ad_log( $e->getMessage() );
	// Ignoring login exceptions. FB says ok ;)
      }
    }
}

////////////////////////////////////////////////////////////

function ad_insert_rewrite_rules( $rules )
{
    $newrules = array();
    $newrules['lista/(\w*)$'] = 'index.php?pagename=lista&catname=$matches[1]';
    $newrules['senaste/(\w*)$'] = 'index.php?p=1&catname=$matches[1]';

//    global $wp_rewrite;
//    $latest_structure = $wp_rewrite->root . "latest/%category%";
//    $latest_rewrite = $wp_rewrite->generate_rewrite_rules( $latest_structure );
//    return $newrules + $rules + $latest_rewrite;

    return $newrules + $rules;
}

////////////////////////////////////////////////////////////

function ad_adjacent_posts_rel_link_wp_head()
{
  if( !is_single() || is_attachment() )
    return;
  adjacent_posts_rel_link();
}

////////////////////////////////////////////////////////////

function ad_insert_query_vars( $vars )
{
  array_push($vars, 'catname');
  return $vars;
}

////////////////////////////////////////////////////////////

  function ad_build_url( $url, $query )
  {
    $ret = "";
    foreach((array)$query as $k => $v)
      {
        $k    = urlencode($k);
        $ret .=  $k."=".urlencode($v);
      }

    if( strpos( $url, '?' ) )
      {
        return $url . '&' . $ret;
      }
    else
      {
        return $url . '?' . $ret;
      }
  }

////////////////////////////////////////////////////////////

function ad_json_controllers($controllers) { return array('core','GOV'); }
function ad_json_gov_path($default_path) { return TEMPLATEPATH .'/inc/json_gov.php'; }

////////////////////////////////////////////////////////////

function ad_log($row)
{
  error_log($row);
  //  error_log($row."\n",3,'/var/www/web/wse75376/ad-log/php.log');
}

////////////////////////////////////////////////////////////

function log_backtrace()
{
  ob_start();
  debug_print_backtrace();
  $backtrace = ob_get_contents();
  ob_end_clean();
  $rows = explode("\n",$backtrace);
  foreach($rows as $row)
    ad_log($row);
  ad_log('--------------------');
}

////////////////////////////////////////////////////////////

function ad_setup()
{
  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();

  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );

  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );

  // Make theme available for translation
  // Translations can be filed in the /languages/ directory
  load_theme_textdomain( 'ad', TEMPLATEPATH . '/languages' );

  $locale = get_locale();
  $locale_file = TEMPLATEPATH . "/languages/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
			    'primary' => __( 'Primary Navigation', 'ad' ),
			    ) );

  define( 'HEADER_IMAGE_WIDTH',  691 );
  define( 'HEADER_IMAGE_HEIGHT', 250 );
  set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

  // Don't support text inside the header image.
  define( 'NO_HEADER_TEXT', true );

  show_admin_bar( 0 );
  //	ad_redirect();
}

////////////////////////////////////////////////////////////

	// add_action( 'init', 'ad_setup');
add_action( 'after_setup_theme', 'ad_setup');
add_action( 'admin_init', 'ad_admin_setup');
add_action( 'login_head', 'ad_login_head');
add_action( 'widgets_init', 'ad_sidebars_init' );
add_action( 'widgets_init', 'ad_widgets_init' );
add_action( 'template_redirect', 'ad_redirect' );
add_action( 'admin_menu', 'ad_ap_menu');
add_action( 'wp_login','ad_login');
add_action( 'login_form','ad_login_form' );
add_action( 'user_register', 'ad_follow_blog',20);
add_action( 'register_form', 'ad_register_form');

add_action( 'show_user_profile', 'ad_user_profile_show');
add_action( 'edit_user_profile', 'ad_user_profile_edit');
add_action( 'profile_update', 'ad_user_profile_update');
add_action( 'admin_head-profile.php', 'ad_user_profile_head');
add_action( 'admin_head-user-edit.php', 'ad_user_profile_head');
add_action( 'personal_options', 'ad_personal_options',10,1);
///////////add_action( 'wp_head', 'ad_like_widget_header_meta',1 ); // run before tt_like_widget

remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
add_action('wp_head', 'ad_adjacent_posts_rel_link_wp_head' );

add_filter( 'wp_get_nav_menu_items', 'ad_get_nav_menu_items' );
add_filter( 'upload_mimes',"add_upload_ext" );
add_filter( 'excerpt_more', 'ad_excerpt_more');
add_filter( 'get_the_excerpt', 'ad_custom_excerpt_more' );
add_filter( 'wp_mail_from', 'ad_mail_from');
add_filter( 'wp_mail_from_name', 'ad_mail_from_name');
add_filter( 'sanitize_user', 'ad_sanitize_user');
add_filter( 'manage_users_columns', 'ad_manage_users_columns' );
add_filter( 'manage_users_custom_column', 'ad_manage_users_custom_column', 10, 3 );
add_filter( 'user_contactmethods', 'ad_user_contactmethods',10,1);
add_filter( 'admin_footer_text', 'ad_admin_footer_text');
add_filter( 'login_headerurl', 'ad_login_headerurl');
add_filter( 'login_headertitle', 'ad_login_headertitle');

add_filter( 'the_content', 'ad_add_sociable');
add_filter( 'get_the_excerpt', 'ad_get_excerpt',1); // run before wp_trim_excerpt

add_filter( 'json_api_controllers', 'ad_json_controllers' );
add_filter( 'json_api_gov_controller_path', 'ad_json_gov_path');


	//add_filter('json_api_controllers', 'ad_json_api_controllers');

add_filter( 'rewrite_rules_array', 'ad_insert_rewrite_rules');
add_filter( 'query_vars', 'ad_insert_query_vars' );

add_shortcode('random-post-box', 'ad_random_post_box');


ad_fb_init();

// ad_log("item ".var_export($e,1));
// debug_print_backtrace()
?>
