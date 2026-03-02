<?php
/**
 * Video Module
 */
$settings = get_sub_field('module_settings');
$type = get_sub_field('video_type');
$file = get_sub_field('video_file');
$youtube_id = get_sub_field('video_youtube_id');
$vimeo_id = get_sub_field('video_vimeo_id');
$poster = get_sub_field('video_poster');
$caption = get_sub_field('video_caption');
$aspect_ratio = get_sub_field('video_aspect_ratio') ?: '16-9';

$module_attrs = function_exists('get_module_attributes') ? get_module_attributes($settings) : '';
$module_styles = function_exists('get_module_styles') ? get_module_styles($settings) : '';
?>

<section class="video-module" <?php echo $module_attrs; ?> style="<?php echo $module_styles; ?>">
  <?php
  if (function_exists('render_background_video')) render_background_video($settings);
  if (function_exists('render_background_overlay')) render_background_overlay($settings);
  ?>
  
  <div class="container">
    <div class="video-wrapper aspect-<?php echo esc_attr($aspect_ratio); ?>">
      <?php if ($type === 'upload' && $file): ?>
        <video class="video-player" controls <?php if ($poster): ?>poster="<?php echo esc_url($poster['url']); ?>"<?php endif; ?>>
          <source src="<?php echo esc_url($file['url']); ?>" type="<?php echo esc_attr($file['mime_type']); ?>">
          Your browser does not support the video tag.
        </video>
      
      <?php elseif ($type === 'youtube' && $youtube_id): ?>
        <div class="video-embed">
          <iframe 
            src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
          </iframe>
        </div>
      
      <?php elseif ($type === 'vimeo' && $vimeo_id): ?>
        <div class="video-embed">
          <iframe 
            src="https://player.vimeo.com/video/<?php echo esc_attr($vimeo_id); ?>" 
            frameborder="0" 
            allow="autoplay; fullscreen; picture-in-picture" 
            allowfullscreen>
          </iframe>
        </div>
      <?php endif; ?>
      
      <?php if ($caption): ?>
        <p class="video-caption"><?php echo esc_html($caption); ?></p>
      <?php endif; ?>
    </div>
  </div>
  
  <?php if (function_exists('render_module_custom_css')) render_module_custom_css($settings, 'video'); ?>
</section>
