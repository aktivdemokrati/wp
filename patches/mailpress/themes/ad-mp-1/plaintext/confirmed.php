<?php
/*
Template Name: confirmed
Subject: [<?php bloginfo('name');?>] <?php printf('%s confirmed', '{{toemail}}'); ?>
*/

$_the_title = 'Grattis !';

$_the_content = 'Du prenumererar nu på ' . get_option('blogname') . ' [' . get_option('siteurl') . ']';

include('_mail.php');