(function ($) {
    function updateProgressBar() {
        var docElement = document.documentElement;
        var body = document.body;
        var scrollTop = body.scrollTop || docElement.scrollTop;
        var scrollHeight = docElement.scrollHeight || body.scrollHeight;
        var clientHeight = docElement.clientHeight || body.clientHeight;
        var height = scrollHeight - clientHeight;
        var scrolled = (scrollTop / height) * 100;

        var progressBar = document.getElementById("progress-bar");
        if (progressBar) {
            progressBar.style.width = (scrolled >= 99.9 ? 100 : scrolled) + "%";
        }
    }

    window.addEventListener('scroll', updateProgressBar);
    window.addEventListener('resize', updateProgressBar);
    document.addEventListener('DOMContentLoaded', updateProgressBar);
})(jQuery);

//Table of contents.
jQuery(document).ready(function($) {
    var toc = $('#toc-sidebar');
    var content = $('.scrollspy-example');

    // Clear any existing TOC content
    toc.empty();

    // Generate TOC items
    content.find('h1, h2, h3, h4, h5, h6').each(function(index) {
        var $this = $(this);
        var level = $this.prop('tagName').toLowerCase();
        var id = 'heading-' + (index + 1);

        // Add an ID to the header
        $this.attr('id', id);

        // Add TOC item
        toc.append(
            $('<a>', {
                class: 'list-group-item list-group-item-action',
                href: '#' + id,
                text: $this.text()
            })
        );
    });
});



