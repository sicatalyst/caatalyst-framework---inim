<?php
/**
 * Sectors Slider Module
 * Works with both standalone ACF fields and Flexible Content
 */
$label = get_sub_field('sectors_label') ?: get_field('sectors_label');
$title = get_sub_field('sectors_title') ?: get_field('sectors_title');
$items = get_sub_field('sectors_items') ?: get_field('sectors_items');
$button_text = get_sub_field('sectors_button_text') ?: get_field('sectors_button_text');
?>

<?php if ($items): ?>
<section class="sectors-section">
  <div class="sectors-header">
    <?php if ($label): ?>
      <span class="sectors-label"><?php echo esc_html($label); ?></span>
    <?php endif; ?>
    <?php if ($title): ?>
      <h2 class="sectors-title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
  </div>
  
  <div class="swiper sectors-slider">
    <div class="swiper-wrapper">
      <?php foreach ($items as $item): ?>
        <div class="swiper-slide sector-slide">
          <?php if ($item['icon']): ?>
            <img src="<?php echo esc_url($item['icon']['url']); ?>" 
                 alt="<?php echo esc_attr($item['icon']['alt']); ?>" 
                 class="sector-icon" />
          <?php endif; ?>
          <?php if ($item['name']): ?>
            <h3 class="sector-name"><?php echo esc_html($item['name']); ?></h3>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  
  <div class="sector-content">
    <?php foreach ($items as $index => $item): ?>
      <div class="sector-content-item" data-index="<?php echo $index; ?>">
        <?php if ($item['content_title']): ?>
          <h3><?php echo esc_html($item['content_title']); ?></h3>
        <?php endif; ?>
        <?php if ($item['content_description']): ?>
          <p><?php echo esc_html($item['content_description']); ?></p>
        <?php endif; ?>
        <?php if ($item['content_image']): ?>
          <img src="<?php echo esc_url($item['content_image']['url']); ?>" 
               alt="<?php echo esc_attr($item['content_image']['alt']); ?>" />
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
  
  <?php if ($button_text): ?>
    <button class="btn-sectors"><?php echo esc_html($button_text); ?></button>
  <?php endif; ?>
</section>
<?php endif; ?>
