<?php
/**
 * Team Section
 * 
 * @package Mudita
 */
 
$section_title   = get_theme_mod( 'mudita_team_section_title' );
$section_content = get_theme_mod( 'mudita_team_section_content' );
$section_cat     = get_theme_mod( 'mudita_team_section_cat' );
 
if( $section_title || $section_content ){
    echo '<header class="header"><div class="container"><div class="holder">' ;
    if( $section_title ) echo '<h2 class="main-title">' . esc_html( $section_title ) . '</h2>';
    if( $section_content ) echo wpautop( esc_html( $section_content ) ); 
    echo '</div></div></header>';
}
 
if( $section_cat ){
    
    $team_qry = new WP_Query( array( 'cat' => $section_cat, 'posts_per_page' => -1, 'ignore_sticky_posts'   => true ) );
    if( $team_qry->have_posts() ){
    ?>
    <div id="team-slider">
        <?php 
        while( $team_qry->have_posts() ){
            $team_qry->the_post();
            ?>
            <div class="item">
				<?php if( has_post_thumbnail() ){ ?>
                <div class="img-holder">
                    <?php the_post_thumbnail( 'mudita-team' );?>
                </div>
                <?php } ?>
				<div class="text">
					<h3 class="title"><?php the_title(); ?></h3>
					<?php the_content(); ?>
				</div>
			</div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
    <?php
    }
 }