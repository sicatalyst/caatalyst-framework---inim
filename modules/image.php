<?php
/**
 * Image Module
 */
$settings = get_sub_field('module_settings');
$image = get_sub_field('image_image');
$caption = get_sub_field('image_caption');
$link = get_sub_field('image_link');
$size = get_sub_field('image_size') ?: 'large';
$alignment = get_sub_field('image_alignment') ?: 'center';

if (!$image) return;

$module_attrs = function_exists('get_module_attributes') ? get_module_attributes($settings) : '';
$module_styles = function_exists('get_module_styles') ? get_module_styles($settings) : '';

$size_classes = [
  'full' => 'image-full',
  'large' => 'image-large',
  'medium' => 'image-medium',
  'small' => 'image-small'
];
?>

<section class="image-module" <?php echo $module_attrs; ?> style="<?php echo $module_styles; ?>">
  <?php
  if (function_exists('render_background_video')) render_background_video($settings);
  if (function_exists('render_background_overlay')) render_background_overlay($settings);
  ?>
  
  <div class="container">
    <div class="image-wrapper align-<?php echo esc_attr($alignment); ?> <?php echo esc_attr($size_classes[$size]); ?>">
      <?php if ($link): ?>
        <a href="<?php echo esc_url($link); ?>" class="image-link">
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        </a>
      <?php else: ?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
      <?php endif; ?>
      
      <?php if ($caption): ?>
        <p class="image-caption"><?php echo esc_html($caption); ?></p>
      <?php endif; ?>
    </div>
  </div>
  
  <?php if (function_exists('render_module_custom_css')) render_module_custom_css($settings, 'image'); ?>
</section>
