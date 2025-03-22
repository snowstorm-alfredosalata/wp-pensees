<?php

class PENSEES_Helper {
    /**
     * Get a pensee post object by ID.
     */
    public static function get_pensee(int $id): ?WP_Post {
        $post = get_post($id);
        return ($post && $post->post_type === 'pensee' && $post->post_status === 'publish') ? $post : null;
    }
    
    /**
     * Get the latest pensee post object.
     */
    public static function get_latest_pensee(): ?WP_Post {
        $query = new WP_Query([
            'post_type'      => 'pensee',
            'posts_per_page' => 1,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
            'no_found_rows'  => true,
        ]);
    
        return $query->have_posts() ? get_post($query->posts[0]) : null;
    }

    /**
     * Get a random pensee post.
     */
    public static function get_random_pensee(?int $exclude_id = null): ?WP_Post {
        $args = [
            'post_type'      => 'pensee',
            'posts_per_page' => 1,
            'orderby'        => 'rand',
            'post_status'    => 'publish'
        ];

        if ($exclude_id) {
            $args['post__not_in'] = [$exclude_id];
        }

        $query = new WP_Query($args);
        return $query->have_posts() ? get_post($query->posts[0]) : null;
    }
    

    /**
     * Get previous and next pensees relative to the given post.
     */
    public static function get_adjacent_pensees(WP_Post $post): array {
        $prev = new WP_Query([
            'post_type'      => 'pensee',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'date_query'     => [
                ['before' => $post->post_date, 'inclusive' => false]
            ],
            'fields' => 'ids',
        ]);

        $next = new WP_Query([
            'post_type'      => 'pensee',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'ASC',
            'date_query'     => [
                ['after' => $post->post_date, 'inclusive' => false]
            ],
            'fields' => 'ids',
        ]);

        return [
            'prev_id' => $prev->have_posts() ? $prev->posts[0] : null,
            'next_id' => $next->have_posts() ? $next->posts[0] : null,
        ];
    }

    /**
     * Format a pensee for frontend JSON output.
     */
    public static function format_for_json(WP_Post $post): array {
        $adjacent = self::get_adjacent_pensees($post);

        return [
            'id'       => $post->ID,
            'title'    => get_the_title($post),
            'content'  => apply_filters('the_content', $post->post_content),
            'date'     => get_the_date('', $post),
            'prev_id'  => $adjacent['prev_id'],
            'next_id'  => $adjacent['next_id'],
        ];
    }
}
