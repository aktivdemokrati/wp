<?php
add_filter( 'comments_popup_link_attributes', 	array('MP_theme_html', 'comments_popup_link_attributes'), 8, 1 );
add_filter( 'the_category', 			array('MP_theme_html', 'the_category'), 8, 3 );
add_filter( 'term_links-post_tag', 		array('MP_theme_html', 'term_links_post_tag'), 8, 1 );
remove_filter( 'the_content', 			'ad_add_sociable' );
remove_filter( 'the_content', 			'yarpp_default', 1200 );

while (have_posts()) : the_post(); 
?>

<div id="post-<?php the_ID(); ?>"  <?php $this->classes('entry'); ?>>
	<div>
		<h2 <?php $this->classes('entry-title'); ?>>
			<a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'twentyten'), the_title_attribute('echo=0') ); ?>" rel="bookmark"  <?php $this->classes('nopmb entry-title_a'); ?>>
<?php $this->the_title(); ?>
			</a>
		</h2>
	</div>
			
	<div <?php $this->classes('nopmb entry-meta'); ?>>
		<span <?php $this->classes('nopmb'); ?>>Postat</span>
		<a href="<?php the_permalink(); ?>" title="<?php the_time('Y-m-d\TH:i:sO') ?>" rel="bookmark" <?php $this->classes('nopmb entry-sep'); ?>>
			<span <?php $this->classes('nopmb entry-sep'); ?>>
<?php the_time( get_option( 'date_format' ) ); ?>
			</span>
		</a>
		<span <?php $this->classes('nopmb entry-sep'); ?>>av</span>
		<span <?php $this->classes('nopmb entry-sep'); ?>>
			<a <?php $this->classes('nopmb entry-sep'); ?> href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php printf( __( 'View all posts by %s', 'twentyten' ), get_the_author() ); ?>">
<?php the_author(); ?>
			</a>
		</span>					
	</div><!-- .entry-meta -->
								
	<div <?php $this->classes('nopmb'); ?>>	
<?php $this->the_content(  __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' )  ); ?>
<?php wp_link_pages('before=<div ' . $this->classes('page-link', false) . '>' . __( 'Pages:', 'twentyten' ) . '&after=</div>') ?>
	</div><!-- .entry-content -->

	<div <?php $this->classes('nopmb entry-utility'); ?>>
		<span <?php $this->classes('nopmb entry-sep'); ?>>
			<span  <?php $this->classes('nopmb entry-sep'); ?>>
				Det här inlägget postades i
			</span>
			<?php echo get_the_category_list(', '); ?>
		</span>
		<?php the_tags( '<span ' . $this->classes('nopmb entry-sep', false) . '><span ' . $this->classes('nopmb entry-sep', false) . '>' . 'och har taggats med ' . '</span>', ", ", '</span> <span ' . $this->classes('nopmb entry-sep', false) . '>|</span>' ) ?>
		<span <?php $this->classes('nopmb entry-sep'); ?>><?php comments_popup_link( __( 'Leave a comment', 'twentyten' ), __( '1 Comment', 'twentyten' ), __( '% Comments', 'twentyten' ) ) ?></span>
	</div><!-- #entry-utility -->	
</div><!-- #post-<?php the_ID(); ?> -->

<?php 
endwhile;

remove_filter( 'comments_popup_link_attributes', 	array('MP_theme_html', 'comments_popup_link_attributes') );
remove_filter( 'the_category', 				array('MP_theme_html', 'the_category') );
remove_filter( 'term_links-post_tag', 			array('MP_theme_html', 'term_links_post_tag') );