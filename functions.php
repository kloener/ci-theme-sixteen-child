<?php

/**
 * Override for functions from parent theme.
 */

/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own twentysixteen_entry_meta() function to override in a child theme.
 *
 * Changes by childtheme:
 * - We don't wanna link author pages in posts to avoid login names to be disclosed in the URL
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_entry_meta() {
  if ( 'post' === get_post_type() ) {
    $author_avatar_size = apply_filters( 'twentysixteen_author_avatar_size', 49 );
    printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> %4$s</span></span>',
      get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
      _x( 'Author', 'Used before post author name.', 'twentysixteen' ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      get_the_author()
    );
  }
  if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
    twentysixteen_entry_date();
  }
  $format = get_post_format();
  if ( current_theme_supports( 'post-formats', $format ) ) {
    printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
      sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'twentysixteen' ) ),
      esc_url( get_post_format_link( $format ) ),
      get_post_format_string( $format )
    );
  }
  if ( 'post' === get_post_type() ) {
    twentysixteen_entry_taxonomies();
  }
  if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
    echo '<span class="comments-link">';
    comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'twentysixteen' ), get_the_title() ) );
    echo '</span>';
  }
}