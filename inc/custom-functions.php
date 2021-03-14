<?php

/*---------------------------
    BODY OPEN FUNCTION
----------------------------*/
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/*----------------------------
    GET SVG LOGO
------------------------------*/
if ( !function_exists( 'quomodo_starter_theme_prefix_get_logo_type_tag' ) ) {
    function quomodo_starter_theme_prefix_get_logo_type_tag( $url='' ){
        if( $url == '' ){
            return '<img src="'.esc_url( $url ).'" alt="'.get_bloginfo( 'name' ).'">';
        }
        try{
            $url_basename = basename( $url ); 
            $svg_ext      = explode( '.',$url_basename )[1];

            if( $svg_ext != 'svg' ){
                return '<img src="'.esc_url( $url ).'" alt="'.get_bloginfo( 'name' ).'">';
            }
            $get_svg_file = wp_remote_get( $url );
            $svg_file     = wp_remote_retrieve_body( $get_svg_file );
            $find_string  = '<svg';
            $position     = strpos( $svg_file, $find_string );
            $new_svg_file = substr( $svg_file, $position );
            return $new_svg_file;
        }catch( \Exception $e ) {
            return '<img src="'.esc_url( $url ).'" alt="'.get_bloginfo( 'name' ).'">';
        }
    }
}


/*----------------------------
    LOGO WITH STICKY
------------------------------*/
if ( !function_exists( 'quomodo_starter_theme_prefix_logo_with_sticky' ) ){
    function quomodo_starter_theme_prefix_logo_with_sticky(){
        $default_logo = get_theme_mod( 'custom_logo' );
        $default_logo = wp_get_attachment_image_url( $default_logo, 'full');

        $logo        = quomodo_starter_theme_prefix_get_option( 'logo' );
        $logo        = isset( $logo['url'] ) ? $logo['url'] : '';

        $sticky_logo = quomodo_starter_theme_prefix_get_option( 'sticky_logo' );
        $sticky_logo = isset( $sticky_logo['url'] ) ? $sticky_logo['url'] : '';

        if ( '' == $default_logo && isset( $logo ) ) {
            $default_logo = $logo;
        }

        if ( '' == $sticky_logo && quomodo_starter_theme_prefix_get_option( 'sticky_menu' ) == true ) {
            $sticky_logo = $default_logo;
        }

        /*---------------------------
            OVERWRITE PAGE LOGO
        ----------------------------*/
        $page_meta_array  = quomodo_starter_theme_prefix_metabox_value('_quomodo_starter_theme_prefix_page_metabox');
        $page_logo_switch = isset( $page_meta_array['overwrite_page_logo'] ) ? $page_meta_array['overwrite_page_logo'] : false;

        if( is_page() && '1' == $page_logo_switch ){            
            $page_default_logo = $page_meta_array['logo'];
            $page_sticky_logo  = $page_meta_array['sticky_logo'];
            $default_logo      = isset( $page_meta_array['logo']['url'] ) ? $page_meta_array['logo']['url'] : $default_logo;
            $sticky_logo       = isset( $page_meta_array['sticky_logo']['url'] ) ? $page_meta_array['sticky_logo']['url'] : $sticky_logo;

            if ( empty( $sticky_logo ) && quomodo_starter_theme_prefix_get_option( 'sticky_menu' ) == true ) {
                $sticky_logo = $default_logo;
            }
        }
        
        ?>
        <?php if ( !empty( $default_logo ) &&  !empty( $sticky_logo ) ) : ?>
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="custom-logo-link default-logo">
                <?php echo quomodo_starter_theme_prefix_get_logo_type_tag( $default_logo ); ?>
            </a>
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="custom-logo-link sticky-logo">
                <?php echo quomodo_starter_theme_prefix_get_logo_type_tag( $sticky_logo ); ?>
            </a>
        <?php elseif( !empty( $default_logo ) && empty( $sticky_logo ) && quomodo_starter_theme_prefix_get_option('sticky_menu') == false ): ?>
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="custom-logo-link">
                <?php echo quomodo_starter_theme_prefix_get_logo_type_tag( $default_logo ); ?>
            </a>
        <?php else: ?>
        <h3>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
            </a>
        </h3>
    <?php  endif;
    }
}

/*---------------------------
    DEFAULT LOGO
----------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_default_logo') ) {
    function quomodo_starter_theme_prefix_default_logo(){
        if ( has_custom_logo() ) :
            the_custom_logo('navbar-brand'); 
        else: ?>
            <h3>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php echo esc_html( get_bloginfo('name') ); ?>
                </a>
            </h3>
        <?php
        endif;
    }
}



/*----------------------------
    PAGE TITLE
-----------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_title') ) {
    function quomodo_starter_theme_prefix_title(){ ?>
        <?php
            if ( is_page() ) {
                $page_meta_array = quomodo_starter_theme_prefix_metabox_value('_quomodo_starter_theme_prefix_page_metabox');
                $enable_title    = isset( $page_meta_array['enable_title'] ) ? $page_meta_array['enable_title'] : false;
                $custom_title    = isset( $page_meta_array['custom_title'] ) ? $page_meta_array['custom_title'] : '';
            }
            $quomodo_starter_theme_prefix_blog_title = quomodo_starter_theme_prefix_get_option( 'blog_page_title' );
        ?>
        <div class="barner-area white">
            <div class="barner-area-bg"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        
                        <?php if ( (is_home() && is_front_page() ) || is_page_template( 'blog-classic.php' ) ) : ?>

                            <div class="page-title">
                                <?php if( $quomodo_starter_theme_prefix_blog_title == !'' ): ?>
                                    <h1><?php echo esc_html( $quomodo_starter_theme_prefix_blog_title ); ?></h1>
                                <?php else: ?>
                                <h1>
                                    <?php esc_html_e('Blog Page','itbin'); ?>
                                </h1>
                                <?php endif; ?>

                                <?php if (get_bloginfo( 'description')) :?>
                                <p>
                                    <?php bloginfo( 'description' ); ?>
                                </p>
                                <?php endif; ?>
                            </div>

                        <?php elseif( is_page() ): ?>
                        
                            <div class="page-title">
                                <h1>
                                    <?php
                                        if ( $enable_title == true && !empty($custom_title) ) {
                                            echo esc_html( $custom_title );
                                        }else{
                                           wp_title( $sep = ' ');
                                        }
                                     ?>
                                </h1>
                            </div>

                            <?php if( '1' == quomodo_starter_theme_prefix_get_option( 'show_page_breadcrumb', true ) ) : ?>
                            <div class="breadcumb">
                                <?php if (function_exists('quomodo_starter_theme_prefix_breadcrumbs')) {
                                    quomodo_starter_theme_prefix_breadcrumbs();
                                } ?>
                            </div>
                            <?php endif; ?>

                        <?php elseif( is_single() ): ?>

                            <div class="page-title">
                                <h1>
                                    <?php
                                        if ( 'portfolio' == get_post_type() ) {
                                            $title_text = quomodo_starter_theme_prefix_get_option('portfolio_custom_title') ? quomodo_starter_theme_prefix_get_option('portfolio_custom_title') : 'Work Details';
                                            if ( '1' == quomodo_starter_theme_prefix_get_option('enable_portfolio_custom_title' ) && !empty( $title_text ) ) {
                                                echo esc_html( $title_text );
                                            }else{
                                                wp_title( $sep = ' ');
                                            }
                                        }else{
                                            $title_text = quomodo_starter_theme_prefix_get_option('post_custom_title') ? quomodo_starter_theme_prefix_get_option('post_custom_title') : 'News Details';
                                            if ( '1' == quomodo_starter_theme_prefix_get_option('enable_post_custom_title' ) && !empty( $title_text ) ) {
                                                echo esc_html( $title_text );
                                            }else{
                                                wp_title( $sep = ' ');
                                            }
                                        }
                                    ?>
                                </h1>
                                
                                <?php if( '1' == quomodo_starter_theme_prefix_get_option( 'show_post_breadcrumb', true ) ) : ?>
                                <div class="breadcumb">
                                    <?php if ( function_exists('quomodo_starter_theme_prefix_breadcrumbs') ) {
                                        quomodo_starter_theme_prefix_breadcrumbs();
                                    } ?>
                                </div>
                                <?php endif; ?>

                            </div>
                            <?php if ( '1' == quomodo_starter_theme_prefix_get_option('enable_post_barner_top_meta' ) ) :?>
                            <div class="breadcumb">
                                <?php quomodo_starter_theme_prefix_posted_on(); ?>
                            </div>
                            <?php endif; ?>

                            <?php if( get_post_type() === 'post' ) : ?>

                                <?php
                                    global $post;
                                    $author_id   = $post->post_author;
                                    $user_id     = get_current_user_id();
                                    $usermeta    = get_user_meta( $user_id,'quomodo_starter_theme_prefix_profile_options',true );
                                    $designation = isset( $usermeta['designation'] ) ? $usermeta['designation'] : '';
                                ?>
                                <div class="single__post__author">
                                    <a class="author__thumbnail" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ); ?>">
                                        <img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'email', $author_id ) ) ); ?>" alt="<?php the_title_attribute( array('echo' => true)); ?>">
                                    </a>
                                    <div class="signle__post__author__details">
                                    <a class="author__link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'display_name', $author_id ) ) ); ?>"><?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></a>
                                    <p class="author__desig"><?php echo esc_html( $designation ); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                        <?php elseif( is_search() ): ?>

                            <div class="page-title">
                                <h1><?php esc_html_e( 'Search Results', 'itbin' ); ?></h1>
                                <p><?php  printf(__( 'Search Result For "%s"','itbin'), get_search_query() ) ?></p>
                            </div>
                            
                        <?php elseif(is_archive()): ?>
                            
                            <?php if ( isset($_GET['author_downloads'] ) && $_GET['author_downloads'] == 'true' ) :?>

                                <?php get_template_part( 'edd/author/author-download-top-meta' ); ?>
                                
                            <?php else: ?>

                                <div class="page-title">
                                    <h1>
                                        <?php the_archive_title(); ?>
                                    </h1>
                                </div>
                                <div class="breadcumb">
                                    <?php
                                        if (function_exists('quomodo_starter_theme_prefix_breadcrumbs')) {
                                            quomodo_starter_theme_prefix_breadcrumbs();
                                        }
                                    ?>
                                    <p>
                                        <?php the_archive_description(); ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                        <?php else: ?>

                            <div class="page-title">
                                <h1>
                                    <?php wp_title( $sep = ' '); ?>
                                </h1>
                            </div>
                            <div class="breadcumb">
                                <p>
                                    <?php bloginfo( 'description' ); ?>
                                </p>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
            <?php
                if ( 'post' === get_post_type() && is_single() && function_exists( 'quomodo_starter_theme_prefix_post_barner_multimeta' ) && '1' == quomodo_starter_theme_prefix_get_option('enable_post_barner_bottom_meta' ) ) {
                    quomodo_starter_theme_prefix_post_barner_multimeta();
                }
            ?>
        </div>
    <?php
    }
}


/*------------------------------
    COMMENT FORM FIELD
-------------------------------*/
if( ! function_exists('quomodo_starter_theme_prefix_comment_form_default_fields') ){

    function quomodo_starter_theme_prefix_comment_form_default_fields($fields){
        global $aria_req;
        $commenter     = wp_get_current_commenter();
        $req           = get_option( 'require_name_email' );
        $aria_req      = ($req ? " aria-required='true' " : '');
        $required_text = ' ';    
        $fields        =  array(
            'author'   => '<div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <input type="text" name="author" value="'.esc_attr( $commenter['comment_author'] ).'" '.$aria_req.' placeholder="'.esc_attr__( 'Your Name *', 'itbin' ).'">
                            </div>',
            'email'    => '<div class="col-sm-6">
                                <input type="email" name="email" value="'.esc_attr( $commenter['comment_author_email'] ).'" '.$aria_req.' placeholder="'.esc_attr__( 'Your Email *', 'itbin' ).'">
                            </div>
                        </div>
                    </div>',
            'url'      => '<div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="url" name="url" value="'.esc_url( $commenter['comment_author_url'] ).'" '.$aria_req.' placeholder="'.esc_attr__( 'Your Website', 'itbin' ).'">
                                    </div>
                                </div>
                            </div>'
        );
        return $fields;
    }
}
add_filter('comment_form_default_fields', 'quomodo_starter_theme_prefix_comment_form_default_fields');



/*-----------------------------------------
    OVERWRITE COMMENT FORM DEFAULT
-------------------------------------------*/
if( ! function_exists('quomodo_starter_theme_prefix_comment_form_defaults') ){

    function quomodo_starter_theme_prefix_comment_form_defaults( $defaults ) {
        global $aria_req;
        $defaults = array(
            'class_form'    => 'comment-form',
            'title_reply'   => esc_html__( 'Leave A Comment', 'itbin' ),
            'comment_field' => '<div class="form-group mb0">
                                    <textarea name="comment" placeholder="'.esc_attr__( 'Your Comment', 'itbin' ).'" '.$aria_req.' rows="10"></textarea>    
                                </div>',
            'comment_notes_before'  => '',
            'label_submit'  => esc_html__( 'Post Comment', 'itbin' ),
        );
        return $defaults;
    }    
}
add_filter( 'comment_form_defaults', 'quomodo_starter_theme_prefix_comment_form_defaults' );


function quomodo_starter_theme_prefix_comment_form(){
    // theme option panel 
    $comment_fld_cookie     = quomodo_starter_theme_prefix_get_option('comment_cookie');
    $comment_fld_url        = quomodo_starter_theme_prefix_get_option('comment_url');
    $comment_arg_be_note    = quomodo_starter_theme_prefix_get_option('comment_before_note');
    $comment_arg_after_note = quomodo_starter_theme_prefix_get_option('comment_after_note');
     
        //Declare Vars
    $comment_send      = esc_html__('Submit Comment','quomodo_starter_theme_prefix');
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
            'author' => '<div class="row"><div class="col-6"> <div class="qs__blog__comment__comment__form__author"><input id="author" name="author" aria-required="true" placeholder="' . $comment_author .'"></input></div></div>',
            //Email Field
            'email' => '<div class="col-6"><div class="qs__blog__comment__comment__form__email"><input id="email" name="email" placeholder="' . $comment_email .'"></input></div></div></div>',
            
        ),
        // Change the title of send button
        'label_submit' => $comment_send,
        // Change the title of the reply section
        'title_reply'        => $comment_reply,
        'title_reply_before' => '<div class="qs__blog__comment__form__title__header"><h3 id="qs__blog__comment__comment__reply__title" class="qs__blog__comment__comment__reply__title">',
        'title_reply_after'  => '</h3></div>',
        // Change the title of the reply section
        'title_reply_to' => $comment_reply_to,
        //Cancel Reply Text
        'cancel_reply_link' => $comment_cancel,
        // Redefine your own textarea (the comment body).
        'comment_field' => '<div class="row"><div class="col-12"><div class="qs__blog__comment__form__comment"><textarea rows="10" id="qs__blog__comment_textarea" name="comment" aria-required="true" placeholder="' . $comment_body .'"></textarea></div></div></div>',
        //Message Before Comment
        'comment_notes_before' => $comment_before,
        // Remove "Text or HTML to be displayed after the set of comment fields".
        'comment_notes_after' => $comment_after,
        //Submit Button ID
        'id_submit'       => 'qs__blog__comment__submit',
        'class_submit'    => 'qs__blog__comment__submit',
        'name_submit'     => $name_submit,
        'submit_button'   => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        'submit_field'    => '<div class="row"><div class="col-12"><div class="qs__blog__comment__form__submit">%1$s %2$s</div></div></div>',
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
    
    $comments_args['fields']['url'] = '<div class="row"><div class="col-12"><div class="qs__blog__comment__comment__form__url"><input id="url" name="url" placeholder="' . $comment_url .'"></input></div></div></div>';	
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

/*--------------------------
    POSTS PAGINATION
---------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_pagination') ) {
    function quomodo_starter_theme_prefix_pagination(){
        the_posts_pagination(array(
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="fas fa-chevron-left"></i>',
            'next_text'          => '<i class="fas fa-chevron-right"></i>',
            'type'               => 'list',
            'mid_size'           => 1,
        ));
    }
}

/*------------------------
    POSTS PAGINATION CUSTOM
-------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_custom_pagination') ) {
    function quomodo_starter_theme_prefix_custom_pagination( $query = false ){

        global $wp_query;
        if ($query) {
            $temp_query = $wp_query;
            $wp_query   = $query;
        }

        /*Return early if there's only one page.*/
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }

        $big_data = 999999999;
        echo '<nav class="navigation pagination"><div class="nav-links">';
        echo paginate_links(array(
            'prev_text'          => '<i class="fas fa-chevron-left"></i>',
            'next_text'          => '<i class="fas fa-chevron-right"></i>',
            'screen_reader_text' => ' ',
            'mid_size'           => 1,
            'base'               => get_pagenum_link(1) . '%_%',
            'base'               => str_replace($big_data, '%#%', esc_url(get_pagenum_link($big_data))),
            'format'             => 'page/%#%',
            'current'            => max( 1, get_query_var('paged') ),
            'total'              => $wp_query->max_num_pages,
            'prev_next'          => true,
            'type'               => 'list',
        ));
        echo '</div></nav>';
    }
}

/*------------------------
    POSTS NAVIGATION
--------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_navigation') ) {
    function quomodo_starter_theme_prefix_navigation(){
        the_posts_navigation(array(
            'screen_reader_text' => ' ',        
            'prev_text'          => '<i class="ti ti-angle-double-left"></i> '.esc_html__( 'Older posts', 'itbin' ),
            'next_text'          => esc_html__( 'Newer posts', 'itbin' ).' <i class="ti ti-angle-double-right"></i>',
        )); 
    }
}

/*------------------------
    SINGLE POST NAVIGATION
--------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_single_navigation') ) {
    function quomodo_starter_theme_prefix_single_navigation(){
        the_post_navigation( array(
            'screen_reader_text' => ' ',  
            'prev_text'          => '<i class="ti ti-angle-double-left"></i> '.esc_html__( 'Prev Post', 'itbin' ),
            'next_text'          => esc_html__( 'Next Post', 'itbin' ).' <i class="ti ti-angle-double-right"></i>',
        ));
    }
}

/*----------------------
    SINGLE POST NAVIGATION
------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_post_navigation') ) {
    function quomodo_starter_theme_prefix_post_navigation(){
        global $post;
        $next_post = get_adjacent_post(false, '', false);
        $prev_post = get_adjacent_post(false, '', true);

        $show_center_grid    = get_option('show_post_navigation_center_grid', 1 );
        $show_icon           = get_option('show_post_navigation_icon', 1 );
        $show_nextprev_text  = get_option('show_post_navigation_label', 1 );
        $show_post_title = get_option('show_post_navigation_post_title', 1 );
        ?>
        <div class="qs__blog__single__post__navigation">

            <?php if( !empty($prev_post) ): ?>
            <div class="qs__blog__prev__post">
                <a href="<?php echo esc_url( get_permalink($prev_post->ID) ); ?>">
                    <div class="qs__navigation__title__with__link">
                        <?php if( $show_nextprev_text == true ) : ?>
                            <?php if( $show_icon == true ) : ?>
                                <div class="qs__navigation__arrow__icon">
                                    <i class="fa fa-arrow-left"></i>
                                </div>
                            <?php endif; ?>
                            <span class="qs__navigation__nextprev__text"><?php esc_html_e( 'Prev Post', 'itbin' ) ?></span>
                        <?php endif; ?>
                        <?php if( $show_post_title == true ) : ?>
                            <h3 class="qs__blog__post__nvigation__title"><?php echo esc_html( wp_trim_words( $prev_post->post_title, 4, '.' ) ); ?></h3>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <?php endif; ?>
            
            <?php if( $show_center_grid == true ) : ?>
            <div class="qs__blog__single__post__navigation__center__grid">
                <a href="<?php echo esc_url( home_url('/') ) ?>"><i class="fa fa-th-large"></i></a>
            </div>
            <?php endif; ?>

            <?php if( !empty($next_post) ): ?>
            <div class="qs__blog__next__post">
                <a href="<?php echo esc_url( get_permalink($next_post->ID) ); ?>">
                    <div class="qs__navigation__title__with__link">
                        <?php if( $show_nextprev_text == true ) : ?>
                            <span class="qs__navigation__nextprev__text"><?php esc_html_e( 'Next Post', 'itbin' ) ?></span>
                            <?php if( $show_icon == true ) : ?>
                                <div class="qs__navigation__arrow__icon">
                                    <i class="fa fa-arrow-right"></i>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if( $show_post_title == true ) : ?>
                            <h3 class="qs__blog__post__nvigation__title"><?php echo esc_html( wp_trim_words( $next_post->post_title, 4, '.' ) ); ?></h3>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
            <?php endif; ?>

        </div>
    <?php
    }
}

/*------------------------
    COMMENTS PAGINATION
-------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_comments_pagination') ) {
    function quomodo_starter_theme_prefix_comments_pagination(){
        the_comments_pagination(array(
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="fas fa-chevron-left"></i>',
            'next_text'          => '<i class="fas fa-chevron-right"></i>',
            'type'               => 'list',
            'mid_size'           => 1,
            'class' => 'qs__blog__comments__pagination',
        ));
    }
}

function quomodo_starter_theme_prefix_comments_pagination_markup( $template, $class ){
    $template = str_replace('nav-links','qs__blog__comments__pagination__links',$template);
    return $template;
}
add_filter('navigation_markup_template', 'quomodo_starter_theme_prefix_comments_pagination_markup',10,2);


/*------------------------
    COMMENTS NAVIGATION
-------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_comments_navigation') ) {
    function quomodo_starter_theme_prefix_comments_navigation(){
        the_comments_navigation(array(
            'screen_reader_text' => ' ',
            'prev_text'          => '<i class="ti ti-angle-double-left"></i> '.esc_html__( 'Older Comments ', 'itbin' ),
            'next_text'          => esc_html__( 'Newer Comments', 'itbin' ).' <i class="ti ti-angle-double-right"></i>',
        ));
    }
}

/*----------------------------------
    SINGLE POST / PAGES LINK PAGES
------------------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_link_pages') ) {
    function quomodo_starter_theme_prefix_link_pages(){
        wp_link_pages( array(
            'before'           => '<div class="page-links post-pagination"><p>' . esc_html__( 'Pages:', 'itbin' ).'</p><ul><li>',
            'separator'        => '</li><li>',
            'after'            => '</li></ul></div>',
            'next_or_number'   => 'number',
            'nextpagelink'     => esc_html__( 'Next Page', 'itbin'),
            'previouspagelink' => esc_html__( 'Prev Page', 'itbin' ),
        ));
    }
}

/*----------------------------
    SEARCH FORM
------------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_search_form') ) {
    function quomodo_starter_theme_prefix_search_form(  $search_buttton=true, $is_button=true ) {
        ?>
        <div class="search-form">
            <form id="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" id="search" placeholder="<?php esc_attr_e('Search ...', 'itbin'); ?>" name="s">
                <?php if( $search_buttton == true ) : ?>
                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                <?php endif; ?>
            </form>
            <?php if( $is_button==true ) : ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="home_btn"> <?php esc_html_e('Back to home Page', 'itbin'); ?> </a>
            <?php endif; ?>
        </div>
        <?php
    }
}



/*------------------------------
    POST PASSWORD FORM
-------------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_password_form') ) {
    function quomodo_starter_theme_prefix_password_form($form) {
        global $post;
        $label  =   'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
        $form   =   '<form class="qs__blog__post__pass__form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
                        <span>'.esc_html__( "To view this protected post, enter the password below:", 'itbin' ).'</span>
                        <input name="post_password" id="' . $label . '" type="password"  placeholder="'.esc_attr__( "Enter Password", 'itbin' ).'">
                        <button type="submit" name="Submit">'.esc_attr__( "Submit",'itbin' ).'</button>

                    </form>';

        return $form;
    }
}
add_filter( 'the_password_form', 'quomodo_starter_theme_prefix_password_form' );


/*-------------------------------
    ADD CATEGORY NICENAMES IN BODY AND POST CLASS
--------------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_post_class') ) {
   function quomodo_starter_theme_prefix_post_class( $classes ) {
    
        global $post;
        if ( 'page' === get_post_type() ) {
            if(!has_post_thumbnail()) {
                $classes[] = 'no-post-thumbnail';
            }
        }

        if ( 'post' === get_post_type() ) {


            if ( is_page_template( 'blog-classic.php' ) ) {
                $classes[] = 'blog-classic';
            }

            if ( !is_single() ) {
                $classes[] = 'qs__post__item';
            }
        }
        return $classes;
    }
}
add_filter( 'post_class', 'quomodo_starter_theme_prefix_post_class' );


/*-------------------------------
    DAY LINK TO ARCHIVE PAGE
---------------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_day_link') ) {
    function quomodo_starter_theme_prefix_day_link() {
        $archive_year   = get_the_time('Y');
        $archive_month  = get_the_time('m');
        $archive_day    = get_the_time('d');
        echo get_day_link( $archive_year, $archive_month, $archive_day);
    }
}

/*--------------------------------
    GET COMMENT COUNT TEXT
----------------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_comment_count_text') ) {
    function quomodo_starter_theme_prefix_comment_count_text($post_id) {
        $comments_number = get_comments_number($post_id);
        if($comments_number==0) {
            $comment_text = esc_html__('No comment', 'itbin');
        }elseif($comments_number == 1) {
            $comment_text = esc_html__('One comment', 'itbin');
        }elseif($comments_number > 1) {
            $comment_text = $comments_number.esc_html__(' Comments', 'itbin');
        }
        echo esc_html($comment_text);
    }
}

/*------------------------------------------
    GET POST TYPE ARRAY
--------------------------------------------*/
if ( !function_exists('quomodo_starter_theme_prefix_get_post_array') ) {
    function quomodo_starter_theme_prefix_get_post_array($post_type = 'elementor_library') {
        $query  = new WP_Query(
            array (
                'post_type'      => $post_type,
                'posts_per_page' => -1
            )
        );
        $posts_array = $query->posts;
        if( $posts_array ) {
            $post_title_array = wp_list_pluck( $posts_array, 'post_title', 'ID' );
        }else{
            $post_title_array['default'] = esc_html__( 'Default', 'itbin' );
        }
        return $post_title_array;
    }
}



/**
 * Remove schema attributes from custom logo html
 *
 * @param string $html
 * @return string
 */
function quomodo_starter_theme_prefix_remove_custom_logo_schema_attr( $html ) {
    return str_replace( array( 'itemprop="url"', 'itemprop="logo"' ), '', $html );
}
add_filter( 'get_custom_logo', 'quomodo_starter_theme_prefix_remove_custom_logo_schema_attr' );


/**
 * Remove schema attributes from oembed iframe html
 *
 * @param string $html
 * @return string
 */
function quomodo_starter_theme_prefix_remove_oembed_schema_attr($return, $data, $url){
    if( is_object( $data ) ){
        $return = str_ireplace(
            array( 
                'frameborder="0"',
                'scrolling="no"',
                'frameborder="no"',
            ),
            '',
            $return
        );
    }
    return $return;
}
add_filter( 'oembed_dataparse', 'quomodo_starter_theme_prefix_remove_oembed_schema_attr', 10, 3 );


/**
 * quomodo_starter_theme_prefix_move_comment_field_to_bottom() Remove cookie field and move comment field bottom.
 * @param  $fields array()
 * @return return comment form fields
 */
function quomodo_starter_theme_prefix_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    unset( $fields['cookies'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'quomodo_starter_theme_prefix_move_comment_field_to_bottom' );

function quomodo_starter_theme_prefix_kses( $raw ) {
    $allowed_tags = array(
        'a' => array(
            'class'  => array(),
            'href'   => array(),
            'rel'    => array(),
            'title'  => array(),
            'target' => array(),
        ),
        'option' => array(
            'value' => array(),
        ),
        'abbr' => array(
            'title' => array(),
        ),
        'b'          => array(),
        'blockquote' => array(
            'cite' => array(),
        ),
        'cite' => array(
            'title' => array(),
        ),
        'code' => array(),
        'del'  => array(
            'datetime' => array(),
            'title'    => array(),
        ),
        'dd'  => array(),
        'div' => array(
            'class'  => array(),
            'title'  => array(),
            'style'  => array(),
        ),
        'dl' => array(),
        'dt' => array(),
        'em' => array(),
        'h1' => array(),
        'h2' => array(),
        'h3' => array(),
        'h4' => array(),
        'h5' => array(),
        'h6' => array(),
        'i'  => array(
            'class' => array(),
        ),
        'img' => array(
            'alt'    => array(),
            'class'  => array(),
            'height' => array(),
            'src'    => array(),
            'width'  => array(),
        ),
        'li' => array(
            'class' => array(),
        ),
        'ol' => array(
            'class' => array(),
        ),
        'p' => array(
            'class' => array(),
        ),
        'q' => array(
            'cite'   => array(),
            'title'  => array(),
        ),
        'span' => array(
            'class'  => array(),
            'title'  => array(),
            'style'  => array(),
        ),
        'iframe' => array(
            'width'       => array(),
            'height'      => array(),
            'scrolling'   => array(),
            'frameborder' => array(),
            'allow'       => array(),
            'src'         => array(),
        ),
        'strike'                         => array(),
        'br'                             => array(),
        'small'                          => array(),
        'strong'                         => array(),
        'data-wow-duration'              => array(),
        'data-wow-delay'                 => array(),
        'data-wallpaper-options'         => array(),
        'data-stellar-background-ratio'  => array(),
        'ul'                             => array(
            'class' => array(),
        ),
    );
    if ( function_exists( 'wp_kses' ) ) { // WP is here
        $allowed = wp_kses( $raw, $allowed_tags );
    } else {
        $allowed = $raw;
    }
    return $allowed;
}





