<?php
/**
 * Logos Slider Module (Bottom)
 */
$title = get_field('logos_slider_title');
$logos = get_field('logos_slider_logos_bottom');
?>

<?php if ($logos): ?>
<section class="logos-slider">
  <?php if ($title): ?>
    <h2><?php echo esc_html($title); ?></h2>
  <?php endif; ?>
  <div class="swiper clients-swiper">
    <div class="swiper-wrapper">
      <?php foreach ($logos as $logo): ?>
        <div class="swiper-slide">
          <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
