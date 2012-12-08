<?php
/**
 * A custom template for the chat page
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
<h1 class="page-title archive-title"><span>Chatt</span></h1>

<p><strong>Server:</strong> <code>irc.freenode.net</code> <strong>port</strong> <code>6667</code><br/>
  <strong>Kanaler</strong> <code><a href="irc://irc.freenode.net:6667/aktivdemokrati">#aktivdemokrati</a>,
<a href="irc://irc.freenode.net:6667/gov-online-voting">#gov-online-voting</a>,
<a href="irc://irc.freenode.net:6667/metagov">#metagov</a>
</code></p>

  <?php if( is_user_logged_in() ): ?>
<iframe width="100%" height="600" style="border:thin solid black" src="http://webchat.freenode.net?nick=<?php echo urlencode($user_login) ?>&channels=aktivdemokrati&prompt=1"></iframe>
  <?php else: ?>
<p><em>Du kan välja vilket namn som helst. Ingen registrering behövs.</em> 

<iframe width="100%" height="600" style="border:thin solid black" src="http://webchat.freenode.net?channels=aktivdemokrati"></iframe>

  <?php endif; ?>


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
