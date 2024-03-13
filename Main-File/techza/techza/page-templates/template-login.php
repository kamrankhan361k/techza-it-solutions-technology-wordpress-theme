<?php
/*
Template name: Login

*/
get_header();
?>

    <div class="techza-login-area">

            <?php
                if( have_posts() ) :
                    while( have_posts() ) :

                        the_post();

                        the_content();

                    endwhile;
                    wp_reset_postdata();
                endif;
            ?>
    </div>


<?php
get_footer();
?>
