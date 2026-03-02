<?php
/**
 * Theme Settings - ACF Options Page
 * 
 * Provides a centralized interface for managing global theme settings:
 * - Brand colors (synced with Tailwind CSS)
 * - Contact information
 * - Header/Footer settings
 * - Social media links
 */

if (!defined('ABSPATH')) exit;

/**
 * Register ACF Options Page
 */
if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title'  => 'Theme Settings',
    'menu_title'  => 'Theme Settings',
    'menu_slug'   => 'theme-settings',
    'capability'  => 'edit_theme_options',
    'icon_url'    => 'dashicons-admin-generic',
    'position'    => 59,
    'redirect'    => false,
  ]);
}

/**
 * Get theme setting value
 * 
 * @param string $key Field name
 * @param mixed $default Default value if field is empty
 * @return mixed Field value
 */
function inim_get_setting($key, $default = '') {
  $value = get_field($key, 'option');
  return $value ?: $default;
}

/**
 * Output CSS custom properties for theme colors, typography, and CTA buttons
 */
function inim_output_theme_variables() {
  // Brand Colors
  $primary = inim_get_setting('primary_color', '#174274');
  $secondary = inim_get_setting('secondary_color', '#ed1c24');
  $dark = inim_get_setting('dark_color', '#0f2d4d');
  $light = inim_get_setting('light_color', '#88afff');
  
  // CTA Button Styles
  $cta_primary = inim_get_setting('cta_primary', []);
  $cta_secondary = inim_get_setting('cta_secondary', []);
  $cta_tertiary = inim_get_setting('cta_tertiary', []);
  
  // Typography
  $base_font_size = inim_get_setting('base_font_size', 16);
  $line_height = inim_get_setting('line_height', 1.6);
  $letter_spacing = inim_get_setting('letter_spacing', 0);
  
  $heading_desktop = inim_get_setting('heading_sizes_desktop', []);
  $heading_mobile = inim_get_setting('heading_sizes_mobile', []);
  $text_colors = inim_get_setting('text_colors', []);
  
  echo '<style id="inim-theme-variables">:root {';
  
  // Brand Colors
  echo '--color-primary: ' . esc_attr($primary) . ';';
  echo '--color-secondary: ' . esc_attr($secondary) . ';';
  echo '--color-dark: ' . esc_attr($dark) . ';';
  echo '--color-light: ' . esc_attr($light) . ';';
  
  // CTA Primary
  if (!empty($cta_primary)) {
    echo '--cta-primary-bg: ' . esc_attr($cta_primary['bg_color'] ?? '#174274') . ';';
    echo '--cta-primary-text: ' . esc_attr($cta_primary['text_color'] ?? '#ffffff') . ';';
    echo '--cta-primary-bg-hover: ' . esc_attr($cta_primary['bg_hover'] ?? '#0f2d4d') . ';';
    echo '--cta-primary-text-hover: ' . esc_attr($cta_primary['text_hover'] ?? '#ffffff') . ';';
    echo '--cta-primary-border: ' . esc_attr($cta_primary['border_color'] ?? '#174274') . ';';
    echo '--cta-primary-border-hover: ' . esc_attr($cta_primary['border_hover'] ?? '#0f2d4d') . ';';
    echo '--cta-primary-border-width: ' . esc_attr($cta_primary['border_width'] ?? '2') . 'px;';
  }
  
  // CTA Secondary
  if (!empty($cta_secondary)) {
    echo '--cta-secondary-bg: ' . esc_attr($cta_secondary['bg_color'] ?? 'rgba(255,255,255,0)') . ';';
    echo '--cta-secondary-text: ' . esc_attr($cta_secondary['text_color'] ?? '#174274') . ';';
    echo '--cta-secondary-bg-hover: ' . esc_attr($cta_secondary['bg_hover'] ?? '#174274') . ';';
    echo '--cta-secondary-text-hover: ' . esc_attr($cta_secondary['text_hover'] ?? '#ffffff') . ';';
    echo '--cta-secondary-border: ' . esc_attr($cta_secondary['border_color'] ?? '#174274') . ';';
    echo '--cta-secondary-border-hover: ' . esc_attr($cta_secondary['border_hover'] ?? '#174274') . ';';
    echo '--cta-secondary-border-width: ' . esc_attr($cta_secondary['border_width'] ?? '2') . 'px;';
  }
  
  // CTA Tertiary
  if (!empty($cta_tertiary)) {
    echo '--cta-tertiary-bg: ' . esc_attr($cta_tertiary['bg_color'] ?? '#ed1c24') . ';';
    echo '--cta-tertiary-text: ' . esc_attr($cta_tertiary['text_color'] ?? '#ffffff') . ';';
    echo '--cta-tertiary-bg-hover: ' . esc_attr($cta_tertiary['bg_hover'] ?? '#c41820') . ';';
    echo '--cta-tertiary-text-hover: ' . esc_attr($cta_tertiary['text_hover'] ?? '#ffffff') . ';';
    echo '--cta-tertiary-border: ' . esc_attr($cta_tertiary['border_color'] ?? '#ed1c24') . ';';
    echo '--cta-tertiary-border-hover: ' . esc_attr($cta_tertiary['border_hover'] ?? '#c41820') . ';';
    echo '--cta-tertiary-border-width: ' . esc_attr($cta_tertiary['border_width'] ?? '2') . 'px;';
  }
  
  // Typography Base
  echo '--font-size-base: ' . esc_attr($base_font_size) . 'px;';
  echo '--line-height-base: ' . esc_attr($line_height) . ';';
  echo '--letter-spacing-base: ' . esc_attr($letter_spacing) . 'px;';
  
  // Heading Sizes Desktop
  if (!empty($heading_desktop)) {
    echo '--font-size-h1: ' . esc_attr($heading_desktop['h1'] ?? 48) . 'px;';
    echo '--font-size-h2: ' . esc_attr($heading_desktop['h2'] ?? 40) . 'px;';
    echo '--font-size-h3: ' . esc_attr($heading_desktop['h3'] ?? 32) . 'px;';
    echo '--font-size-h4: ' . esc_attr($heading_desktop['h4'] ?? 24) . 'px;';
    echo '--font-size-h5: ' . esc_attr($heading_desktop['h5'] ?? 20) . 'px;';
    echo '--font-size-h6: ' . esc_attr($heading_desktop['h6'] ?? 18) . 'px;';
  }
  
  // Text Colors
  if (!empty($text_colors)) {
    echo '--color-text-body: ' . esc_attr($text_colors['body_text'] ?? '#231f20') . ';';
    echo '--color-text-heading: ' . esc_attr($text_colors['heading_text'] ?? '#174274') . ';';
    echo '--color-link: ' . esc_attr($text_colors['link_color'] ?? '#174274') . ';';
    echo '--color-link-hover: ' . esc_attr($text_colors['link_hover'] ?? '#ed1c24') . ';';
  }
  
  echo '}';
  
  // Mobile Heading Sizes
  if (!empty($heading_mobile)) {
    echo '@media (max-width: 767px) { :root {';
    echo '--font-size-h1: ' . esc_attr($heading_mobile['h1'] ?? 32) . 'px;';
    echo '--font-size-h2: ' . esc_attr($heading_mobile['h2'] ?? 28) . 'px;';
    echo '--font-size-h3: ' . esc_attr($heading_mobile['h3'] ?? 24) . 'px;';
    echo '--font-size-h4: ' . esc_attr($heading_mobile['h4'] ?? 20) . 'px;';
    echo '--font-size-h5: ' . esc_attr($heading_mobile['h5'] ?? 18) . 'px;';
    echo '--font-size-h6: ' . esc_attr($heading_mobile['h6'] ?? 16) . 'px;';
    echo '}}';
  }
  
  // Apply typography to elements
  echo 'body { font-size: var(--font-size-base); line-height: var(--line-height-base); letter-spacing: var(--letter-spacing-base); color: var(--color-text-body); }';
  echo 'h1, h2, h3, h4, h5, h6 { color: var(--color-text-heading); }';
  echo 'h1 { font-size: var(--font-size-h1); }';
  echo 'h2 { font-size: var(--font-size-h2); }';
  echo 'h3 { font-size: var(--font-size-h3); }';
  echo 'h4 { font-size: var(--font-size-h4); }';
  echo 'h5 { font-size: var(--font-size-h5); }';
  echo 'h6 { font-size: var(--font-size-h6); }';
  echo 'a { color: var(--color-link); }';
  echo 'a:hover { color: var(--color-link-hover); }';
  
  // CTA Button Classes
  echo '.btn-primary { background: var(--cta-primary-bg); color: var(--cta-primary-text); border: var(--cta-primary-border-width) solid var(--cta-primary-border); }';
  echo '.btn-primary:hover { background: var(--cta-primary-bg-hover); color: var(--cta-primary-text-hover); border-color: var(--cta-primary-border-hover); }';
  
  echo '.btn-secondary { background: var(--cta-secondary-bg); color: var(--cta-secondary-text); border: var(--cta-secondary-border-width) solid var(--cta-secondary-border); }';
  echo '.btn-secondary:hover { background: var(--cta-secondary-bg-hover); color: var(--cta-secondary-text-hover); border-color: var(--cta-secondary-border-hover); }';
  
  echo '.btn-tertiary { background: var(--cta-tertiary-bg); color: var(--cta-tertiary-text); border: var(--cta-tertiary-border-width) solid var(--cta-tertiary-border); }';
  echo '.btn-tertiary:hover { background: var(--cta-tertiary-bg-hover); color: var(--cta-tertiary-text-hover); border-color: var(--cta-tertiary-border-hover); }';
  
  echo '</style>';
}
add_action('wp_head', 'inim_output_theme_variables', 5);

/**
 * Get header logo (from theme settings or fallback to header module)
 * 
 * @return array|false Image array or false
 */
function inim_get_header_logo() {
  // Try theme settings first
  $logo = inim_get_setting('site_logo');
  if ($logo) {
    return $logo;
  }
  
  // Fallback to logo_images gallery
  $logo_images = inim_get_setting('logo_images');
  if ($logo_images && is_array($logo_images)) {
    return $logo_images;
  }
  
  return false;
}

/**
 * Get header CTA button
 * 
 * @param string $type 'primary' or 'secondary'
 * @return array|false Button data or false
 */
function inim_get_header_cta($type = 'primary') {
  $cta = inim_get_setting('header_cta_' . $type);
  
  if ($type === 'secondary' && (!$cta || !$cta['enabled'])) {
    return false;
  }
  
  return $cta;
}

/**
 * Get contact information
 * 
 * @return array Contact details
 */
function inim_get_contact_info() {
  return [
    'company_name' => inim_get_setting('company_name', 'INIM Fire Intelligence'),
    'phone' => inim_get_setting('phone_number'),
    'email' => inim_get_setting('email_address'),
    'address' => inim_get_setting('address'),
    'company_number' => inim_get_setting('company_number'),
  ];
}

/**
 * Get social media links
 * 
 * @return array Social links
 */
function inim_get_social_links() {
  return inim_get_setting('social_links', []);
}

/**
 * Get footer copyright text with year replacement
 * 
 * @return string Copyright text
 */
function inim_get_copyright() {
  $text = inim_get_setting('copyright_text', '© {year} INIM Fire Intelligence. All rights reserved.');
  return str_replace('{year}', date('Y'), $text);
}

/**
 * Render social media icons
 * 
 * @param string $class Additional CSS classes
 */
function inim_render_social_icons($class = '') {
  $social_links = inim_get_social_links();
  
  if (empty($social_links)) {
    return;
  }
  
  echo '<div class="social-icons ' . esc_attr($class) . '">';
  
  foreach ($social_links as $link) {
    $platform = $link['platform'];
    $url = $link['url'];
    $icon = $link['icon'];
    
    if (!$url) continue;
    
    echo '<a href="' . esc_url($url) . '" target="_blank" rel="noopener noreferrer" class="social-icon social-icon-' . esc_attr($platform) . '" aria-label="' . esc_attr(ucfirst($platform)) . '">';
    
    if ($icon && isset($icon['url'])) {
      echo '<img src="' . esc_url($icon['url']) . '" alt="' . esc_attr($platform) . '" />';
    } else {
      // Default SVG icons for common platforms
      echo inim_get_default_social_icon($platform);
    }
    
    echo '</a>';
  }
  
  echo '</div>';
}

/**
 * Get default social media icon SVG
 * 
 * @param string $platform Platform name
 * @return string SVG markup
 */
function inim_get_default_social_icon($platform) {
  $icons = [
    'facebook' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
    'twitter' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
    'linkedin' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
    'instagram' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>',
    'youtube' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
    'tiktok' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
  ];
  
  return $icons[$platform] ?? '';
}

/**
 * Load Google Fonts or Self-Hosted Fonts
 */
function inim_load_fonts() {
  $font_source = inim_get_setting('font_source', 'google');
  
  if ($font_source === 'google') {
    $primary_font = inim_get_setting('google_font_primary', 'Inter');
    $secondary_font = inim_get_setting('google_font_secondary', '');
    $weights = inim_get_setting('google_font_weights', ['400', '600', '700']);
    
    if (!empty($primary_font)) {
      $weight_string = implode(';', array_map(function($w) { return 'wght@' . $w; }, $weights));
      $font_url = 'https://fonts.googleapis.com/css2?family=' . str_replace(' ', '+', $primary_font) . ':' . $weight_string;
      
      if (!empty($secondary_font)) {
        $font_url .= '&family=' . str_replace(' ', '+', $secondary_font) . ':' . $weight_string;
      }
      
      $font_url .= '&display=swap';
      
      echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
      echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
      echo '<link href="' . esc_url($font_url) . '" rel="stylesheet">';
      
      echo '<style>';
      echo 'body { font-family: "' . esc_attr($primary_font) . '", sans-serif; }';
      if (!empty($secondary_font)) {
        echo 'h1, h2, h3, h4, h5, h6 { font-family: "' . esc_attr($secondary_font) . '", sans-serif; }';
      }
      echo '</style>';
    }
  } elseif ($font_source === 'self_hosted') {
    $fonts = inim_get_setting('self_hosted_fonts', []);
    
    if (!empty($fonts)) {
      echo '<style>';
      
      foreach ($fonts as $font) {
        $family = $font['family_name'];
        $weight = $font['weight'];
        $style = $font['style'];
        $woff2 = $font['file_woff2']['url'] ?? '';
        $woff = $font['file_woff']['url'] ?? '';
        
        if (!empty($woff2) || !empty($woff)) {
          echo '@font-face {';
          echo 'font-family: "' . esc_attr($family) . '";';
          echo 'font-weight: ' . esc_attr($weight) . ';';
          echo 'font-style: ' . esc_attr($style) . ';';
          echo 'font-display: swap;';
          echo 'src: ';
          
          $sources = [];
          if (!empty($woff2)) {
            $sources[] = 'url("' . esc_url($woff2) . '") format("woff2")';
          }
          if (!empty($woff)) {
            $sources[] = 'url("' . esc_url($woff) . '") format("woff")';
          }
          
          echo implode(', ', $sources) . ';';
          echo '}';
        }
      }
      
      // Apply first font as default
      if (!empty($fonts[0]['family_name'])) {
        echo 'body { font-family: "' . esc_attr($fonts[0]['family_name']) . '", sans-serif; }';
      }
      
      echo '</style>';
    }
  }
}
add_action('wp_head', 'inim_load_fonts', 3);

/**
 * Update Tailwind config colors dynamically (optional)
 * This creates a PHP file that Tailwind can import
 */
function inim_update_tailwind_colors() {
  $primary = inim_get_setting('primary_color', '#174274');
  $secondary = inim_get_setting('secondary_color', '#ed1c24');
  $dark = inim_get_setting('dark_color', '#0f2d4d');
  $light = inim_get_setting('light_color', '#88afff');
  
  $colors_js = "// Auto-generated by Theme Settings - Do not edit manually\n";
  $colors_js .= "export default {\n";
  $colors_js .= "  'inim-blue': '{$primary}',\n";
  $colors_js .= "  'inim-blue-dark': '{$dark}',\n";
  $colors_js .= "  'inim-blue-light': '{$light}',\n";
  $colors_js .= "  'inim-red': '{$secondary}',\n";
  $colors_js .= "  'inim-black': '#231f20',\n";
  $colors_js .= "};\n";
  
  $colors_file = get_stylesheet_directory() . '/tailwind-colors.js';
  file_put_contents($colors_file, $colors_js);
}

// Update Tailwind colors when theme settings are saved
add_action('acf/save_post', function($post_id) {
  if ($post_id === 'options') {
    inim_update_tailwind_colors();
  }
}, 20);
