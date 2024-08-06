<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Accessmeter
 */
?>

<footer id="colophon" class="site-footer <?php echo get_option('footer_position', 'static-bottom'); ?>" style="<?php get_footer_color(); ?> width: 100%; z-index: 1;">
    <div class="container">
        <!-- Collapse/Expand Toggler -->
        <div class="text-center">
            <!-- Toggle Button -->
            <button tabindex="0" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#footer-collapse" aria-controls="footer-collapse" aria-expanded="false" aria-label="<?php _e('Toggle footer', 'accessmeter'); ?>" style="border: 3px solid grey; padding: 3px; background-color: <?php echo get_option('basic_color_mode', 'green');?>; border-radius: 5px; right: 50%;">
                <i class="bi bi-chevron-up text-white" style="font-size: 1.50rem;"></i>
            </button>
        </div>

        <!-- Collapsible Footer Content -->
        <div class="collapse" id="footer-collapse">
            <div class="row">
                <?php
                // Define the footer widget areas
                $footer_widgets = array(
                    'footer-1',
                    'footer-2',
                    'footer-3',
                    'footer-4'
                );

                // Find active widget areas
                $active_widgets = array_filter($footer_widgets, function($widget) {
                    return is_active_sidebar($widget);
                });

                // Calculate column size based on the number of active widgets
                $active_count = count($active_widgets);
                if ($active_count > 0) {
                    $col_size = 12 / $active_count;

                    // Loop through and display active footer widget areas
                    foreach ($active_widgets as $widget) {
                        echo '<div class="col-12 col-md-' . $col_size . '">';
                        dynamic_sidebar($widget);
                        echo '</div>';
                    }
                }
                ?>
            </div><!-- .row -->
            <div class="site-info text-center">
                <span class="sep"> | </span>
            </div><!-- .site-info -->
        </div><!-- #footer-collapse -->
    </div><!-- .container -->
    <!-- Footer Credits -->
    <div class="footer-credits text-center" style="background-color: <?php echo get_option('basic_color_mode', 'green');?>; color: white; font-size: 50%;">
        <?php echo get_footer_credits(); ?>
    </div>
    <!-- .footer-credits -->
</footer><!-- #colophon -->
<?php wp_footer(); ?>
<?php
    // Inject marketing pixel code
    accessmeter_marketing_pixel_code();
    
    // Inject email service provider code
    accessmeter_email_service_provider_code();
?>

</body>
</html>
