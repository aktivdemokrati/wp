<?php
/*
Template Name: confirmed
Subject: [<?php bloginfo('name');?>] <?php printf('%s confirmed', '{{toemail}}'); ?>
*/

$_the_title = 'Grattis !';

$_the_content = "Du prenumererar nu på : <a " . $this->classes('button', false) . " href='" . get_option('siteurl') . "'>" . get_option('blogname') . "</a><br />";

include('_mail.php');