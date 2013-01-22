<?php $post_id = (isset($this->args->newsletter['params']['post_id'])) ? $this->args->newsletter['params']['post_id'] : false; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php bloginfo( 'name' ) ?> > <?php $this->the_subject('mail subject'); ?> > {{toemail}}</title>
	</head>
	<body bgcolor="#f1f1f1">
<?php $this->get_stylesheet(); ?>
		<div <?php $this->classes('body'); ?>>
<table <?php $this->classes('nopmb wrapper'); ?>>
<tr><td valign="top">
<a href="<?php bloginfo( 'url' ) ?>/"><img alt="Hem" src="http://aktivdemokrati.se/wp-content/themes/ad-2/images/logga-85x85.jpg" <?php $this->classes('ad-logo'); ?>></a>
</td><td>
<?php if (isset($this->args->viewhtml)) { ?>
				<div <?php $this->classes('mail_link'); ?>>
					Om brevet ser fel ut; <a href='{{viewhtml}}' <?php $this->classes('mail_link_a'); ?>>Visa brevet i din webbläsare</a>
				</div>
<?php } ?>
				<div <?php $this->classes('header'); ?>>
					<div <?php $this->classes('nopmb'); ?>>
						<div <?php $this->classes('nopmb w100'); ?>>
							<table cellspacing='0' cellpadding='0' <?php $this->classes('nopmb'); ?>>
								<tr>
									<td <?php $this->classes('nopmb'); ?>>
										<h1 <?php $this->classes('site-title'); ?>>
											<span <?php $this->classes('nopmb'); ?>>
												<a <?php $this->classes('site-title_a'); ?> href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home">
<?php bloginfo( 'name' ); ?>
												</a>
											</span>
										</h1>
									</td>
									<td <?php $this->classes('nopmb'); ?>>
										<div <?php $this->classes('site-description'); ?>>
<?php bloginfo( 'description' ); ?>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div <?php $this->classes('main'); ?>>
					<div <?php $this->classes('nopmb w100'); ?>>
						<div <?php $this->classes('content'); ?>>
<!-- end header -->