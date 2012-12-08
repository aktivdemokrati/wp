<?php
/*
Template Name: new_subscriber
Subject: [<?php bloginfo('name');?>] <?php printf( __('Waiting for : %s', MP_TXTDOM), '{{toemail}}'); ?>
*/

$_the_title = "E-postvalidering";

$_the_content = "Var vänlig och  <a " . $this->classes('button', false) . "href='{{subscribe}}'>bekräfta</a> din e-postadress.";
$_the_content .= '<br />';

unset($this->args->unsubscribe);
include('_mail.php');