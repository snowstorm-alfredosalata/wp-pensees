<?php

require_once PENSEES_PATH . 'src/pensee_helper.php';

function PENSEES_pensee_viewer_sortcode() {
    $post = PENSEES_Helper::get_latest_pensee();

    if (!$post) {
        return '<div class="pensee-viewer-empty">' . esc_html__('No pensées available.', 'pensees') . '</div>';
    }

    $data = PENSEES_Helper::format_for_json($post);

    ob_start();
    ?>
    <div class="pensee-viewer"
         data-post-id="<?php echo esc_attr($data['id']); ?>"
         data-prev-id="<?php echo esc_attr($data['prev_id']); ?>"
         data-next-id="<?php echo esc_attr($data['next_id']); ?>">

        <h3 class="pensee-viewer-title"><?php echo esc_html($data['title']); ?></h3>
        <div class="pensee-viewer-content"><?php echo $data['content']; ?></div>
        <div class="pensee-viewer-date"><?php echo esc_html($data['date']); ?></div>

        <div class="pensee-viewer-controls">
            <button class="pensee-viewer-controls-previous button"
                    <?php if (!$data['prev_id']) echo 'disabled'; ?>>
                <?php esc_html_e('Previous', 'pensees'); ?>
            </button>

            <button class="pensee-viewer-controls-rand button">
                <?php esc_html_e('Random', 'pensees'); ?>
            </button>

            <button class="pensee-viewer-controls-next button"
                    <?php if (!$data['next_id']) echo 'disabled'; ?>>
                <?php esc_html_e('Next', 'pensees'); ?>
            </button>
       </div>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('pensee_viewer', 'PENSEES_pensee_viewer_sortcode');
