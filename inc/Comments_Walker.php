<?php

$comments_opt = get_option('comments_formet','B');
if( $comments_opt == 'A' ){
    include('trait/comments/Render_Formet_A.php');
}elseif( $comments_opt == 'B' ){
    include('trait/comments/Render_Formet_B.php');
}
class quomodo_starter_theme_prefix_Custom_Walker_Comment extends Walker_Comment {
    use Comments_Render_Html;
}