# INIM Fire Intelligence - ACFE Page Builder Implementation

## Overview
This project has been converted from static HTML to a modular PHP structure with **ACF Extended (ACFE) Flexible Content Page Builder** for WordPress. This provides a drag-and-drop interface for building pages with reusable modules.

## File Structure

```
/
├── index.php                    # Main template file
├── modules/                     # Modular PHP components
│   ├── header.php              # Header with navigation
│   ├── hero.php                # Hero banner with video
│   ├── logo-slider.php         # Logo carousel
│   ├── about.php               # About section
│   ├── clients-grid.php        # Client cards grid
│   ├── sectors-slider.php      # Sectors slider with navigation
│   ├── trusted-by.php          # Trusted by logo bar
│   ├── fire-systems.php        # Fire systems CTAs
│   ├── products-slider.php     # Products carousel
│   ├── logos-slider.php        # Bottom logos slider
│   ├── footer.php              # Footer with columns
│   ├── module-settings-helper.php  # Helper functions for module settings
│   ├── module-settings.css     # Module settings styles
│   └── module-settings-gsap.js # GSAP animation handler
├── acf-json/                   # ACF JSON sync folder (12 field groups)
│   ├── group_header.json
│   ├── group_hero.json
│   ├── group_logo_slider.json
│   ├── group_about.json
│   ├── group_clients_grid.json
│   ├── group_sectors.json
│   ├── group_trusted_by.json
│   ├── group_fire_systems.json
│   ├── group_products.json
│   ├── group_logos_slider_bottom.json
│   ├── group_footer.json
│   └── group_module_settings.json  # Module settings field group
├── acf-page-builder.php        # ACFE Flexible Content field group (PHP)
├── acf-field-groups.json       # Legacy: All field groups in one file
├── acf-implementation.php      # Legacy: PHP code for functions.php
├── style.css                   # Existing styles (unchanged)
├── script.js                   # Existing JavaScript (unchanged)
└── README.md                   # This file
```

## What is ACFE Page Builder?

**ACF Extended (ACFE)** is a free plugin that enhances Advanced Custom Fields with powerful features:

- **Drag & Drop Module Reordering** - Rearrange page sections visually
- **Add/Remove Modules Dynamically** - Build custom page layouts
- **Clone/Duplicate Modules** - Quickly replicate sections
- **Collapse/Expand Modules** - Clean backend interface
- **Modal Editing** - Edit modules in a focused modal window
- **Live Preview** - See changes in real-time (with ACFE Pro)
- **JSON Auto-Sync** - Version control for field groups

## Installation Instructions

### 1. WordPress Setup
- Ensure you have WordPress installed
- Install and activate **ACF Pro** plugin
- Install and activate **ACF Extended** plugin (free): https://wordpress.org/plugins/acf-extended/

### 2. Import ACF Field Groups (Recommended Method - JSON Auto-Sync)

**Option A: JSON Auto-Sync (Best for Version Control)**

1. Create an `acf-json/` folder in your theme directory
2. Upload all 12 JSON files from the `acf-json/` folder
3. Go to WordPress Admin → Custom Fields
4. You'll see "Sync available" notices for each field group
5. Click "Sync" for each field group (or use bulk sync)

**Benefits:**
- Automatic version control
- Easy deployment across environments
- Changes tracked in Git
- Auto-sync on theme activation

**Option B: Import Single JSON File**

1. Go to WordPress Admin → Custom Fields → Tools
2. Click "Import Field Groups"
3. Upload `acf-field-groups.json`
4. Click "Import JSON"

**Option C: PHP Implementation**

1. Open `acf-page-builder.php`
2. Copy all the code
3. Paste it into your theme's `functions.php` file
4. Save the file

### 3. Install Module Files
1. Create a `modules/` folder in your theme directory
2. Upload all PHP files from the `modules/` folder
3. Upload `index.php` to your theme directory

### 4. Enqueue Styles and Scripts
Add this to your `functions.php`:

```php
function inim_enqueue_assets() {
  // Swiper CSS
  wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
  
  // Theme styles
  wp_enqueue_style('globals', get_template_directory_uri() . '/globals.css');
  wp_enqueue_style('styleguide', get_template_directory_uri() . '/styleguide.css');
  wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('module-settings', get_template_directory_uri() . '/modules/module-settings.css');
  
  // Swiper JS
  wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
  
  // GSAP for animations
  wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);
  wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap'), '3.12.2', true);
  
  // Theme scripts
  wp_enqueue_script('main-script', get_template_directory_uri() . '/script.js', array('swiper'), null, true);
  wp_enqueue_script('module-settings-gsap', get_template_directory_uri() . '/modules/module-settings-gsap.js', array('gsap', 'gsap-scrolltrigger'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'inim_enqueue_assets');
```

## Using the Page Builder

### Creating a Page
1. Create a new page in WordPress
2. You'll see a "Page Builder" field group
3. Click "Add Module" to add sections
4. Choose from 11 available modules:
   - Header
   - Hero Banner
   - Logo Slider
   - About Section
   - Clients Grid
   - Sectors Slider
   - Trusted By
   - Fire Systems
   - Products Slider
   - Logos Slider (Bottom)
   - Footer

### Managing Modules
- **Reorder:** Drag modules up/down using the handle
- **Duplicate:** Click the duplicate icon to clone a module
- **Collapse:** Click the title bar to collapse/expand
- **Edit:** Click "Edit" or the title to open the module
- **Delete:** Click the trash icon to remove a module

### Module Settings (New!)

Each module now includes a **"Module Settings"** tab with powerful customization options:

#### General Settings
- **HTML ID:** Custom ID attribute for anchor links
- **CSS Classes:** Additional classes for styling

#### Spacing Controls
- **Padding:** Top, right, bottom, left (px, rem, em, %)
- **Margin:** Top, right, bottom, left (px, rem, em, %)

#### Background Options
- **Background Color:** Solid color picker
- **Background Gradient:** Two-color gradient with angle control
- **Background Image:** Upload image with position/size/repeat controls
- **Background Video:** MP4 video with optional overlay

#### Animation Settings (GSAP ScrollTrigger)
- **Animation Type:** Fade In, Slide Up, Slide Down, Slide Left, Slide Right, Scale Up, Rotate In
- **Animation Duration:** Speed in seconds
- **Animation Delay:** Delay before animation starts
- **Animation Easing:** Easing function (power1, power2, etc.)

#### Visibility Controls
- **Hide on Desktop:** Show/hide on screens ≥1024px
- **Hide on Tablet:** Show/hide on screens 768px-1023px
- **Hide on Mobile:** Show/hide on screens <768px

#### Advanced Settings
- **Container Width:** Full width, boxed, or custom max-width
- **Z-Index:** Stacking order
- **Custom CSS:** Inline CSS for advanced styling

### Module Descriptions

#### Header (`modules/header.php`)
- Dynamic logo images
- Multi-level navigation with mega menus and flyouts
- Contact button and search icon
- Mobile menu toggle

#### Hero Banner (`modules/hero.php`)
- Background video support
- Customizable title and subtitle
- Primary and secondary CTA buttons

#### Logo Slider (`modules/logo-slider.php`)
- Swiper-powered logo carousel
- Responsive breakpoints

#### About Section (`modules/about.php`)
- Background image overlay
- Rich text description with WYSIWYG
- Icon graphics

#### Clients Grid (`modules/clients-grid.php`)
- Responsive card grid
- Image and title per card

#### Sectors Slider (`modules/sectors-slider.php`)
- Icon navigation slider
- Synced content slider
- Multiple sectors with descriptions

#### Trusted By (`modules/trusted-by.php`)
- Simple logo bar
- Gallery-based logos

#### Fire Systems (`modules/fire-systems.php`)
- Three-column CTA cards
- Icons and arrow graphics

#### Products Slider (`modules/products-slider.php`)
- Swiper carousel with navigation
- Product cards with images and descriptions

#### Logos Slider (Bottom) (`modules/logos-slider.php`)
- Bottom page logo carousel
- Auto-play enabled

#### Footer (`modules/footer.php`)
- Multi-column layout
- Address, social icons, links
- Accreditations image

## Template Usage

### In Your Theme

Create a page template (e.g., `template-page-builder.php`):

```php
<?php
/**
 * Template Name: Page Builder
 */

get_header();

if( have_rows('page_builder') ):
  while( have_rows('page_builder') ): the_row();
    get_template_part('modules/' . get_row_layout());
  endwhile;
endif;

get_footer();
?>
```

Or use the provided `index.php` as your main template.

### Implementing Module Settings in Custom Modules

To add module settings support to your modules:

```php
<?php
// Include helper functions
require_once get_template_directory() . '/modules/module-settings-helper.php';

// Get module settings
$settings = get_sub_field('module_settings');
$module_attrs = get_module_attributes($settings);
$module_styles = get_module_styles($settings);
?>

<section <?php echo $module_attrs; ?> style="<?php echo $module_styles; ?>">
  <?php render_background_video($settings); ?>
  <?php render_background_overlay($settings); ?>
  
  <!-- Your module content here -->
  
</section>
```

## Technical Notes

- All modules use `get_field()` and `get_sub_field()` to retrieve ACF data
- Images use `return_format => 'array'` for full image data
- Repeater fields power dynamic content sections
- Conditional logic controls mega menu vs flyout display
- All output is escaped with `esc_html()`, `esc_url()`, or `wp_kses_post()`
- ACFE flexible content uses `acfe_flexible_render_template` for automatic module rendering
- Module settings are applied via helper functions for consistency
- GSAP ScrollTrigger handles scroll-based animations
- Responsive visibility uses CSS media queries

## ACF JSON Auto-Sync

The `acf-json/` folder enables automatic field group synchronization:

1. **Development:** When you edit field groups in WordPress admin, ACF automatically saves JSON files to `acf-json/`
2. **Version Control:** Commit these JSON files to Git
3. **Deployment:** On other environments, ACF detects changes and shows "Sync available" notices
4. **Sync:** Click "Sync" to update field groups from JSON files

**To enable auto-save:**
```php
// In functions.php (already configured if using acf-page-builder.php)
add_filter('acf/settings/save_json', function() {
  return get_template_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function($paths) {
  $paths[] = get_template_directory() . '/acf-json';
  return $paths;
});
```

## Advantages of This Approach

✅ **Modular & Reusable** - Each module is independent and reusable
✅ **Drag & Drop** - Non-technical users can build pages visually
✅ **Version Control** - JSON files track field group changes
✅ **No Code Required** - Content editors manage everything via WordPress admin
✅ **Flexible Layouts** - Add, remove, reorder modules per page
✅ **Developer Friendly** - Clean separation of logic and presentation
✅ **Scalable** - Easy to add new modules or modify existing ones
✅ **Advanced Customization** - Module settings provide granular control without code
✅ **Animation Ready** - Built-in GSAP ScrollTrigger support
✅ **Responsive Control** - Per-module visibility settings

## Support

- **ACF Documentation:** https://www.advancedcustomfields.com/resources/
- **ACFE Documentation:** https://www.acf-extended.com/
- **Swiper Documentation:** https://swiperjs.com/
- **GSAP Documentation:** https://greensock.com/docs/

## License

This implementation follows the original project's licensing.
