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
