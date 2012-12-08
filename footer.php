<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">


<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
				<div id="first" class="widget-area">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</ul>
				</div><!-- #first .widget-area -->
<?php endif; ?>


		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php wp_footer();
global $ad_trace;
?>
<a id="pi" href="/wp-admin/">π</a>
<?php if($ad_trace):?>
<pre><?php echo htmlspecialchars($ad_trace); ?></pre>
<?php endif; ?>
<div id="dim"></div>
<img id="spinner-center" alt="" src="<?php echo(ADHOMEURL) ?>/images/loading-spinner.gif">
</body>
</html>
