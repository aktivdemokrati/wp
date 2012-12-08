<?php
/*
Template Name: new_subscriber
*/

$_the_title 	= sprintf('Prenumeration på %1$s', get_option('blogname'));

$_the_content 	= sprintf('Bekräfta din prenumeration genom att gå in på följande webbsida : %1$s ', '{{subscribe}}');

unset($this->args->unsubscribe);
include('_mail.php');