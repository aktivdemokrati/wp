<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<div id="container">
<div id="content" role="main">

<h2>Hello</h2>


<div class="fb-registration" 
     data-fields="[{'name':'name'},
                   {'name':'email'},
                   {'name':'location'},
          {'name':'user_login','description':'Användarnamn','type':'text'},
          {'name':'display_name','description':'Visa namn offentligt som','type':'text'},
          {'name':'newsletter','description':'Prenumerera på nyheter från Aktiv Demokrati','type':'checkbox', 'default':'checked'}
]"
        data-redirect-uri="http://aktivdemokrati.se/member/test/">
      </div>



</div><!-- #content -->
</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
