jQuery(document).ready(function($) {
    // Example: Add a class to all WooCommerce product titles
    $('.woocommerce-loop-product__title').addClass('custom-product-title');

    // Example: Display an alert when the add to cart button is clicked
    $('body').on('click', '.single_add_to_cart_button', function() {
        alert('Product added to cart!');
    });

    // Example: Toggle the visibility of the WooCommerce product description on click
    $('.woocommerce-product-details__short-description').on('click', function() {
        $(this).toggleClass('expanded');
    });
});
