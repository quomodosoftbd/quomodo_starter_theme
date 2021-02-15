<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Q_Blog_Starter
 */

if ( ! function_exists( 'quomodo_starter_theme_prefix_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function quomodo_starter_theme_prefix_posted_on() {
		$time_string = '<time class="qs__blog__entry__date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="qs__blog__entry__date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'quomodo_starter_theme_prefix' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="qs__blog__posted__on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'quomodo_starter_theme_prefix_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function quomodo_starter_theme_prefix_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'quomodo_starter_theme_prefix' ),
			'<span class="qs__blog__post__author vcard"><a class="qs__blog__post__url" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="qs__blog__post__byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'quomodo_starter_theme_prefix_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function quomodo_starter_theme_prefix_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'quomodo_starter_theme_prefix' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="qs__blog__post__cat__links">' . esc_html__( 'Posted in %1$s', 'quomodo_starter_theme_prefix' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'quomodo_starter_theme_prefix' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="qs__blog__post__tags__links">' . esc_html__( 'Tagged %1$s', 'quomodo_starter_theme_prefix' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="qs__blog__post__screen__reader__text"> on %s</span>', 'quomodo_starter_theme_prefix' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="qs__blog__post__screen__reader__text">%s</span>', 'quomodo_starter_theme_prefix' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="qs__blog__post__edit__link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'quomodo_starter_theme_prefix_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function quomodo_starter_theme_prefix_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="qs__blog__post__thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;


function quomodo_starter_theme_prefix_comment_form(){
        // theme option panel 
		$comment_fld_cookie = quomodo_starter_theme_prefix_get_option('comment_cookie'); 
		$comment_fld_url = quomodo_starter_theme_prefix_get_option('comment_url'); 
		$comment_arg_be_note = quomodo_starter_theme_prefix_get_option('comment_before_note'); 
		$comment_arg_after_note = quomodo_starter_theme_prefix_get_option('comment_after_note'); 
	     
			//Declare Vars
		$comment_send      = esc_html__('Send','quomodo_starter_theme_prefix');
		$comment_reply     = esc_html__('Leave a Message','quomodo_starter_theme_prefix');
		$comment_reply_to  = esc_html__('Reply','quomodo_starter_theme_prefix');
		$comment_author    = esc_html__('Name','quomodo_starter_theme_prefix');
		$comment_email     = esc_html__('E-Mail','quomodo_starter_theme_prefix');
		$comment_body      = esc_html__('Comment','quomodo_starter_theme_prefix');
		$comment_url       = esc_html__('Website','quomodo_starter_theme_prefix');
		$comment_cookies_1 = esc_html__(' By commenting you accept the','quomodo_starter_theme_prefix');
		$comment_cookies_2 = esc_html__(' Privacy Policy','quomodo_starter_theme_prefix');
		$comment_before    = esc_html__('Registration isn\'t required.','quomodo_starter_theme_prefix');
		$comment_after     = esc_html__('Do not spam.','quomodo_starter_theme_prefix');
		$comment_cancel    = esc_html__('Cancel Reply','quomodo_starter_theme_prefix');
		$name_submit       = esc_html__('Submit','quomodo_starter_theme_prefix');
		
		//Array
		$comments_args = array(
			//Define Fields
			'fields' => array(
				//Author field
				'author' => '<div class="qs__blog__comment__comment__form__author"><input id="author" name="author" aria-required="true" placeholder="' . $comment_author .'"></input></div>',
				//Email Field
				'email' => '<div class="qs__blog__comment__comment__form__email"><input id="email" name="email" placeholder="' . $comment_email .'"></input></div>',
				
			),
			// Change the title of send button
			'label_submit' => $comment_send,
			// Change the title of the reply section
			'title_reply'        => $comment_reply,
			'title_reply_before' => '<h3 id="qs__blog__comment__comment__reply__title" class="qs__blog__comment__comment__reply__title">',
			'title_reply_after'  => '</h3>',
			// Change the title of the reply section
			'title_reply_to' => $comment_reply_to,
			//Cancel Reply Text
			'cancel_reply_link' => $comment_cancel,
			// Redefine your own textarea (the comment body).
			'comment_field' => '<div class="qs__blog__comment__form__comment"><textarea id="qs__blog__comment_textarea" name="comment" aria-required="true" placeholder="' . $comment_body .'"></textarea></div>',
			//Message Before Comment
			'comment_notes_before' => $comment_before,
			// Remove "Text or HTML to be displayed after the set of comment fields".
			'comment_notes_after' => $comment_after,
			//Submit Button ID
			'id_submit'       => 'qs__blog__comment__submit',
			'class_submit'    => 'qs__blog__comment__submit',
			'name_submit'     => $name_submit,
			'submit_button'   => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
			'submit_field'    => '<div class="qs__blog__comment__form__submit">%1$s %2$s</div>',
			'class_container' => 'qs__blog__comment_form_responds',
			'class_form'      => 'qs__blog__comment_form_action',
			'format'          => 'html5',
			
			
		);

		if( is_user_logged_in() ){
			$user              = wp_get_current_user();
			$user_identity     = $user->exists() ? $user->display_name : '';
			$comments_args['logged_in_as'] = sprintf(
				'<div class="qs__blog__comment__logged__in__as">%s</div>',
				sprintf(
					/* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
					__( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a href="%4$s">Log out?</a>','quomodo_starter_theme_prefix' ),
					get_edit_user_link(),
					/* translators: %s: User name. */
					esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.','quomodo_starter_theme_prefix' ), $user_identity ) ),
					$user_identity,
					/** This filter is documented in wp-includes/link-template.php */
					wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ), get_the_ID() ) )
				)
				);
			
		}

		if( $comment_fld_cookie ){
			 //Cookies
		   $comments_args['fields']['cookies'] =  '<input class="qs__blog__comment_cookies" type="checkbox" required>' . $comment_cookies_1 . '<a href="' . get_privacy_policy_url() . '">' . $comment_cookies_2 . '</a>';	
		}else{
			remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );
		}
		
		$comments_args['fields']['url'] = '<div class="qs__blog__comment__comment__form__url"><input id="url" name="url" placeholder="' . $comment_url .'"></input></div>';	
		if( !$comment_fld_url ){
			$comments_args['fields']['url'] = '';	
		}

		if( !$comment_arg_be_note ){
			$comments_args['comment_notes_before'] = '';
		}
		if(!$comment_arg_after_note){
			$comments_args['comment_notes_after'] = '';
		}
		comment_form( $comments_args );
}

add_filter('get_comment_author_link', 'quomodo_starter_theme_prefix__comment_author_link',10,3);

if( !function_exists('quomodo_starter_theme_prefix__comment_author_link') ){
   function quomodo_starter_theme_prefix__comment_author_link($return, $author, $comment_ID){

		$comment = get_comment( $comment_ID );
		$url     = get_comment_author_url( $comment );
		$author  = get_comment_author( $comment );
	
		if ( empty( $url ) || 'http://' === $url ) {
			$return = $author;
		} else {
			$return = "<a href='$url' rel='external nofollow ugc' class='qs__post__comment__author__url'>$author</a>";
		}

		return $return;
   }
}

function quomodo_starter_theme_prefix_get_option($key,$default=''){
    if($default !=''){
		return $default;
	}
    return false;
}

add_filter( 'get_search_form','quomodo_starter_theme_prefix_search_form' );

/*-------------------------------------
    SEARCH PAGE SEARCH FORM
-------------------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_search_form') ) {
    function quomodo_starter_theme_prefix_search_form() {

        $search_btn_icon_enable = quomodo_starter_theme_prefix_get_option('widget_search_button_icon_enable',true);
        $search_btn_icon        = quomodo_starter_theme_prefix_get_option('widget_search_button_icon','fa fa-search');
        $button                 = esc_html__('Search', 'quomodo_starter_theme_prefix');
		
		if( $search_btn_icon_enable && $search_btn_icon !='' ){
			$button = "<i class='$search_btn_icon'></i>";	
		}

        $html =  '<div class="qs__blog__search__form_container">            
            <form class="qs__blog__search__form" action="'.esc_url(home_url('/')).'" method="get">
                <input type="text" name="s" class="qs__blog__search__field" id="search" placeholder="'.esc_html__('Search query', 'quomodo_starter_theme_prefix').'" value="'. get_search_query().'">
                <button type="submit" class="qs__blog__search__submit qs__blog__search___btn">'. $button .'</button>
            </form>
        </div>';
        
		return $html;
    }
}