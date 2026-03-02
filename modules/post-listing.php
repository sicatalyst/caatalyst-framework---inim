<?php
/**
 * Post Type Listing Module
 */
$settings = get_sub_field('module_settings');
$title = get_sub_field('post_listing_title');
$post_type = get_sub_field('post_listing_post_type') ?: 'post';
$layout = get_sub_field('post_listing_layout') ?: 'grid';
$posts_per_page = get_sub_field('post_listing_posts_per_page') ?: 6;
$columns = get_sub_field('post_listing_columns') ?: '3';
$slider_options = get_sub_field('post_listing_slider_options');
$show_featured_image = get_sub_field('post_listing_show_featured_image');
$show_excerpt = get_sub_field('post_listing_show_excerpt');
$show_date = get_sub_field('post_listing_show_date');
$show_author = get_sub_field('post_listing_show_author');
$read_more_text = get_sub_field('post_listing_read_more_text') ?: 'Read More';

$module_attrs = function_exists('get_module_attributes') ? get_module_attributes($settings) : '';
$module_styles = function_exists('get_module_styles') ? get_module_styles($settings) : '';

// Query posts
$args = [
  'post_type' => $post_type,
  'posts_per_page' => $posts_per_page,
  'post_status' => 'publish',
  'orderby' => 'date',
  'order' => 'DESC'
];
$query = new WP_Query($args);

if (!$query->have_posts()) return;

$unique_id = 'post-listing-' . uniqid();
?>

<section class="post-listing-module layout-<?php echo esc_attr($layout); ?>" <?php echo $module_attrs; ?> style="<?php echo $module_styles; ?>">
  <?php
  if (function_exists('render_background_video')) render_background_video($settings);
  if (function_exists('render_background_overlay')) render_background_overlay($settings);
  ?>
  
  <div class="container">
    <?php if ($title): ?>
      <h2 class="post-listing-title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>
    
    <?php if ($layout === 'grid'): ?>
      <div class="post-grid columns-<?php echo esc_attr($columns); ?>">
        <?php while ($query->have_posts()): $query->the_post(); ?>
          <article class="post-card">
            <?php if ($show_featured_image && has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                <?php the_post_thumbnail('medium_large'); ?>
              </a>
            <?php endif; ?>
            
            <div class="post-content">
              <h3 class="post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>
              
              <?php if ($show_date || $show_author): ?>
                <div class="post-meta">
                  <?php if ($show_date): ?>
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                  <?php endif; ?>
                  <?php if ($show_author): ?>
                    <span class="post-author">by <?php the_author(); ?></span>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              
              <?php if ($show_excerpt): ?>
                <div class="post-excerpt"><?php the_excerpt(); ?></div>
              <?php endif; ?>
              
              <a href="<?php the_permalink(); ?>" class="post-read-more"><?php echo esc_html($read_more_text); ?></a>
            </div>
          </article>
        <?php endwhile; ?>
      </div>
    
    <?php else: // Slider layout ?>
      <div class="post-slider-wrapper">
        <div class="swiper post-slider" id="<?php echo esc_attr($unique_id); ?>">
          <div class="swiper-wrapper">
            <?php while ($query->have_posts()): $query->the_post(); ?>
              <div class="swiper-slide">
                <article class="post-card">
                  <?php if ($show_featured_image && has_post_thumbnail()): ?>
                    <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                      <?php the_post_thumbnail('medium_large'); ?>
                    </a>
                  <?php endif; ?>
                  
                  <div class="post-content">
                    <h3 class="post-title">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <?php if ($show_date || $show_author): ?>
                      <div class="post-meta">
                        <?php if ($show_date): ?>
                          <span class="post-date"><?php echo get_the_date(); ?></span>
                        <?php endif; ?>
                        <?php if ($show_author): ?>
                          <span class="post-author">by <?php the_author(); ?></span>
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>
                    
                    <?php if ($show_excerpt): ?>
                      <div class="post-excerpt"><?php the_excerpt(); ?></div>
                    <?php endif; ?>
                    
                    <a href="<?php the_permalink(); ?>" class="post-read-more"><?php echo esc_html($read_more_text); ?></a>
                  </div>
                </article>
              </div>
            <?php endwhile; ?>
          </div>
          
          <?php if (!empty($slider_options['show_arrows'])): ?>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          <?php endif; ?>
          
          <?php if (!empty($slider_options['show_dots'])): ?>
            <div class="swiper-pagination"></div>
          <?php endif; ?>
        </div>
      </div>
      
      <script>
      document.addEventListener('DOMContentLoaded', function() {
        new Swiper('#<?php echo esc_js($unique_id); ?>', {
          slidesPerView: <?php echo intval($slider_options['slides_per_view'] ?? 3); ?>,
          spaceBetween: <?php echo intval($slider_options['space_between'] ?? 30); ?>,
          loop: <?php echo !empty($slider_options['loop']) ? 'true' : 'false'; ?>,
          speed: <?php echo intval($slider_options['speed'] ?? 600); ?>,
          <?php if (!empty($slider_options['autoplay'])): ?>
          autoplay: {
            delay: <?php echo intval($slider_options['autoplay_delay'] ?? 3000); ?>,
            disableOnInteraction: false,
          },
          <?php endif; ?>
          <?php if (!empty($slider_options['show_arrows'])): ?>
          navigation: {
            nextEl: '#<?php echo esc_js($unique_id); ?> .swiper-button-next',
            prevEl: '#<?php echo esc_js($unique_id); ?> .swiper-button-prev',
          },
          <?php endif; ?>
          <?php if (!empty($slider_options['show_dots'])): ?>
          pagination: {
            el: '#<?php echo esc_js($unique_id); ?> .swiper-pagination',
            clickable: true,
          },
          <?php endif; ?>
          breakpoints: {
            320: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: <?php echo intval($slider_options['slides_per_view'] ?? 3); ?> }
          }
        });
      });
      </script>
    <?php endif; ?>
  </div>
  
  <?php wp_reset_postdata(); ?>
  <?php if (function_exists('render_module_custom_css')) render_module_custom_css($settings, 'post-listing'); ?>
</section>
