<?php
$has_site_logo =   (!empty(techza_get_site_logo())) ? 'has-site-logo' : '';
?>
<header class="techza-header-area header-style-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="techza-header-wrap">
                    <div class="site-branding <?php echo esc_attr($has_site_logo)  ?>">
                        <a href="<?php echo esc_url(home_url()) ?>">
                            <?php
                            printf("%s", techza_get_site_logo());
                            ?>
                        </a>
                    </div><!-- .site-branding -->
                    <div class="techza-menu-wrap">
                        <div class="techza-main-menu-wrap navbar menu-style-inline justify-content-end">
                            <button class="navbar-toggler open-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" height="384pt" viewBox="0 -53 384 384" width="384pt"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path></svg></span>
                            </button>
                            <!-- end of Nav toggler -->
                            <div class="navbar-inner">

                                <div class="site-branding mobile-version <?php echo esc_attr($has_site_logo)  ?>">
                                    <a href="<?php echo esc_url(home_url()) ?>">
                                        <?php
                                        printf("%s", techza_get_site_logo());
                                        ?>
                                    </a>
                                </div><!-- .site-branding -->

                                <div class="techza-mobile-menu"></div>
                                <button class="navbar-toggler close-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 18L18 6M6 6L18 18" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    </span>
                                </button>
                                <nav id="site-navigation" class="main-navigation ">
                                    <?php
                                    if (has_nav_menu('main-menu')) {
                                        wp_nav_menu(
                                            array(
                                                'theme_location' => 'main-menu',
                                                'menu_class' => 'navbar-nav',
                                                'menu_id' => 'navbar-nav',
                                                'container_class' => 'techza-menu-container'
                                            )
                                        );
                                    }

                                    ?>
                                </nav><!-- #site-navigation -->

                                <div class="techza-menu-bottom">
                                    <a href="<?php echo esc_url(home_url() ) ?>"><?php _e('Get Started', 'techza'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>