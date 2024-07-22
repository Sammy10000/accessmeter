<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'accessmeter'); ?></a>
    <?php display_progress_bar(); ?>
    
    <?php
    // Get header mode from options
    $header_mode = get_option('header_mode', 'collapsed');
    ?>

    <header id="masthead" class="site-header bg-dark" style="position: fixed; width: 100%; top: 0; z-index: 1030; background-color: #343a40;">
        <!-- Toggler Button for mobile view -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-collapse" aria-controls="header-collapse" aria-expanded="<?php echo ($header_mode === 'expanded') ? 'true' : 'false'; ?>" aria-label="<?php _e('Toggle navigation', 'accessmeter'); ?>" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: blue; border: none;">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Header Content -->
        <div class="collapse <?php echo ($header_mode === 'expanded') ? 'show' : ''; ?>" id="header-collapse">
            <div class="site-branding">
                <?php
                the_custom_logo();
                if (is_front_page() && is_home()) :
                    ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                    <?php
                else :
                    ?>
                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                    <?php
                endif;
                $accessmeter_description = get_bloginfo('description', 'display');
                if ($accessmeter_description || is_customize_preview()) :
                    ?>
                    <p class="site-description"><?php echo $accessmeter_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->
        </div><!-- #header-collapse -->
    </header><!-- #masthead -->

    <!-- Additional content goes here -->

    <?php wp_footer(); ?>
</div><!-- #page -->
</body>
</html>
