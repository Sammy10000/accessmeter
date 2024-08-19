<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<main id="primary" class="site-main">
    <div class="container-fluid">
        <div class="row" style="height: 100vh; overflow: hidden;">

            <!-- Left Sidebar Column -->
            <div class="col-12 col-md-3" style="overflow-y: auto; height: 100%; padding-top: 70px; padding-bottom: 120px; border-right: 7px double <?php echo get_option('basic_color_mode', 'green'); ?>;">
                <?php if ( is_active_sidebar( 'woocommerce-left-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'woocommerce-left-sidebar' ); ?>
                <?php endif; ?>
            </div>

            <!-- Main Content Column -->
            <div id="progress-bar-content" class="col-12 col-md-6" style="overflow-y: auto; height: 100%; padding-top: 70px; padding-bottom: 200px;">
                <div tabindex="0">
                    <div class="breadcrumb-container">
                        <?php
                        // Hook: woocommerce_before_main_content
                        do_action( 'woocommerce_before_main_content' );

                        // Hook: woocommerce_shop_loop_header
                        do_action( 'woocommerce_shop_loop_header' );
                        ?>
                    </div>

                    <?php if ( woocommerce_product_loop() ) : ?>
                        <?php
                        // Hook: woocommerce_before_shop_loop
                        do_action( 'woocommerce_before_shop_loop' );

                        woocommerce_product_loop_start();

                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();

                                // Hook: woocommerce_shop_loop
                                do_action( 'woocommerce_shop_loop' );

                                wc_get_template_part( 'content', 'product' );
                            }
                        }

                        woocommerce_product_loop_end();

                        // Hook: woocommerce_after_shop_loop
                        do_action( 'woocommerce_after_shop_loop' );
                        ?>
                    <?php else : ?>
                        <?php
                        // Hook: woocommerce_no_products_found
                        do_action( 'woocommerce_no_products_found' );
                        ?>
                    <?php endif; ?>

                    <?php
                    // Hook: woocommerce_after_main_content
                    do_action( 'woocommerce_after_main_content' );
                    ?>
                </div>
            </div>

            <!-- Right Sidebar Column -->
            <div class="col-12 col-md-3" style="overflow-y: auto; height: 100%; padding-top: 70px; padding-bottom: 120px;">
                <?php if ( is_active_sidebar( 'woocommerce-right-sidebar' ) ) : ?>
                    <?php dynamic_sidebar( 'woocommerce-right-sidebar' ); ?>
                <?php endif; ?>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    (function ($) {
        function updateProgressBar() {
            // Get the main content element
            var $contentElement = $('#progress-bar-content');
            
            if ($contentElement.length === 0) return; // Exit if the element is not found

            // Calculate scroll position and height
            var scrollTop = $contentElement.scrollTop();
            var scrollHeight = $contentElement[0].scrollHeight;
            var clientHeight = $contentElement[0].clientHeight;
            var height = scrollHeight - clientHeight;
            var scrolled = (scrollTop / height) * 100;

            // Get the progress bar element
            var $progressBar = $("#progress-bar");
            if ($progressBar.length) {
                // Update the progress bar width
                $progressBar.css('width', (scrolled >= 99.9 ? 100 : scrolled) + "%");
            }
        }

        // Attach event listeners
        $(document).ready(function() {
            var $contentElement = $('#progress-bar-content');
            if ($contentElement.length) {
                $contentElement.on('scroll', updateProgressBar);
                $(window).on('resize', updateProgressBar);
                updateProgressBar(); // Initial update on page load
            }
        });
    })(jQuery);
    </script>
    <?php control_sidebar_layout(); ?>
</main><!-- #main -->

<?php
get_footer( 'shop' );
?>
