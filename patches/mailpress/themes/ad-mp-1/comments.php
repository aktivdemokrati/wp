<?php
/*
Template Name: comments
*/
$comment = $this->args->advanced->comment;
$post    = $this->args->advanced->post;

$_the_title = 'Kommentar # ' . $comment->comment_ID . ' på "{{the_title}}"';

$_the_actions = "<a " . $this->classes('button', false) . ' href="' .
esc_url( get_comment_link( $comment->comment_ID ) ) . '">' .
 __('Reply') . "</a>";

include('_mail.php');
