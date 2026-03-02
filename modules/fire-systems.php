<?php
/**
 * Fire Systems Module
 * Works with both standalone ACF fields and Flexible Content
 */
$title = get_sub_field('fire_systems_title') ?: get_field('fire_systems_title');
$cards = get_sub_field('fire_systems_cards') ?: get_field('fire_systems_cards');
?>

<?php if ($cards): ?>
<section class="fire-systems-section">
  <?php if ($title): ?>
    <h2 class="fire-systems-title"><?php echo esc_html($title); ?></h2>
  <?php endif; ?>
  <div class="fire-systems-grid">
    <?php foreach ($cards as $card): ?>
      <div class="fire-system-card">
        <?php if ($card['icon']): ?>
          <img src="<?php echo esc_url($card['icon']['url']); ?>" 
               alt="<?php echo esc_attr($card['icon']['alt']); ?>" 
               class="system-icon" />
        <?php endif; ?>
        <?php if ($card['title']): ?>
          <h3 class="system-title"><?php echo esc_html($card['title']); ?></h3>
        <?php endif; ?>
        <?php if ($card['arrow_icon']): ?>
          <img src="<?php echo esc_url($card['arrow_icon']['url']); ?>" 
               alt="Arrow" 
               class="system-arrow" />
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>
