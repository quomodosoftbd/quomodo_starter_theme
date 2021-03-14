<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Q_Blog_Starter
 */

/* -----------------------------------------
	POSTED DATE
----------------------------------------- */
if ( ! function_exists( 'quomodo_starter_theme_prefix_posted_date' ) ) :
	function quomodo_starter_theme_prefix_posted_date() {
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

		$posted_date = '<i class="beicons-046-calendar"></i> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';


		echo '<div class="qs__blog__posted__date">' . $posted_date . '</div>';

	}
endif;



/* -----------------------------------------
	POSTED BY AUTHOR
----------------------------------------- */
if ( ! function_exists( 'quomodo_starter_theme_prefix_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function quomodo_starter_theme_prefix_posted_by() {
		$byline = '<i class="beicons-035-author"></i> <span class="qs__blog__post__author vcard"><a class="qs__blog__post__url" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

		echo '<div class="qs__blog__posted__by"> ' . $byline . '</div>';

	}
endif;


/* -----------------------------------------
	POST IN CATEGORY
----------------------------------------- */
if ( ! function_exists( 'quomodo_starter_theme_prefix_post_in_category' ) ) :
	function quomodo_starter_theme_prefix_post_in_category(){
		if ( 'post' === get_post_type() ) {
			$categories_list = get_the_category_list( esc_html__( ', ', 'quomodo_starter_theme_prefix' ) );
			if ( $categories_list ) {
				echo '<div class="qs__blog__post__cat__links"><i class="beicons-028-folder"></i> ' . $categories_list . '</div>';
			}
		}	
	}
endif;

/*-----------------------------
	RANDOM SINGLE CATEGORY
------------------------------*/
if ( !function_exists( 'quomodo_starter_theme_prefix_single_category_retrip' ) ): 
	function quomodo_starter_theme_prefix_single_category_retrip(){

		if ( 'post' === get_post_type() ) {
			$category        = get_the_category();
			$cat_count       = count($category);
			$single_cat      = $category[random_int( 0, $cat_count-1 )];
			if ( get_the_category() ) {
				echo '<div class="qs__blgo__single__category"><a href="'.esc_url( get_category_link( $single_cat->term_id ) ).'">'.esc_html( $single_cat->cat_name ).'</a></div>';
			}
		}
	}
endif;

/* -----------------------------------------
	POST TAGS
----------------------------------------- */
if ( ! function_exists( 'quomodo_starter_theme_prefix_post_in_tags' ) ) :
	function quomodo_starter_theme_prefix_post_in_tags(){
		if ( 'post' === get_post_type() ) {
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'quomodo_starter_theme_prefix' ) );
			if ( $tags_list ) {
				echo '<div class="qs__blog__post__tags__links"><span class="qs__blog__tags__title">'.esc_html__('Tags:', 'quomodo_starter_theme_prefix').'</span> ' .  $tags_list . '</div>';
			}
		}	
	}
endif;

/*-----------------------------
	RANDOM SINGLE TAG
------------------------------*/
if ( !function_exists( 'quomodo_starter_theme_prefix_single_tag_retrip' ) ): 
	function quomodo_starter_theme_prefix_single_tag_retrip(){

		if ( 'post' === get_post_type() ) {

			if ( has_tag() ) {
				$tags       = get_the_tags();
				$tag_count  = count($tags);
				$single_tag = $tags[random_int( 0, $tag_count-1 )];

				if ( get_the_tags() ) {
					echo '<div class="qs__blog__single__tag"><a href="'.esc_url( get_category_link( $single_tag->term_id ) ).'">'.esc_html( $single_tag->name ).'</a></div>';
				}
			}
		}
	}
endif;

/*---------------------------
	COMMENT COUNT
----------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_comment_count') ) :
	function quomodo_starter_theme_prefix_comment_count(){
	    if (! post_password_required() && ( comments_open() || get_comments_number() ) && get_comments_number() > 0 ) {
	        $comment_count = get_comments_number_text(esc_html__('0 Comment','quomodo_starter_theme_prefix'),esc_html__('1 Comment','quomodo_starter_theme_prefix'),esc_html__('% Comments','quomodo_starter_theme_prefix'));
	        echo '<div class="post__comment__count">
			        <i class="beicons-012-chat"></i>
			        <a class="comment__count" href="'.get_the_permalink().'">'.$comment_count.'</a>
		        </div>';
	    }
	}
endif;

/* -----------------------------------------
	POST READMORE
----------------------------------------- */
if ( ! function_exists( 'quomodo_starter_theme_prefix_post_readmore_btn' ) ) :
	function quomodo_starter_theme_prefix_post_readmore_btn(){
		echo '<div class="qs__blog__post__readmore">
			<a href="'.get_the_permalink().'">'.esc_html__( 'Read More', 'quomodo_starter_theme_prefix' ).'</a>
		</div>';
	}
endif;



if ( ! function_exists( 'quomodo_starter_theme_prefix_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function quomodo_starter_theme_prefix_entry_footer() {

		if( is_single() ){
			quomodo_starter_theme_prefix_post_in_tags();
		}else{
			quomodo_starter_theme_prefix_posted_by();
			quomodo_starter_theme_prefix_post_readmore_btn();
		}
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
        $search_btn_icon        = quomodo_starter_theme_prefix_get_option('widget_search_button_icon','beicons-013-search');
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