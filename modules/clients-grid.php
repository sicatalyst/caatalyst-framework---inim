<?php
/**
 * Clients Grid Module
 * Works with both standalone ACF fields and Flexible Content
 */
$title = get_sub_field('clients_grid_title') ?: get_field('clients_grid_title');
$cards = get_sub_field('clients_grid_cards') ?: get_field('clients_grid_cards');
?>

<?php if ($cards): ?>
<section class="clients-grid-section">
  <?php if ($title): ?>
    <h2 class="clients-grid-title"><?php echo esc_html($title); ?></h2>
  <?php endif; ?>
  <div class="clients-grid">
    <?php foreach ($cards as $card): ?>
      <div class="client-card">
        <?php if ($card['image']): ?>
          <img src="<?php echo esc_url($card['image']['url']); ?>" 
               alt="<?php echo esc_attr($card['image']['alt']); ?>" 
               class="client-image" />
        <?php endif; ?>
        <?php if ($card['title']): ?>
          <h3 class="client-title"><?php echo esc_html($card['title']); ?></h3>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>
