<?php
function accessmeter_audits() {
    ?>
    <div class="accessmeter-heading mt-2">
        <div class="heading-container">
            <h1>Accessibility Audits</h1>
            <div style="display: flex; align-items: center;">
                <div class="upgrade-icon">
                    <a href="http://accessmeter.com/upgrade" title="Upgrade" target="_blank">
                        <img src="<?php echo plugin_dir_url(__FILE__); ?>/accessmeter_icon.png" alt="" style="width: 20px; height: 20px;">
                    </a>
                </div>
                <div class="help-icon" style="margin-left: 10px;">
                    <a href="#" title="Help" aria-label="Help">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="tabs" role="tablist">
        <button id="automated-audits-tab" class="tab" role="tab" aria-controls="automated-audits" aria-selected="true" data-target="automated-audits">
            Automated Audit
        </button>
        <button id="manual-audit-tab" class="tab" role="tab" aria-controls="manual-audit" aria-selected="false" data-target="manual-audit">
            Manual Audit
        </button>
    </div>

    <div id="automated-audits" class="tab-content" role="tabpanel" aria-labelledby="automated-audits-tab">
        <div id="lap-content" role="tabpanel" aria-label="Live audit report for recent posts">
            <table style="width: 100%; border-collapse: separate;">
                <thead>
                    <tr>
                        <th style="border-top-left-radius: 8px;">Post</th>
                        <th style="border-top-right-radius: 8px;">Issue(s)</th>
                    </tr>
                </thead>
                <tbody id="lap-posts-container">
                <?php
                    $recent_posts = wp_get_recent_posts([ 
                        'numberposts' => 5, 
                        'post_status' => 'publish', 
                    ]);
                    foreach ($recent_posts as $post) {
                        $post_title = esc_html($post['post_title']);
                        $post_url = get_permalink($post['ID']);
                        $aria_label = $post_title . ' - Click to view audit details';
                        echo '<tr tabindex="0" role="button" data-id="' . $post['ID'] . '" data-title="' . $post_title . '" data-url="' . esc_url($post_url) . '" class="post-row" aria-label="' . esc_attr($aria_label) . '">';
                        echo "<td>" . $post_title . "</td>";
                        echo "<td>Loading...</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
            <button id="load-more-lap" class="button" data-offset="5">Load More...</button>
        </div>        
    </div>

    <div id="manual-audit" class="tab-content" role="tabpanel" aria-labelledby="manual-audit-tab">
        <button id="manual-audit-btn" class="button" aria-label="Get Manual Audit Support">Get Manual Audit Support</button>
    </div>

    <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-border-green">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h2 class="modal-title" id="staticBackdropLabel">Modal Title</h2>
                        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modal-body-content">Loading...</p>
                    </div>
                    <div class="modal-footer">
                        <div class="container">
                            <div class="row justify-content-center text-center">
                                <div class="col-12 col-md-4">
                                    <button id="download-modal-content" type="button" class="btn button">Download</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <button id="rescan-modal-content" type="button" class="btn button">Rescan</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <button type="button" class="btn button" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
}
?>
<!-- Include the SheetJS library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
