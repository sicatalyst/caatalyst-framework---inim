<?php
/**
 * Accordion Module
 */
$settings = get_sub_field('module_settings');
$title = get_sub_field('accordion_title');
$items = get_sub_field('accordion_items');

if (!$items) return;

$module_attrs = function_exists('get_module_attributes') ? get_module_attributes($settings) : '';
$module_styles = function_exists('get_module_styles') ? get_module_styles($settings) : '';
?>

<section class="accordion-module" <?php echo $module_attrs; ?> style="<?php echo $module_styles; ?>">
  <?php
  if (function_exists('render_background_video')) render_background_video($settings);
  if (function_exists('render_background_overlay')) render_background_overlay($settings);
  ?>
  
  <div class="container">
    <?php if ($title): ?>
      <h2 class="accordion-title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
    
    <div class="accordion-wrapper">
      <?php foreach ($items as $index => $item): ?>
        <div class="accordion-item <?php echo $item['open_default'] ? 'is-open' : ''; ?>" data-accordion-item>
          <button class="accordion-header" aria-expanded="<?php echo $item['open_default'] ? 'true' : 'false'; ?>">
            <span class="accordion-header-text"><?php echo esc_html($item['title']); ?></span>
            <span class="accordion-icon">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </button>
          <div class="accordion-content" <?php echo !$item['open_default'] ? 'style="display: none;"' : ''; ?>>
            <div class="accordion-content-inner">
              <?php echo wp_kses_post($item['content']); ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  
  <?php if (function_exists('render_module_custom_css')) render_module_custom_css($settings, 'accordion'); ?>
</section>
