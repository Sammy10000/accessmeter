<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Accessmeter
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container-fluid">
        <div class="row" style="height: 100vh; overflow: hidden;">
            
            <!-- Sidebar-1 Column -->
            <div class="col-12 col-md-3" style="overflow-y: auto; height: 100%; padding-top: 70px; padding-bottom: 120px; border-right: 7px double <?php echo get_option('basic_color_mode', 'green'); ?>;">
                <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-1' ); ?>
                <?php endif; ?>
            </div>

            <!-- Main Content Column -->
            <div id="progress-bar-content" class="col-12 col-md-6" style="overflow-y: auto; height: 100%; padding-top: 70px; padding-bottom: 200px;">
                <div tabindex="0">
                    <div class="breadcrumb-container">
                        <?php $breadcrumb_code = get_option('breadcrumb_code'); if ($breadcrumb_code) { echo $breadcrumb_code;} ?>
                    </div>
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        
                        // Initialize headers array (Example: capturing h2 and h3 elements)
                        $headers = array();
                        preg_match_all('/<h[2-3]>(.*?)<\/h[2-3]>/', get_the_content(), $matches);
                        if (!empty($matches[0])) {
                            $headers = $matches[0];
                        }

                        // Replace headers with IDs in post content
                        $post_content = get_the_content();
                        foreach ($headers as $index => $header) {
                            $id = 'header-' . $index;
                            $post_content = preg_replace('/<h[2-3]>(.*?)<\/h[2-3]>/', '<h2 id="' . $id . '">$1</h2>', $post_content, 1);
                        }

                        echo '<div>' . $post_content . '</div>';

                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>

            <!-- Sidebar-2 Column -->
            <div class="col-12 col-md-3" style="overflow-y: auto; height: 100%; padding-top: 70px; padding-bottom: 120px;">
                <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
                    <?php dynamic_sidebar( 'sidebar-2' ); ?>
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
get_footer();
?>
