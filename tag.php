<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title archive-title"><?php
					printf( __( 'Tag Archives: %s', 'ad' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>
<div class="breadcrumbs">
<?php
if(function_exists('bcn_display'))
{
	bcn_display();
}
?>
</div>

<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
