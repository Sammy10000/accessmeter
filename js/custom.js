(function ($) {
    let animationFrameId;
  
    function updateProgressBar() {
      // Get the main content element
      const $contentElement = $('#progress-bar-content');
  
      if ($contentElement.length === 0) return; // Exit if the element is not found
  
      // Calculate scroll position and height
      const scrollTop = $contentElement.scrollTop();
      const scrollHeight = $contentElement[0].scrollHeight;
      const clientHeight = $contentElement[0].clientHeight;
      const height = scrollHeight - clientHeight;
      const scrolled = (scrollTop / height) * 100;
  
      // Get the progress bar element
      const $progressBar = $("#progress-bar");
      if ($progressBar.length) {
        // Update the progress bar width
        $progressBar.css('width', (scrolled >= 99.9 ? 100 : scrolled) + "%");
      }
  
      // Request the next animation frame
      animationFrameId = requestAnimationFrame(updateProgressBar);
    }
  
    // Attach event listeners
    $(document).ready(function () {
      const $contentElement = $('#progress-bar-content');
      if ($contentElement.length) {
        $contentElement.on('scroll', updateProgressBar);
        $(window).on('resize', updateProgressBar);
        updateProgressBar(); // Initial update on page load
      }
    });
  
    // Cancel animation frame when needed (e.g., on page unload)
    $(window).on('unload', () => {
      cancelAnimationFrame(animationFrameId);
    });
  })(jQuery);