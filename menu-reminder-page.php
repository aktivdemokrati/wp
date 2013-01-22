<?php
/*

Template Name: Menu reminder

*/

get_header(); ?>

<div id="container">
<img src="<?php echo(ADHOMEURL) ?>/images/se-menyn-anim.gif" alt="Hallå där!!! Se vår meny här till höger"
style="position:absolute;top:-10px">

<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
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

<div class="entry-content">
<?php
if ( !$has_header_image and has_post_thumbnail( $post->ID ) )
    {
      echo get_the_post_thumbnail( $post->ID, 'medium', array('class'=>'alignright') );
    }
?>
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ad' ), 'after' => '</div>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'ad' ), '<span class="edit-link">', '</span>' ); ?>
</div><!-- .entry-content -->
</div><!-- #post-## -->

<?php comments_template( '', true ); ?>

<?php endwhile; ?>

</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
