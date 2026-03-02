<?php
/**
 * Products Slider Module
 * Works with both standalone ACF fields and Flexible Content
 */
$label = get_sub_field('products_label') ?: get_field('products_label');
$title = get_sub_field('products_title') ?: get_field('products_title');
$items = get_sub_field('products_items') ?: get_field('products_items');
?>

<?php if ($items): ?>
<section class="products-section">
  <div class="products-header">
    <?php if ($label): ?>
      <span class="products-label"><?php echo esc_html($label); ?></span>
    <?php endif; ?>
    <?php if ($title): ?>
      <h2 class="products-title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
  </div>
  
  <div class="swiper products-slider">
    <div class="swiper-wrapper">
      <?php foreach ($items as $item): ?>
        <div class="swiper-slide product-slide">
          <?php if ($item['image']): ?>
            <img src="<?php echo esc_url($item['image']['url']); ?>" 
                 alt="<?php echo esc_attr($item['image']['alt']); ?>" 
                 class="product-image" />
          <?php endif; ?>
          <?php if ($item['title']): ?>
            <h3 class="product-title"><?php echo esc_html($item['title']); ?></h3>
          <?php endif; ?>
          <?php if ($item['description']): ?>
            <p class="product-description"><?php echo esc_html($item['description']); ?></p>
          <?php endif; ?>
          <?php if ($item['button_text']): ?>
            <button class="btn-product"><?php echo esc_html($item['button_text']); ?></button>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>
<?php endif; ?>
