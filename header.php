<!doctype html>
<html <?php language_attributes(); ?> class="bg-light">
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
    $menu_mode = get_menu_mode();
    ?>
    <header 
    id="masthead" 
    class="site-header <?php echo get_option('header_position', 'fixed-top'); ?>" 
    style="<?php get_header_color(); ?> width: 100%;">
    <div class="row no-gutters align-items-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center pt-1">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        if (is_front_page() && is_home()) :
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" tabindex="0" style="background-color: <?php echo get_option('basic_color_mode', 'green');?>"><?php bloginfo('name'); ?></a></h1>
                            <?php
                        else :
                            ?>
                            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" tabindex="0" style="background-color: <?php echo get_option('basic_color_mode', 'green');?>"><?php bloginfo('name'); ?></a></p>
                            <?php
                        endif;
                    }
                    $accessmeter_description = get_bloginfo('description', 'display');
                    if ($accessmeter_description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo $accessmeter_description; ?></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->
                
                <?php if ($menu_mode !== 'always-expanded'): ?>
                    <button tabindex="0" class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#header-collapse" aria-controls="header-collapse" aria-expanded="<?php echo ($menu_mode === 'expanded') ? 'true' : 'false'; ?>" aria-label="<?php _e('Toggle navigation', 'accessmeter'); ?>" style="padding: 5px; margin: 5px; background-color: <?php echo get_option('basic_color_mode', 'green')?>; border-radius: 5px; z-index: 1000;">
                    <i class="bi bi-list text-white" style="font-size: 1.7rem;"></i>
                    </button>
                <?php endif; ?>
                
                <button tabindex="0" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" aria-label="<?php _e('Toggle navigation', 'accessmeter'); ?>" style="background-color: <?php echo get_option('basic_color_mode', 'green'); ?>; padding: 3px; border: 3px solid grey; border-radius: 30px; margin-right: 10%;">
                    <i class="bi bi-universal-access-circle text-white" style="font-size: 1.7rem;"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="progress-bar-container">
        <?php display_progress_bar(); ?>
    </div>

    <div class="collapse <?php echo ($menu_mode === 'expanded' || $menu_mode === 'always-expanded') ? 'show' : ''; ?>" id="header-collapse">
        <div class="row no-gutters">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg bg-dark" style="border-bottom: 5px double <?php echo get_option('basic_color_mode', 'green')?>;">
                    <div class="container-fluid">
    <div class="container-fluid px-0">
        <div class="row g-0 h-100">
            <div class="col-12 col-lg-8">
                <ul class="navbar-nav me-auto my-1 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100%;">
                    <li class="nav-item p-1">
                        <a class="nav-link active text-light bg-dark text-center" aria-current="page" href="#">Link 1</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-light bg-dark text-center" href="#">Link 2</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link active text-light bg-dark text-center" aria-current="page" href="#">Link 3</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-light bg-dark text-center" href="#">Link 4</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link active text-light bg-dark text-center" aria-current="page" href="#">Link 5</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-light bg-dark text-center" href="#">Link 6</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link active text-light bg-dark text-center" aria-current="page" href="#">Link 7</a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link text-light bg-dark text-center" href="#">Link 8</a>
                    </li>
                    <!-- Additional menu items can go here -->
                </ul>
            </div>
            <div class="col-12 col-lg-4">
                <form class="d-flex w-100 h-60 align-items-center justify-content-center" role="search">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="flex: 1; height: 3.0rem;">
                    <button class="btn text-light m-1" type="submit" style="background-color: <?php echo get_option('basic_color_mode', 'green'); ?>;">Search</button>
                </form>
            </div>
        </div>
    </div>

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-end bg-dark text-light" tabindex="0" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Customize Accessibility</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container">
                <div class="row">
                    <!-- Light Mode / Dark Mode -->
                    <div class="row row-border">
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-sun"></i>
                                <p>Light Mode</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-moon"></i>
                                <p>Dark Mode</p>
                            </div>
                        </div>
                    </div>

                    <!-- Zoom In / Zoom Out -->
                    <div class="row row-border">
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-zoom-in"></i>
                                <p>Zoom In</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-zoom-out"></i>
                                <p>Zoom Out</p>
                            </div>
                        </div>
                    </div>

                    <!-- Increase Font Size / Decrease Font Size -->
                    <div class="row row-border">
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-text-size"></i>
                                <p>Increase Font Size</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-text-indent-right"></i>
                                <p>Decrease Font Size</p>
                            </div>
                        </div>
                    </div>

                    <!-- Increase Text Spacing / Reduce Text Spacing -->
                    <div class="row row-border">
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-text-indent"></i>
                                <p>Increase Text Spacing</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-text-indent-left"></i>
                                <p>Reduce Text Spacing</p>
                            </div>
                        </div>
                    </div>

                    <!-- Increase Cursor Size / Reduce Cursor Size -->
                    <div class="row row-border">
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-cursor-text"></i>
                                <p>Increase Cursor Size</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-cursor"></i>
                                <p>Reduce Cursor Size</p>
                            </div>
                        </div>
                    </div>

                    <!-- Language Settings -->
                    <div class="row">
                        <div class="col-12">
                            <div class="icon-box" tabindex="0">
                                <i class="bi bi-globe"></i>
                                <p>Language Settings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</header><!-- #masthead -->
    <!-- Additional content goes here -->

    <?php wp_footer(); ?>
</div><!-- #page -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const offcanvasNavbar = document.getElementById('offcanvasNavbar');
        const links = offcanvasNavbar.querySelectorAll('a.nav-link, button.btn-close');

        links.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });
    });
</script>
</body>
</html>
