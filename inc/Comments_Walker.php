<?php


class quomodo_starter_theme_prefix_Custom_Walker_Comment extends Walker_Comment {

    /** 
     * Outputs a comment in the HTML5 format.
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    
    protected function html5_comment( $comment, $depth, $args ) {
 
        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
       
        ?>
        <<?php echo $tag; ?> id="qs__post__comment__item__<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'qs__post__comment__item qs__post__parent__comment' : 'qs__post__comment__item', $comment ); ?>>
            <div id="qs__post__comment__body-<?php comment_ID(); ?>" class="qs__post__comment__body"> <!-- .qs__post__comment__body -->
                <div class="qs__post__comment__meta"><!-- .qs__post__comment__meta -->
                    <div class="qs__post__comment__author qs__post__comment__vcard"><!-- .qs__post__comment__author -->
                        <?php

                        $comment_author_link = get_comment_author_link( $comment );
                        $comment_author_url  = get_comment_author_url( $comment );
                        $comment_author      = get_comment_author( $comment );
                        $avatar              = get_avatar( $comment, $args['avatar_size'] );

                        if ( 0 != $args['avatar_size'] ) {
                            if ( empty( $comment_author_url ) ) {
                                echo $avatar;
                            } else {
                                printf( '<a href="%s" rel="external nofollow" class="qs__post__comment__url">', $comment_author_url );
                                echo $avatar;
                            }
                        }
 
                        if ( ! empty( $comment_author_url ) ) {
                            echo '</a>';
                        }

                        printf(
                            /* translators: %s: comment author link */
                            wp_kses(
                                __( '%s <span class="qs__post__comment__screen__reader__text says">says:</span>', 'quomodo_starter_theme_prefix' ),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            '<div class="qs__post__comment__fn">' . get_comment_author_link( $comment ) . '</div>'
                        );
                        ?>
                    </div><!-- .qs__post__comment__author -->
 
                    <div class="qs__post__comment__metadata">
                        <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                            <?php
                                /* translators: 1: comment date, 2: comment time */
                                $comment_timestamp = sprintf( __( '%1$s at %2$s', 'quomodo_starter_theme_prefix' ), get_comment_date( '', $comment ), get_comment_time() );
                            ?>
                            <time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo $comment_timestamp; ?>">
                                <?php echo $comment_timestamp; ?>
                            </time>
                        </a>
                        <?php
                           
                            edit_comment_link( __( 'Edit', 'quomodo_starter_theme_prefix' ), '<span class="qs__post__comment__edit__link__sep"></span> <span class="qs__post__comment__edit__link"></span>' );
                        ?>
                    </div><!-- .qs__post__comment__metadata -->
 
                    <?php if ( '0' == $comment->comment_approved ) : ?>
                        <p class="qs__post__comment__awaiting__moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'quomodo_starter_theme_prefix' ); ?></p>
                    <?php endif; ?>

                </div><!-- .qs__post__comment__meta -->
 
                <div class="qs__post__comment__content">
                    <?php comment_text(); ?>
                </div><!-- .qs__post__comment__content -->
 
            </div><!-- .qs__post__comment__body -->
 
            <?php
                comment_reply_link(
                    array_merge(
                        $args,
                        array(
                            'add_below' => 'qs__post__comment__body',
                            'depth'     => $depth,
                            'max_depth' => $args['max_depth'],
                            'before'    => '<div class="qs__post__comment__reply">',
                            'after'     => '</div>',
                        )
                    )
                );
            ?>
        <?php
    }
}