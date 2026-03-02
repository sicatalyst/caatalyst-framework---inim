<?php
/**
 * INIM Fire Intelligence - TailPress Child Theme
 * 
 * Modular asset loading system - only loads CSS/JS for modules used on the page
 */

if (!defined('ABSPATH')) exit;

// Theme version for cache busting
define('INIM_VERSION', '1.0.0');

/**
 * Enqueue parent theme styles
 */
function inim_enqueue_parent_styles() {
  wp_enqueue_style('tailpress-parent', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'inim_enqueue_parent_styles');

/**
 * Load Vite manifest for asset URLs
 */
function inim_get_vite_manifest() {
  static $manifest = null;
  
  if ($manifest === null) {
    $manifest_path = get_stylesheet_directory() . '/dist/.vite/manifest.json';
    
    if (file_exists($manifest_path)) {
      $manifest = json_decode(file_get_contents($manifest_path), true);
    } else {
      $manifest = [];
    }
  }
  
  return $manifest;
}

/**
 * Get Vite asset URL from manifest
 */
function inim_get_vite_asset($entry) {
  $manifest = inim_get_vite_manifest();
  
  if (isset($manifest[$entry]['file'])) {
    return get_stylesheet_directory_uri() . '/dist/' . $manifest[$entry]['file'];
  }
  
  return false;
}

/**
 * Check if Vite dev server is running
 */
function inim_is_vite_dev() {
  static $is_dev = null;
  
  if ($is_dev === null) {
    $is_dev = defined('WP_DEBUG') && WP_DEBUG && 
              @file_get_contents('http://localhost:5173/@vite/client') !== false;
  }
  
  return $is_dev;
}

/**
 * Enqueue Vite assets (dev or production)
 */
function inim_enqueue_vite_assets() {
  if (inim_is_vite_dev()) {
    // Development mode - load from Vite dev server
    wp_enqueue_script('vite-client', 'http://localhost:5173/@vite/client', [], null, false);
    wp_script_add_data('vite-client', 'type', 'module');
    
    wp_enqueue_script('inim-app', 'http://localhost:5173/resources/js/app.js', ['vite-client'], null, true);
    wp_script_add_data('inim-app', 'type', 'module');
  } else {
    // Production mode - load from manifest
    $app_js = inim_get_vite_asset('resources/js/app.js');
    $app_css = inim_get_vite_asset('resources/css/app.css');
    
    if ($app_css) {
      wp_enqueue_style('inim-app', $app_css, [], INIM_VERSION);
    }
    
    if ($app_js) {
      wp_enqueue_script('inim-app', $app_js, [], INIM_VERSION, true);
      wp_script_add_data('inim-app', 'type', 'module');
    }
  }
}
add_action('wp_enqueue_scripts', 'inim_enqueue_vite_assets');

/**
 * Track which modules are used on the current page
 */
global $inim_used_modules;
$inim_used_modules = [];

function inim_register_module($module_name) {
  global $inim_used_modules;
  $inim_used_modules[] = $module_name;
}

/**
 * Enqueue module-specific assets
 */
function inim_enqueue_module_assets() {
  global $inim_used_modules;
  
  if (empty($inim_used_modules)) {
    return;
  }
  
  // Remove duplicates
  $inim_used_modules = array_unique($inim_used_modules);
  
  foreach ($inim_used_modules as $module) {
    $module_key = 'modules/' . $module;
    
    if (inim_is_vite_dev()) {
      // Development mode
      $dev_url = 'http://localhost:5173/resources/js/modules/' . $module . '.js';
      wp_enqueue_script('inim-module-' . $module, $dev_url, ['inim-app'], null, true);
      wp_script_add_data('inim-module-' . $module, 'type', 'module');
    } else {
      // Production mode
      $module_js = inim_get_vite_asset('resources/js/modules/' . $module . '.js');
      
      if ($module_js) {
        wp_enqueue_script('inim-module-' . $module, $module_js, ['inim-app'], INIM_VERSION, true);
        wp_script_add_data('inim-module-' . $module, 'type', 'module');
      }
    }
  }
}
add_action('wp_footer', 'inim_enqueue_module_assets', 5);

/**
 * ACF JSON save/load paths
 */
function inim_acf_json_save_point($path) {
  return get_stylesheet_directory() . '/acf-json';
}
add_filter('acf/settings/save_json', 'inim_acf_json_save_point');

function inim_acf_json_load_point($paths) {
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/acf-json';
  return $paths;
}
add_filter('acf/settings/load_json', 'inim_acf_json_load_point');

/**
 * Include module settings helper
 */
require_once get_stylesheet_directory() . '/modules/module-settings-helper.php';

// Hide ACF field groups from post editor (only show in page builder)
add_filter('acf/location/rule_match/post_type', 'hide_acf_groups_from_post_editor', 10, 3);
function hide_acf_groups_from_post_editor($match, $rule, $options) {
  // Get the current screen
  $screen = get_current_screen();
  
  // If we're on the post editor screen (not page builder), hide field groups
  if ($screen && $screen->base === 'post' && !isset($_GET['acf_flexible_content'])) {
    // List of field group keys to hide from direct post editing
    $hidden_groups = [
      'group_accordion',
      'group_image',
      'group_video',
      'group_cta_buttons',
      'group_post_listing',
      'group_header',
      'group_hero',
      'group_logo_slider',
      'group_about',
      'group_clients_grid',
      'group_sectors',
      'group_trusted_by',
      'group_fire_systems',
      'group_products',
      'group_logos_slider_bottom',
      'group_footer'
    ];
    
    // Check if current field group should be hidden
    if (isset($options['field_group']) && in_array($options['field_group'], $hidden_groups)) {
      return false;
    }
  }
  
  return $match;
}

/**
 * Include theme settings
 */
require_once get_stylesheet_directory() . '/inc/theme-settings.php';

/**
 * Theme support
 */
function inim_theme_support() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
  add_theme_support('custom-logo');
  
  register_nav_menus([
    'primary' => __('Primary Menu', 'inim-fire'),
    'footer' => __('Footer Menu', 'inim-fire'),
  ]);
}
add_action('after_setup_theme', 'inim_theme_support');
