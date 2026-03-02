<?php
/**
 * CTA Button Repeater Module
 */
$settings = get_sub_field('module_settings');
$title = get_sub_field('cta_title');
$description = get_sub_field('cta_description');
$buttons = get_sub_field('cta_buttons');
$alignment = get_sub_field('cta_alignment') ?: 'center';

if (!$buttons) return;

$module_attrs = function_exists('get_module_attributes') ? get_module_attributes($settings) : '';
$module_styles = function_exists('get_module_styles') ? get_module_styles($settings) : '';
?>

<section class="cta-buttons-module" <?php echo $module_attrs; ?> style="<?php echo $module_styles; ?>">
  <?php
  if (function_exists('render_background_video')) render_background_video($settings);
  if (function_exists('render_background_overlay')) render_background_overlay($settings);
  ?>
  
  <div class="container">
    <div class="cta-content align-<?php echo esc_attr($alignment); ?>">
      <?php if ($title): ?>
        <h2 class="cta-title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>
      
      <?php if ($description): ?>
        <p class="cta-description"><?php echo esc_html($description); ?></p>
      <?php endif; ?>
      
      <div class="cta-buttons">
        <?php foreach ($buttons as $button): ?>
          <a 
            href="<?php echo esc_url($button['url']); ?>" 
            class="cta-button btn-<?php echo esc_attr($button['style']); ?>"
            <?php echo $button['target_blank'] ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
          >
            <?php if (!empty($button['icon'])): ?>
              <img src="<?php echo esc_url($button['icon']['url']); ?>" alt="" class="button-icon" />
            <?php endif; ?>
            <span><?php echo esc_html($button['text']); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  
  <?php if (function_exists('render_module_custom_css')) render_module_custom_css($settings, 'cta-buttons'); ?>
</section>
