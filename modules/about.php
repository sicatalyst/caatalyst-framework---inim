<?php
/**
 * About Module
 * Works with both standalone ACF fields and Flexible Content
 */
$background_image = get_sub_field('about_background_image') ?: get_field('about_background_image');
$label = get_sub_field('about_label') ?: get_field('about_label');
$title = get_sub_field('about_title') ?: get_field('about_title');
$description = get_sub_field('about_description') ?: get_field('about_description');
$button_text = get_sub_field('about_button_text') ?: get_field('about_button_text');
$icon_images = get_sub_field('about_icon_images') ?: get_field('about_icon_images');
?>

<section class="about-section" <?php if ($background_image): ?>style="background-image: url('<?php echo esc_url($background_image['url']); ?>');"<?php endif; ?>>
  <div class="about-content">
    <?php if ($label): ?>
      <span class="about-label"><?php echo esc_html($label); ?></span>
    <?php endif; ?>
    <?php if ($title): ?>
      <h2 class="about-title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
    <?php if ($description): ?>
      <div class="about-description"><?php echo wp_kses_post($description); ?></div>
    <?php endif; ?>
    <?php if ($button_text): ?>
      <button class="btn-about"><?php echo esc_html($button_text); ?></button>
    <?php endif; ?>
  </div>
  <?php if ($icon_images): ?>
    <div class="about-icons">
      <?php foreach ($icon_images as $icon): ?>
        <img src="<?php echo esc_url($icon['url']); ?>" 
             alt="<?php echo esc_attr($icon['alt']); ?>" 
             class="about-icon" />
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>
