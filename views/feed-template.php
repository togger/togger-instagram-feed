<?php if (!defined('ABSPATH')) exit; 

// Get Instagram settings from ACF options
$instagram = get_field('instagram', 'option');
$headline = $instagram['headline'] ?? 'Instagram';
$username = $instagram['username'] ?? '';
$profile_link = $instagram['profile-link'] ?? '';
?>

<section class="social-media-feed bg--white">
    <div class="container">
        <div class="headline-container">
            <div class="headline-wrapper">
                <h2><?php echo esc_html($headline); ?></h2>
            </div>
            <?php if ($profile_link && $username): ?>
            <a href="<?php echo esc_url($profile_link); ?>">
                <div class="headline-social-media">
                    <div class="logo"></div>
                    <div class="name"><?php echo esc_html($username); ?></div>
                    <div class="point"></div>
                    <div class="follow">Folgen</div>
                </div>
            </a>
            <?php endif; ?>
        </div>

        <?php if (!empty($posts)): ?>
        <div class="social-media-feed-list social-media">
            <div class="social-media-feed-wrapper">
                <?php foreach ($posts as $post): 
                    // Calculate time ago
                    $now = new \DateTime();
                    $timestamp = strtotime($post['timestamp']);
                    $time_diff = ($now->getTimestamp() - $timestamp) / 60 / 60; // hours
                    
                    if ($time_diff < 24) {
                        $hours = round($time_diff);
                        $time = ($hours == 1) ? 'Vor ' . $hours . ' Stunde' : 'Vor ' . $hours . ' Stunden';
                    } else if ($time_diff < (24 * 7)) {
                        $days = floor($time_diff / 24);
                        $time = ($days == 1) ? 'Vor ' . $days . ' Tag' : 'Vor ' . $days . ' Tagen';
                    } else {
                        $time = date('d.m.Y', $timestamp);
                    }
                    
                    // Get image source
                    $image_src = ($post['media_type'] === 'VIDEO' && !empty($post['thumbnail_url'])) 
                        ? $post['thumbnail_url'] 
                        : $post['media_url'];
                    
                    // Limit text
                    $text = $post['caption'] ?? '';
                    $short_text = (strlen($text) > 75) ? substr($text, 0, 75) . '...' : $text;
                ?>
                    <div class="social-media-feed-item">
                        <a href="<?php echo esc_url($post['permalink']); ?>" class="social-feed-item" target="_blank">
                            <picture>
                                <img class="preview-picture" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr(wp_trim_words($text, 10)); ?>">
                            </picture>
                            <div class="time"><?php echo esc_html($time); ?></div>
                            <div class="description content-area">
                                <p><?php echo esc_html($short_text); ?> <span class="read-more">Mehr lesen</span></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <p class="tif-no-posts">Keine Instagram-Posts gefunden.</p>
        <?php endif; ?>
    </div>
</section>

<style>
.tif-error,
.tif-no-posts {
    padding: 20px;
    background: #fff3cd;
    border: 1px solid #ffc107;
    border-radius: 5px;
    color: #856404;
}
</style>
