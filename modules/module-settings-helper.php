<?php
/**
 * Module Settings Helper Functions
 * 
 * Usage in module templates:
 * 
 * <?php
 * $settings = get_sub_field('module_settings');
 * $module_attrs = get_module_attributes($settings);
 * $module_styles = get_module_styles($settings);
 * ?>
 * 
 * <section <?php echo $module_attrs; ?> style="<?php echo $module_styles; ?>">
 *   <!-- Module content -->
 * </section>
 */

/**
 * Generate HTML attributes for module wrapper
 */
function get_module_attributes($settings) {
  if (!$settings) return '';
  
  $attrs = array();
  
  // HTML ID
  if (!empty($settings['module_html_id'])) {
    $attrs[] = 'id="' . esc_attr($settings['module_html_id']) . '"';
  }
  
  // CSS Classes
  $classes = array('module-wrapper');
  
  if (!empty($settings['module_custom_classes'])) {
    $classes[] = esc_attr($settings['module_custom_classes']);
  }
  
  // Visibility classes
  if (isset($settings['module_visibility_desktop']) && !$settings['module_visibility_desktop']) {
    $classes[] = 'hide-desktop';
  }
  if (isset($settings['module_visibility_tablet']) && !$settings['module_visibility_tablet']) {
    $classes[] = 'hide-tablet';
  }
  if (isset($settings['module_visibility_mobile']) && !$settings['module_visibility_mobile']) {
    $classes[] = 'hide-mobile';
  }
  
  // Container width class
  if (!empty($settings['module_container_width'])) {
    $classes[] = 'container-' . esc_attr($settings['module_container_width']);
  }
  
  // Animation classes
  if (!empty($settings['module_animation_enabled'])) {
    $classes[] = 'gsap-animate';
    $classes[] = 'animate-' . esc_attr($settings['module_animation_type']);
  }
  
  $attrs[] = 'class="' . implode(' ', $classes) . '"';
  
  // Data attributes for GSAP
  if (!empty($settings['module_animation_enabled'])) {
    if (!empty($settings['module_animation_duration'])) {
      $attrs[] = 'data-animation-duration="' . esc_attr($settings['module_animation_duration']) . '"';
    }
    if (!empty($settings['module_animation_delay'])) {
      $attrs[] = 'data-animation-delay="' . esc_attr($settings['module_animation_delay']) . '"';
    }
    if (!empty($settings['module_animation_easing'])) {
      $attrs[] = 'data-animation-easing="' . esc_attr($settings['module_animation_easing']) . '"';
    }
    if (!empty($settings['module_animation_stagger'])) {
      $attrs[] = 'data-animation-stagger="' . esc_attr($settings['module_animation_stagger']) . '"';
    }
  }
  
  return implode(' ', $attrs);
}

/**
 * Generate inline styles for module wrapper
 */
function get_module_styles($settings) {
  if (!$settings) return '';
  
  $styles = array();
  
  // Spacing
  if (!empty($settings['module_padding_top'])) {
    $styles[] = 'padding-top: ' . esc_attr($settings['module_padding_top']) . 'px';
  }
  if (!empty($settings['module_padding_bottom'])) {
    $styles[] = 'padding-bottom: ' . esc_attr($settings['module_padding_bottom']) . 'px';
  }
  if (!empty($settings['module_margin_top'])) {
    $styles[] = 'margin-top: ' . esc_attr($settings['module_margin_top']) . 'px';
  }
  if (!empty($settings['module_margin_bottom'])) {
    $styles[] = 'margin-bottom: ' . esc_attr($settings['module_margin_bottom']) . 'px';
  }
  
  // Z-Index
  if (isset($settings['module_z_index']) && $settings['module_z_index'] !== '') {
    $styles[] = 'z-index: ' . intval($settings['module_z_index']);
  }
  
  // Background
  if (!empty($settings['module_background_type'])) {
    switch ($settings['module_background_type']) {
      case 'color':
        if (!empty($settings['module_background_color'])) {
          $styles[] = 'background-color: ' . esc_attr($settings['module_background_color']);
        }
        break;
        
      case 'gradient':
        if (!empty($settings['module_background_gradient'])) {
          $grad = $settings['module_background_gradient'];
          $color1 = !empty($grad['color_1']) ? $grad['color_1'] : '#ffffff';
          $color2 = !empty($grad['color_2']) ? $grad['color_2'] : '#f0f0f0';
          $direction = !empty($grad['direction']) ? $grad['direction'] : 'to bottom';
          $styles[] = 'background: linear-gradient(' . esc_attr($direction) . ', ' . esc_attr($color1) . ', ' . esc_attr($color2) . ')';
        }
        break;
        
      case 'image':
        if (!empty($settings['module_background_image'])) {
          $img = $settings['module_background_image'];
          $styles[] = 'background-image: url(' . esc_url($img['url']) . ')';
          
          if (!empty($settings['module_background_image_settings'])) {
            $img_settings = $settings['module_background_image_settings'];
            
            if (!empty($img_settings['size'])) {
              $styles[] = 'background-size: ' . esc_attr($img_settings['size']);
            }
            if (!empty($img_settings['position'])) {
              $styles[] = 'background-position: ' . esc_attr($img_settings['position']);
            }
            if (!empty($img_settings['repeat'])) {
              $styles[] = 'background-repeat: ' . esc_attr($img_settings['repeat']);
            }
          }
        }
        break;
    }
  }
  
  return implode('; ', $styles);
}

/**
 * Output background overlay (for images/videos)
 */
function render_background_overlay($settings) {
  if (empty($settings['module_background_type'])) return;
  
  $overlay_color = '';
  
  if ($settings['module_background_type'] === 'image' && !empty($settings['module_background_image_settings']['overlay'])) {
    $overlay_color = $settings['module_background_image_settings']['overlay'];
  } elseif ($settings['module_background_type'] === 'video' && !empty($settings['module_background_video']['overlay'])) {
    $overlay_color = $settings['module_background_video']['overlay'];
  }
  
  if ($overlay_color) {
    echo '<div class="module-background-overlay" style="background-color: ' . esc_attr($overlay_color) . ';"></div>';
  }
}

/**
 * Output background video
 */
function render_background_video($settings) {
  if (empty($settings['module_background_type']) || $settings['module_background_type'] !== 'video') return;
  if (empty($settings['module_background_video']['url'])) return;
  
  $video_url = $settings['module_background_video']['url'];
  $fallback = !empty($settings['module_background_video']['fallback']) ? $settings['module_background_video']['fallback'] : null;
  
  ?>
  <div class="module-background-video">
    <video autoplay muted loop playsinline <?php if ($fallback): ?>poster="<?php echo esc_url($fallback['url']); ?>"<?php endif; ?>>
      <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
    </video>
  </div>
  <?php
}

/**
 * Output custom CSS for module
 */
function render_module_custom_css($settings, $module_id) {
  if (empty($settings['module_custom_css'])) return;
  
  echo '<style>';
  echo wp_kses_post($settings['module_custom_css']);
  echo '</style>';
}
