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
        <div class="row g-0">
            <!-- TOC Column -->
            <div id="toc-sidebar" class="col-12 col-md-3 toc-container">
                <!-- TOC will be injected here by jQuery -->
            </div>

            <!-- Main Content Column -->
            <div class="scrollspy-example col-12 col-md-6" data-bs-spy="scroll" data-bs-target="#toc-sidebar" data-bs-smooth-scroll="true" tabindex="0">
                <div class="breadcrumb-container">
                    <?php 
                    $breadcrumb_code = get_option('breadcrumb_code'); 
                    if ($breadcrumb_code) { 
                        echo $breadcrumb_code;
                    } 
                    ?>
                </div>
                <?php
                while ( have_posts() ) :
                    the_post();

                    // Get and display the post content
                    echo '<div>' . apply_filters('the_content', get_the_content()) . '</div>';

                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
            </div>

            <!-- Right Sidebar Column -->
            <div id="right-sidebar" class="col-12 col-md-3 sidebar-container">
                <?php get_sidebar(); ?>
            </div>
        </div><!-- .row -->
    </div><!-- .container-fluid -->
</main><!-- #main -->

<?php
get_footer();
?>
