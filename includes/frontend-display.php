<?php
defined('ABSPATH') || exit;

// Add buttons to post content
add_filter('the_content', function($content) {
    $settings = get_option('smart_social_settings', [
        'placement' => 'below',
        'platforms' => ['twitter', 'facebook', 'linkedin', 'pinterest', 'whatsapp', 'copy']
    ]);
    $buttons = smart_social_get_buttons($settings['platforms']);
    if ($settings['placement'] === 'above') {
        return $buttons.$content;
    } elseif ($settings['placement'] === 'below') {
        return $content.$buttons;
    }
    return $content;
});

// Shortcode for manual placement
add_shortcode('smart_social_share', function() {
    $settings = get_option('smart_social_settings', ['platforms' => ['twitter', 'facebook', 'linkedin', 'pinterest', 'whatsapp', 'copy']]);
    return smart_social_get_buttons($settings['platforms']);
});

// Generate button HTML
function smart_social_get_buttons($platforms) {
    $output = '<div class="smart-social-buttons">';
    $url = urlencode(get_permalink());
    $title = urlencode(get_the_title());
    $links = [
        'twitter' => "https://twitter.com/intent/tweet?url=$url&text=$title",
        'facebook' => "https://www.facebook.com/sharer.php?u=$url",
        'linkedin' => "https://www.linkedin.com/shareArticle?url=$url&title=$title",
        'pinterest' => "https://pinterest.com/pin/create/button/?url=$url&description=$title",
        'whatsapp' => "https://api.whatsapp.com/send?text=$title%20$url",
        'copy' => "#"
    ];
    foreach ($platforms as $platform) {
        $icon = $platform === 'copy' ? 'fas fa-copy' : "fab fa-$platform";
        $output .= "<a href='{$links[$platform]}' class='smart-social-button $platform' data-platform='$platform' aria-label='Share on $platform'><i class='$icon'></i></a>";
    }
    $output .= '</div>';
    return $output;
}
?>