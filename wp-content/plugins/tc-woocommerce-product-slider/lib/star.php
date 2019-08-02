<?php
//add_action('woocommerce_after_shop_loop_item', 'my_print_stars' );


function my_print_stars(){
    global $wpdb;
    global $post;
    $count = $wpdb->get_var("
    SELECT COUNT(meta_value) FROM $wpdb->commentmeta
    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
    WHERE meta_key = 'rating'
    AND comment_post_ID = $post->ID
    AND comment_approved = '1'
    AND meta_value > 0
");

$rating = $wpdb->get_var("
    SELECT SUM(meta_value) FROM $wpdb->commentmeta
    LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
    WHERE meta_key = 'rating'
    AND comment_post_ID = $post->ID
    AND comment_approved = '1'
");

if ( $count > 0 ) {

    $average = number_format($rating / $count, 2);

    return '<div class="starwrapper" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
    <span class="star-rating" title="'.sprintf(__('Rated %s out of 5', 'woocommerce'), $average).'"><span style="width:'.($average*16).'px">
    <span itemprop="ratingValue" class="rating">'.$average.'</span> </span></span></div>';
    }

}
