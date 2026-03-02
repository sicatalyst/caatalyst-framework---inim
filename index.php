<?php
/**
 * Template Name: INIM Homepage
 */

get_header(); ?>

<div class="inim-visual-design">
  
  <?php
  // Page Builder - Flexible Content
  if( have_rows('page_builder') ):
    while( have_rows('page_builder') ): the_row();
      
      $layout = get_row_layout();
      
      // Map layout names to module files
      $module_map = array(
        'header' => 'header',
        'hero' => 'hero',
        'logo_slider' => 'logo-slider',
        'about' => 'about',
        'clients_grid' => 'clients-grid',
        'sectors_slider' => 'sectors-slider',
        'trusted_by' => 'trusted-by',
        'fire_systems' => 'fire-systems',
        'products_slider' => 'products-slider',
        'logos_slider_bottom' => 'logos-slider',
        'footer' => 'footer',
      );
      
      // Load the corresponding module
      if( isset($module_map[$layout]) ) {
        get_template_part('modules/' . $module_map[$layout]);
      }
      
    endwhile;
  endif;
  ?>
  
</div>

<?php get_footer(); ?>
