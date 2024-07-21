<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Accessmeter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
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
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'accessmeter' ); ?></a>
    <?php display_progress_bar();?>
    <header id="masthead" class="site-header bg-dark">
        <div class="site-branding">
            <?php
            the_custom_logo();
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <?php
            else :
                ?>
                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                <?php
            endif;
            $accessmeter_description = get_bloginfo( 'description', 'display' );
            if ( $accessmeter_description || is_customize_preview() ) :
                ?>
                <p class="site-description"><?php echo $accessmeter_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
            <?php endif; ?>
        </div><!-- .site-branding -->
    </header><!-- #masthead -->
