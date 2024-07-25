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

<footer id="colophon" class="site-footer bg-dark">
    <div class="container">
        <!-- Collapse/Expand Toggler -->
        <div class="text-center mb-3">
            <button tabindex="2" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#footer-collapse" aria-controls="footer-collapse" aria-expanded="<?php echo (get_footer_mode() === 'expanded') ? 'true' : 'false'; ?>" aria-label="<?php _e('Toggle footer', 'accessmeter'); ?>" style="border: 3px solid grey; padding: 5px; background-color: black; border-radius: 5px;">
                <i class="bi bi-chevron-<?php echo (get_footer_mode() === 'expanded') ? 'up' : 'down'; ?> text-white" style="font-size: 1.50rem;"></i>
            </button>
        </div>

        <!-- Collapsible Footer Content -->
        <div class="collapse <?php echo (get_footer_mode() === 'expanded') ? 'show' : ''; ?>" id="footer-collapse">
            <div class="row">
                <?php
                // Get the user’s choice for the number of footer widgets
                $footer_widgets_choice = get_option('footer_widgets', '4-widgets');
                $footer_widgets_count = intval($footer_widgets_choice);

                // Define footer widget areas
                $footer_widgets = array(
                    'footer-1',
                    'footer-2',
                    'footer-3',
                    'footer-4'
                );

                // Calculate column size based on the number of widgets
                $col_size = 12 / $footer_widgets_count;

                // Loop through and display active footer widget areas
                for ($i = 1; $i <= $footer_widgets_count; $i++) {
                    if (is_active_sidebar($footer_widgets[$i - 1])) {
                        echo '<div class="col-12 col-md-' . $col_size . '">';
                        dynamic_sidebar($footer_widgets[$i - 1]);
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
