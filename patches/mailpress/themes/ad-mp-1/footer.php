<!-- start footer -->
						</div>
					</div>
				</div>
				<div <?php $this->classes('nopmb w100'); ?>>
					<div <?php $this->classes('colophon'); ?>>
						<table cellspacing='0' cellpadding='0' <?php $this->classes('nopmb w100'); ?>>
							<tr>
								<td <?php $this->classes('nopmb'); ?>>
									<div <?php $this->classes('nopmb site-info'); ?>>
<a <?php $this->classes('nopmb site-info_a'); ?> href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a>
									</div>
								</td>
								<td <?php $this->classes('nopmb'); ?>>
<a <?php $this->classes('powered_a'); ?> href="http://mailpress.org/" title="MailPress: The WordPress Mailing plugin" rel="generator">
<img src='images/mailpress.png' <?php $this->classes('powered_img'); ?> /></a></td>
							</tr>
						</table>
					</div>
<?php if (isset($this->args->unsubscribe)) { ?>
				<div <?php $this->classes('mail_link'); ?>>
					<a href='{{unsubscribe}}'  <?php $this->classes('mail_link_a'); ?>>Hantera dina prenumerationer</a>
				</div>
<?php } ?>
</td></tr></table>
			</div>
		</div>
	</body>
</html>