<?php
/**
 * A custom template for the membership portal page
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
<h1 class="page-title archive-title"><span>Medlemsarea</span></h1>

  <?php if( !is_user_logged_in() ){ ?>
<div class="bubble" style="float:left">
<a href="http://aktivdemokrati.se/wp-login.php?action=register"><h2>Gå med i forumet!</h2
<p>I vårt forum hittar du tusentals med intressanta texter<br>
och det är givetvis kostnadsfritt att skapa en<br>
användare. Gillar du det du läser kan du enkelt bli<br>
medlem i partiet också!<br>
</p></div>
   <?php } ?>

<h3 style="margin-bottom:0;clear:left;padding-top:1em">Aktivitet på <a href="/forum/">forumet</a></h3>
<iframe class="iframe_autoresize" width="100%" height="600" src="http://aktivdemokrati.se/forum/search.php?search_id=active_topics&ad_inside_wp=1"></iframe>



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'ad' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'ad' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->
<?php endwhile; ?>


			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
