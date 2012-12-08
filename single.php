<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div id="container">
<div id="content" role="main">
  <div class="breadcrumbs">
<?php
if(function_exists('bcn_display'))
{
	bcn_display();
}
?>
  </div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="nav-above" class="navigation">
  <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'ad' ) . '</span> %title' ); ?></div>
  <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'ad' ) . '</span>' ); ?></div>
</div><!-- #nav-above -->

<?php // Check if this is a post or page, if it has a thumbnail, and if it's a big one
  global $has_header_image;
  if ( has_post_thumbnail( $post->ID ) &&
       ( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
       $image[1] >= HEADER_IMAGE_WIDTH )
    {
      // Houston, we have a new header image!
      $has_header_image = 1;
      echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
    }
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<h1 class="entry-title"><?php the_title(); ?></h1>
<div class="entry-meta">
  <?php ad_posted_on(); ?>
</div><!-- .entry-meta -->

<div class="entry-content">
<?php
if ( !$has_header_image and has_post_thumbnail( $post->ID ) )
    {
      echo get_the_post_thumbnail( $post->ID, 'medium', array('class'=>'alignright') );
    }
?>
  <?php the_content(); ?>
  <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ad' ), 'after' => '</div>' ) ); ?>
</div><!-- .entry-content -->

<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
<div id="entry-author-info">
  <div id="author-avatar">
    <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'ad_author_bio_avatar_size', 60 ) ); ?>
  </div><!-- #author-avatar -->
  <div id="author-description">
    <h2><?php printf( esc_attr__( 'About %s', 'ad' ), get_the_author() ); ?></h2>
    <?php the_author_meta( 'description' ); ?>
    <div id="author-link">
      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
      <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'ad' ), get_the_author() ); ?>
    </a>
  </div><!-- #author-link	-->
</div><!-- #author-description -->
</div><!-- #entry-author-info -->
<?php endif; ?>

<div class="entry-utility">
  <?php ad_posted_in(); ?>
  <?php edit_post_link( __( 'Edit', 'ad' ), '<span class="edit-link">', '</span>' ); ?>
</div><!-- .entry-utility -->
</div><!-- #post-## -->

<div id="nav-below" class="navigation">
  <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'ad' ) . '</span> %title' ); ?></div>
  <div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'ad' ) . '</span>' ); ?></div>
</div><!-- #nav-below -->

<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
global $ad_menu_current;
if( $ad_menu_current ):
?>
<script type="text/javascript">
jQuery('.menu [href="<?php echo($ad_menu_current) ?>"]').parent().addClass('current-menu-item');
</script>
<?php endif; ?>
