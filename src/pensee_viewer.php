<?php

require_once PENSEES_PATH . 'src/pensee_helper.php';

function PENSEES_pensee_viewer_sortcode($attrs) {
    $attrs = shortcode_atts([
        'control_style' => 'text',
        'tag' => 'Pensées...',
        'use_tag' => 'false',
        'show_title' => 'true',
    ], $attrs, 'pensee_viewer');

    $use_icons = $attrs['control_style'] === 'icons';
    $tag = $attrs['tag'];
    $use_tag = $attrs['use_tag'] === 'true';
    $show_title = $attrs['show_title'] === 'true';

    $post = PENSEES_Helper::get_latest_pensee();

    if (!$post) {
        return '<div class="pensee-viewer-empty">No pensées available.</div>';
    }

    $data = PENSEES_Helper::format_for_json($post);

    ob_start();
    ?>
    <div class="pensee-viewer"
         data-post-id="<?php echo esc_attr($data['id']); ?>"
         data-prev-id="<?php echo esc_attr($data['prev_id']); ?>"
         data-next-id="<?php echo esc_attr($data['next_id']); ?>">

        <?php if ($use_tag): ?><div class="pensee-viewer-tag"><?php echo esc_html($tag) ?></div><?php endif; ?>
        
        <h3 class="pensee-viewer-title" <?php if (!$show_title): ?>style="display: none"<?php endif; ?>><?php echo esc_html($data['title']); ?></h3>
        <div class="pensee-viewer-content"><?php echo $data['content']; ?></div>
        <div class="pensee-viewer-date"><?php echo esc_html($data['date']); ?></div>

        <div class="pensee-viewer-controls">
            <button class="pensee-viewer-controls-previous" <?php if (!$data['prev_id']) echo 'disabled'; ?>>
                <?php echo $use_icons ? '<span class="dashicons dashicons-arrow-left-alt2" aria-hidden="true"></span>' : 'Previous'; ?>
            </button>
            <button class="pensee-viewer-controls-rand">
                <?php echo $use_icons ? '<span class="dashicons dashicons-randomize" aria-hidden="true"></span>' : 'Random'; ?>
            </button>
            <button class="pensee-viewer-controls-next" <?php if (!$data['next_id']) echo 'disabled'; ?>>
                <?php echo $use_icons ? '<span class="dashicons dashicons-arrow-right-alt2" aria-hidden="true"></span>' : 'Next'; ?>
            </button>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('pensee_viewer', 'PENSEES_pensee_viewer_sortcode');
