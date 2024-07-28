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
    $header_mode = get_header_mode();
    ?>
    <header 
    id="masthead" 
    class="site-header <?php echo get_option('header_position', 'fixed-top'); ?>" 
    style="<?php get_header_color(); ?> width: 100%;">
    <div class="row no-gutters align-items-center">
        <div class="col-12">
            <div class="d-flex justify-content-around align-items-center pt-1">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        if (is_front_page() && is_home()) :
                            ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" tabindex="3" style="background-color: <?php echo get_option('progress_bar_color', 'green');?>"><?php bloginfo('name'); ?></a></h1>
                            <?php
                        else :
                            ?>
                            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home" tabindex="3" style="background-color: <?php echo get_option('progress_bar_color', 'green');?>"><?php bloginfo('name'); ?></a></p>
                            <?php
                        endif;
                    }
                    $accessmeter_description = get_bloginfo('description', 'display');
                    if ($accessmeter_description || is_customize_preview()) :
                        ?>
                        <p class="site-description"><?php echo $accessmeter_description; ?></p>
                    <?php endif; ?>
                </div><!-- .site-branding -->
                
                <?php if ($header_mode !== 'always-expanded'): ?>
                    <button tabindex="2" class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#header-collapse" aria-controls="header-collapse" aria-expanded="<?php echo ($header_mode === 'expanded') ? 'true' : 'false'; ?>" aria-label="<?php _e('Toggle navigation', 'accessmeter'); ?>" style="padding: 5px; background-color: <?php echo get_option('progress_bar_color', 'green')?>; border-radius: 5px; z-index: 1000;">
                    <i class="bi bi-list text-white" style="font-size: 1.7rem;"></i>
                    </button>
                <?php endif; ?>
                
                <button tabindex="4" class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="<?php _e('Toggle navigation', 'accessmeter'); ?>" style="background-color: <?php echo get_option('progress_bar_color', 'green'); ?>; padding: 7px;">
                <i class="bi bi-gear text-white" style="font-size: 1.7rem;"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="progress-bar-container">
        <?php display_progress_bar(); ?>
    </div>

    <div class="collapse <?php echo ($header_mode === 'expanded' || $header_mode === 'always-expanded') ? 'show' : ''; ?>" id="header-collapse">
        <div class="row no-gutters">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg bg-dark">
                    <div class="container-fluid">
    <div class="container-fluid px-0">
        <div class="row g-0 h-100">
            <div class="col-12 col-lg-8">
                <ul class="navbar-nav me-auto my-1 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100%;">
                    <li class="nav-item">
                        <a class="nav-link active text-light bg-dark" aria-current="page" href="#">Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light bg-dark" href="#">Link 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light bg-dark" aria-current="page" href="#">Link 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light bg-dark" href="#">Link 4</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light bg-dark" aria-current="page" href="#">Link 5</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light bg-dark" href="#">Link 6</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-light bg-dark" aria-current="page" href="#">Link 7</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light bg-dark" href="#">Link 8</a>
                    </li>
                    <!-- Additional menu items can go here -->
                </ul>
            </div>
            <div class="col-12 col-lg-4 h-100">
                <form class="d-flex w-100 h-100 align-items-center justify-content-center" role="search">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="flex: 1; height: 3.0rem;">
                    <button class="btn text-light" type="submit" style="background-color: <?php echo get_option('progress_bar_color', 'green'); ?>;">Search</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="z-index: 1000;">
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
            <form class="d-flex mt-3 w-100" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="flex: 1;">
                <button class="btn btn-success" type="submit" style="background-color: <?php echo get_option('progress_bar_color', 'green'); ?>;">Search</button>
            </form>
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
