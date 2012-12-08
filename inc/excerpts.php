<?php

////////////////////////////////////////////////////////////

/* Replaced in order to add classes for styling */

function ad_excerpt_more( $more )
{
  return '<span class="excerpt-more">&hellip;' .
    ad_continue_reading_link() . '</span>';
}

////////////////////////////////////////////////////////////

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Twenty Ten 1.0
 * @return string "Continue Reading" link
 */
function ad_continue_reading_link()
{
  return ' <a href="'.get_permalink() . '"><em>Läs mer</em></a>';
}

////////////////////////////////////////////////////////////

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function ad_custom_excerpt_more( $output )
{
  if ( has_excerpt() && ! is_attachment() )
    {
      $output .='<span class="excerpt-more">' .
	ad_continue_reading_link() . '</span>';
    }
  return $output;
}

////////////////////////////////////////////////////////////

?>