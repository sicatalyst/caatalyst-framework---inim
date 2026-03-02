<?php
/**
 * Trusted By Module
 * Works with both standalone ACF fields and Flexible Content
 */
$title = get_sub_field('trusted_by_title') ?: get_field('trusted_by_title');
$logos = get_sub_field('trusted_by_logos') ?: get_field('trusted_by_logos');
?>

<?php if ($logos): ?>
<section class="trusted-by-section">
  <?php if ($title): ?>
    <h2 class="trusted-by-title"><?php echo esc_html($title); ?></h2>
  <?php endif; ?>
  <div class="trusted-by-logos">
    <?php foreach ($logos as $logo): ?>
      <img src="<?php echo esc_url($logo['url']); ?>" 
           alt="<?php echo esc_attr($logo['alt']); ?>" 
           class="trusted-logo" />
    <?php endforeach; ?>
  </div>
</section>
<?php endif; ?>
