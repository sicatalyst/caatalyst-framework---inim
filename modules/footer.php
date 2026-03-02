<?php
/**
 * Footer Module
 * Works with both module fields and Theme Settings
 */
inim_register_module('footer');

// Try module fields first, then fall back to theme settings
$logo_images = get_sub_field('footer_logo_images') ?: get_field('footer_logo_images');
if (!$logo_images) {
  $footer_logo = inim_get_setting('footer_logo');
  if ($footer_logo) {
    $logo_images = [$footer_logo];
  }
}

$intro_text = get_sub_field('footer_intro_text') ?: get_field('footer_intro_text') ?: inim_get_setting('footer_tagline');
$accreditations_image = get_sub_field('footer_accreditations_image') ?: get_field('footer_accreditations_image') ?: inim_get_setting('accreditations_image');

// Get contact info from theme settings
$contact_info = inim_get_contact_info();
$address = get_sub_field('footer_address') ?: get_field('footer_address') ?: $contact_info['address'];
$company_number = get_sub_field('footer_company_number') ?: get_field('footer_company_number') ?: $contact_info['company_number'];

$social_icons = get_sub_field('footer_social_icons') ?: get_field('footer_social_icons');
$columns = get_sub_field('footer_columns') ?: get_field('footer_columns');

// Use theme settings social links if no module social icons
$use_theme_social = empty($social_icons) && !empty(inim_get_social_links());
?>

<footer class="footer">
  <div class="footer-content">
    <div class="footer-main">
      <div class="footer-brand">
        <?php if ($logo_images): ?>
          <div class="footer-logo">
            <?php foreach ($logo_images as $index => $image): ?>
              <img src="<?php echo esc_url($image['url']); ?>" 
                   alt="<?php echo esc_attr($image['alt']); ?>" 
                   class="footer-logo-part-<?php echo $index; ?>" />
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <?php if ($intro_text): ?>
          <p class="footer-intro"><?php echo esc_html($intro_text); ?></p>
        <?php endif; ?>
        <?php if ($accreditations_image): ?>
          <img src="<?php echo esc_url($accreditations_image['url']); ?>" 
               alt="<?php echo esc_attr($accreditations_image['alt']); ?>" 
               class="footer-accreditations" />
        <?php endif; ?>
      </div>
      
      <?php if ($columns): ?>
        <div class="footer-columns">
          <?php foreach ($columns as $column): ?>
            <div class="footer-column">
              <?php if ($column['title']): ?>
                <h3 class="footer-column-title"><?php echo esc_html($column['title']); ?></h3>
              <?php endif; ?>
              <?php if ($column['links']): ?>
                <ul class="footer-links">
                  <?php foreach ($column['links'] as $link): ?>
                    <li>
                      <a href="<?php echo esc_url($link['url']); ?>">
                        <?php echo esc_html($link['text']); ?>
                      </a>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    
    <div class="footer-bottom">
      <div class="footer-info">
        <?php if ($address): ?>
          <p class="footer-address"><?php echo nl2br(esc_html($address)); ?></p>
        <?php endif; ?>
        <?php if ($company_number): ?>
          <p class="footer-company"><?php echo esc_html($company_number); ?></p>
        <?php endif; ?>
      </div>
      <div class="footer-social">
        <?php if ($use_theme_social): ?>
          <?php inim_render_social_icons(); ?>
        <?php elseif ($social_icons): ?>
          <?php foreach ($social_icons as $icon): ?>
            <a href="#" class="social-link">
              <img src="<?php echo esc_url($icon['url']); ?>" 
                   alt="<?php echo esc_attr($icon['alt']); ?>" />
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>
