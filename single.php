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

<style>
    body, html {
        overflow-x: hidden;
    }
</style>

<main id="primary" class="site-main">
    <div class="container">
        <div class="row no-gutters">
            <!-- ScrollSpy Navigation Column -->
            <div class="col-12 col-md-3 order-md-1 order-3">
                <nav id="navbar-example3" class="h-100 sticky-top">
                    <nav class="nav nav-pills flex-column">
                        <?php
                        // Function to extract headers from post content
                        function extract_headers($content) {
                            $matches = [];
                            preg_match_all('/<h[1-6]>(.*?)<\/h[1-6]>/', $content, $matches);
                            return $matches[1];
                        }

                        // Get post content
                        $post_content = get_the_content();

                        // Extract headers
                        $headers = extract_headers($post_content);

                        // Generate ScrollSpy navigation
                        foreach ($headers as $index => $header) {
                            $id = 'header-' . $index;
                            echo '<a class="nav-link" href="#' . $id . '">' . $header . '</a>';
                        }
                        ?>
                    </nav>
                </nav>
            </div>

            <!-- Main Content Column -->
            <div class="col-12 col-md-6 order-md-2 order-1">
                <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
                    <div class="breadcrumb-container">
                        <?php $breadcrumb_code = get_option('breadcrumb_code'); if ($breadcrumb_code) { echo $breadcrumb_code;} ?>
                    </div>
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        
                        // Replace headers with IDs in post content
                        $post_content = get_the_content();
                        foreach ($headers as $index => $header) {
                            $id = 'header-' . $index;
                            $post_content = preg_replace('/<h[1-6]>(.*?)<\/h[1-6]>/', '<h2 id="' . $id . '">$1</h2>', $post_content, 1);
                        }

                        echo '<div>' . $post_content . '</div>';

                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                    endwhile; // End of the loop.
                    ?>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="col-12 col-md-3 order-md-3 order-2">
                <?php get_sidebar(); ?>
            </div>
        </div><!-- .row -->
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
?>
