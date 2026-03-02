<?php
/**
 * Logo Slider Module
 * Works with both standalone ACF fields and Flexible Content
 */
$logos = get_sub_field('logo_slider_logos') ?: get_field('logo_slider_logos');
$title = get_sub_field('logos_slider_title') ?: get_field('logos_slider_title');
$logos_bottom = get_sub_field('logos_slider_logos_bottom') ?: get_field('logos_slider_logos_bottom');

// Use whichever logos field is populated
$logos_to_display = $logos ?: $logos_bottom;
?>

<?php if ($logos_to_display): ?>
<section class="logo-slider-section">
  <?php if ($title): ?>
    <h2 class="logo-slider-title"><?php echo esc_html($title); ?></h2>
  <?php endif; ?>
  <div class="swiper logo-slider">
    <div class="swiper-wrapper">
      <?php foreach ($logos_to_display as $logo): ?>
        <div class="swiper-slide">
          <img src="<?php echo esc_url($logo['url']); ?>" 
               alt="<?php echo esc_attr($logo['alt']); ?>" 
               class="logo-image" />
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
