<!doctype html>
<html <?php language_attributes(); ?> class="bg-success">
<div>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php
    // Inject Google Analytics script
    accessmeter_google_analytics_script();
    
    // Inject site verification code
    accessmeter_site_verification_code();
    ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary" tabindex="1"><?php esc_html_e('Skip to content', 'accessmeter'); ?></a>       
    <?php
    // Get header mode from options
    $header_mode = get_option('header_mode', 'collapsed');
    ?>
    <header 
        id="masthead" 
        class="site-header <?php echo get_option('header_position', 'fixed-top'); ?>" 
        style="<?php get_header_color(); ?> width: 100%;">
        <div class="row no-gutters">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Collapse/Expand Toggler -->
                    <button tabindex="2" class="navbar-toggler position-fixed" type="button" data-bs-toggle="collapse" data-bs-target="#header-collapse" aria-controls="header-collapse" aria-expanded="<?php echo ($header_mode === 'expanded') ? 'true' : 'false'; ?>" aria-label="<?php _e('Toggle navigation', 'accessmeter'); ?>" style="top: 5px; border: 3px solid grey; padding: 5px; background-color: <?php echo get_option('progress_bar_color', 'green')?>; border-radius: 5px; z-index: 1000; left: 50%;">
                        <i class="bi bi-chevron-down text-white" style="font-size: 1.50rem;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Progress Bar always fixed at the top -->
        <div id="progress-bar-container">
            <?php display_progress_bar(); ?>
        </div>

        <!-- Collapsible Header Content -->
        <div class="collapse <?php echo ($header_mode === 'expanded') ? 'show' : ''; ?>" id="header-collapse">
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center pt-2 pb-2">
                        <div class="site-branding">
                            <?php
                            if (has_custom_logo()) {
                                // Display the custom logo
                                the_custom_logo();
                            } else {
                                // Display the site title if no logo is uploaded
                                if (is_front_page() && is_home()) :
                                    ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" tabindex="3" style= "background-color: <?php echo get_option('progress_bar_color', 'green');?>"><?php bloginfo('name'); ?></a></h1>
                                    <?php
                                else :
                                    ?>
                                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" tabindex="3" style= "background-color: <?php echo get_option('progress_bar_color', 'green');?>"><?php bloginfo('name'); ?></a></p>
                                    <?php
                                endif;
                            }
                            // Display the site description
                            $accessmeter_description = get_bloginfo('description', 'display');
                            if ($accessmeter_description || is_customize_preview()) :
                                ?>
                                <p class="site-description"><?php echo $accessmeter_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                            <?php endif; ?>
                        </div><!-- .site-branding -->
                        <!-- Menu Toggler visible only when header is expanded -->
                        <button tabindex="4" class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="<?php _e('Toggle navigation', 'accessmeter'); ?>" style="background-color: <?php echo get_option('progress_bar_color', 'green'); ?>; border: 3px solid grey; border-radius: 3px; top: 8px; padding: 7px;">
                            <i class="bi bi-list text-white" style="font-size: 1.7rem;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div><!-- #header-collapse -->

        <!-- Offcanvas Navigation Menu -->
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="z-index: 9999;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex mt-3" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-success" type="submit">Search</button>
                </form>
            </div>
        </div><!-- #offcanvasNavbar -->
    </header><!-- #masthead -->

    <!-- Additional content goes here -->

    <?php wp_footer(); ?>
</div><!-- #page -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var progressBarContainer = document.getElementById('progress-bar-container');

        // Ensure the progress bar is always fixed at the top
        progressBarContainer.style.position = 'fixed';
        progressBarContainer.style.top = '0';
        progressBarContainer.style.width = '100%';
        progressBarContainer.style.zIndex = '1050';
    });
</script>
</body>
</div>
</html>
