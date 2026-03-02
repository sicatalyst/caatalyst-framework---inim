<?php
/**
 * Hero Banner Module
 * Works with both standalone ACF fields and Flexible Content
 */
$video_url = get_sub_field('hero_video_url') ?: get_field('hero_video_url');
$title = get_sub_field('hero_title') ?: get_field('hero_title');
$subtitle = get_sub_field('hero_subtitle') ?: get_field('hero_subtitle');
$primary_button = get_sub_field('hero_primary_button') ?: get_field('hero_primary_button');
$secondary_button = get_sub_field('hero_secondary_button') ?: get_field('hero_secondary_button');
?>

<section class="hero-banner">
  <div class="hero-video-container">
    <?php if ($video_url): ?>
      <video class="hero-video" autoplay muted loop playsinline>
        <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
      </video>
    <?php endif; ?>
    <div class="hero-overlay"></div>
  </div>
  <div class="hero-content">
    <?php if ($title): ?>
      <h1 class="hero-title"><?php echo wp_kses_post($title); ?></h1>
    <?php endif; ?>
    <?php if ($subtitle): ?>
      <p class="hero-subtitle"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>
    <div class="hero-buttons">
      <?php if ($primary_button): ?>
        <button class="btn-primary"><?php echo esc_html($primary_button['text']); ?></button>
      <?php endif; ?>
      <?php if ($secondary_button): ?>
        <button class="btn-secondary"><?php echo esc_html($secondary_button['text']); ?></button>
      <?php endif; ?>
    </div>
  </div>
</section>
