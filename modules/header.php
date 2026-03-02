<?php
/**
 * Header Module
 * Works with both standalone ACF fields, Flexible Content, and Theme Settings
 */
inim_register_module('header');

// Try module fields first, then fall back to theme settings
$logo_images = get_sub_field('header_logo_images') ?: get_field('header_logo_images') ?: inim_get_setting('logo_images');
$nav_items = get_sub_field('header_navigation') ?: get_field('header_navigation');

// Get CTA from theme settings if not in module
$contact_button_text = get_sub_field('header_contact_button_text') ?: get_field('header_contact_button_text');
if (!$contact_button_text) {
  $primary_cta = inim_get_header_cta('primary');
  $contact_button_text = $primary_cta['text'] ?? 'Contact us';
  $contact_button_url = $primary_cta['url'] ?? '#';
} else {
  $contact_button_url = '#';
}

// Get icons from theme settings if not in module
$search_icon = get_sub_field('header_search_icon') ?: get_field('header_search_icon') ?: inim_get_setting('search_icon');
$menu_icon = get_sub_field('header_menu_icon') ?: get_field('header_menu_icon');
$show_search = inim_get_setting('show_search_icon', true);
?>

<header class="header">
  <div class="header-gradient"></div>
  <div class="header-content">
    <div class="inim-logo-white">
      <?php if ($logo_images): ?>
        <?php foreach ($logo_images as $index => $image): ?>
          <img class="vector<?php echo $index > 0 ? '-' . $index : ''; ?>" 
               src="<?php echo esc_url($image['url']); ?>" 
               alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
    
    <nav class="nav">
      <?php if ($nav_items): ?>
        <?php foreach ($nav_items as $item): ?>
          <div class="nav-item <?php echo $item['has_mega_menu'] ? 'has-mega-menu' : ''; ?> <?php echo $item['has_flyout'] ? 'has-flyout' : ''; ?>">
            <span><?php echo esc_html($item['label']); ?></span>
            
            <?php if ($item['has_mega_menu'] && $item['mega_menu_columns']): ?>
              <div class="mega-menu">
                <div class="mega-menu-content">
                  <?php foreach ($item['mega_menu_columns'] as $column): ?>
                    <div class="mega-menu-column">
                      <h3><?php echo esc_html($column['title']); ?></h3>
                      <ul>
                        <?php foreach ($column['links'] as $link): ?>
                          <li><a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['text']); ?></a></li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
            
            <?php if ($item['has_flyout'] && $item['flyout_links']): ?>
              <div class="flyout-menu">
                <ul>
                  <?php foreach ($item['flyout_links'] as $link): ?>
                    <li><a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['text']); ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </nav>
    
    <div class="header-actions">
      <a href="<?php echo esc_url($contact_button_url); ?>" class="btn-contact"><?php echo esc_html($contact_button_text); ?></a>
      <?php if ($show_search && $search_icon): ?>
        <img class="icon-search" src="<?php echo esc_url($search_icon['url']); ?>" alt="Search" />
      <?php endif; ?>
      <button class="mobile-menu-toggle" aria-label="Toggle menu">
        <?php if ($menu_icon): ?>
          <img src="<?php echo esc_url($menu_icon['url']); ?>" alt="Menu" />
        <?php endif; ?>
      </button>
    </div>
  </div>
</header>
