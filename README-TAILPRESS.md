# INIM Fire Intelligence - TailPress Child Theme

A lightweight, modular WordPress child theme built on TailPress with Vite for blazing-fast asset compilation and dynamic module loading.

## 🚀 Features

- **TailPress Child Theme** - Built on TailPress with Tailwind CSS 4.0
- **Vite Build System** - Lightning-fast HMR and optimized production builds
- **Modular Architecture** - CSS and JS split by module for optimal performance
- **Dynamic Asset Loading** - Only loads CSS/JS for modules actually used on the page
- **Self-Hosted Dependencies** - Swiper and GSAP installed via NPM (no CDN dependencies)
- **ACF Integration** - Full ACF Extended page builder support
- **Module Settings** - Advanced per-module customization (spacing, backgrounds, animations, visibility)

## 📦 Installation

### Prerequisites

- WordPress 6.0+
- Node.js 18+ and npm
- TailPress parent theme installed
- ACF Pro plugin
- ACF Extended plugin

### Setup Steps

1. **Install the theme:**
   ```bash
   # Place this theme in wp-content/themes/
   cd wp-content/themes/inim-fire-intelligence
   ```

2. **Install dependencies:**
   ```bash
   npm install
   ```

3. **Development mode (with HMR):**
   ```bash
   npm run dev
   ```
   - Vite dev server runs on `http://localhost:5173`
   - Hot Module Replacement works in real-time
   - Set `WP_DEBUG` to `true` in `wp-config.php` to enable dev mode

4. **Production build:**
   ```bash
   npm run build
   ```
   - Compiles and minifies all assets to `dist/` folder
   - Generates manifest for asset versioning
   - Optimizes CSS and JS with tree-shaking

5. **Activate the theme:**
   - Go to WordPress Admin → Appearance → Themes
   - Activate "INIM Fire Intelligence"

6. **Import ACF field groups:**
   - The `acf-json/` folder contains all field groups
   - Go to Custom Fields → Sync available field groups

## 🏗️ Project Structure

```
inim-fire-intelligence/
├── resources/                  # Source files (compiled by Vite)
│   ├── css/
│   │   ├── app.css            # Main CSS entry (imports all modules)
│   │   └── modules/           # Module-specific CSS
│   │       ├── header.css
│   │       ├── hero.css
│   │       ├── logo-slider.css
│   │       ├── about.css
│   │       ├── clients-grid.css
│   │       ├── sectors-slider.css
│   │       ├── trusted-by.css
│   │       ├── fire-systems.css
│   │       ├── products-slider.css
│   │       ├── logos-slider.css
│   │       ├── footer.css
│   │       └── module-settings.css
│   └── js/
│       ├── app.js             # Main JS entry (loads Swiper, GSAP)
│       └── modules/           # Module-specific JS
│           ├── header.js
│           ├── hero.js
│           ├── logo-slider.js
│           ├── about.js
│           ├── clients-grid.js
│           ├── sectors-slider.js
│           ├── trusted-by.js
│           ├── fire-systems.js
│           ├── products-slider.js
│           ├── logos-slider.js
│           ├── footer.js
│           └── module-settings.js
├── dist/                      # Compiled assets (production)
│   ├── css/
│   ├── js/
│   └── .vite/
│       └── manifest.json      # Asset manifest for cache busting
├── modules/                   # PHP module templates
│   ├── header.php
│   ├── hero.php
│   ├── logo-slider.php
│   ├── about.php
│   ├── clients-grid.php
│   ├── sectors-slider.php
│   ├── trusted-by.php
│   ├── fire-systems.php
│   ├── products-slider.php
│   ├── logos-slider.php
│   ├── footer.php
│   └── module-settings-helper.php
├── acf-json/                  # ACF field groups (auto-sync)
├── functions.php              # Theme setup and dynamic asset loading
├── index.php                  # Main template
├── style.css                  # Theme header (child theme info)
├── package.json               # NPM dependencies
├── vite.config.mjs            # Vite configuration
├── tailwind.config.js         # Tailwind configuration
└── README-TAILPRESS.md        # This file
```

## ⚡ How Dynamic Asset Loading Works

The theme uses a smart asset loading system that only enqueues CSS/JS for modules actually used on the page:

1. **Module Registration:**
   - Each module PHP file calls `inim_register_module('module-name')` at the top
   - This tracks which modules are used on the current page

2. **Asset Enqueuing:**
   - In `wp_footer`, the theme checks which modules were registered
   - Only those module-specific JS files are enqueued
   - CSS is bundled into `app.css` but uses tree-shaking in production

3. **Development vs Production:**
   - **Dev mode** (`npm run dev`): Assets loaded from Vite dev server with HMR
   - **Production** (`npm run build`): Assets loaded from `dist/` with versioned filenames

## 🎨 Tailwind CSS Integration

The theme uses Tailwind CSS 4.0 with custom configuration:

- **Custom colors:** `inim-blue`, `inim-blue-dark`, `inim-blue-light`, `inim-red`, `inim-black`
- **Custom fonts:** `font-kumbh`, `font-arial`
- **Content paths:** Scans all PHP files and resources for Tailwind classes

You can use Tailwind utilities in your PHP templates:

```php
<div class="bg-inim-blue text-white p-8 rounded-lg">
  <h2 class="font-kumbh text-2xl font-bold">Hello World</h2>
</div>
```

## 📦 Dependencies

### Production Dependencies
- **Swiper 11.1.15** - Modern touch slider
- **GSAP 3.12.5** - Animation library with ScrollTrigger

### Dev Dependencies
- **Vite 6.0.3** - Build tool
- **Tailwind CSS 4.0** - Utility-first CSS framework
- **PostCSS & Autoprefixer** - CSS processing

All dependencies are self-hosted (no CDN links).

## 🔧 Customization

### Adding a New Module

1. **Create PHP template:**
   ```php
   // modules/my-module.php
   <?php
   inim_register_module('my-module'); // Register for asset loading
   
   $title = get_sub_field('title');
   ?>
   <section class="my-module">
     <h2><?php echo esc_html($title); ?></h2>
   </section>
   ```

2. **Create CSS file:**
   ```css
   /* resources/css/modules/my-module.css */
   .my-module {
     padding: 4rem 2rem;
     background: var(--inim-blue);
   }
   ```

3. **Create JS file:**
   ```javascript
   // resources/js/modules/my-module.js
   document.addEventListener('DOMContentLoaded', () => {
     console.log('My module loaded');
   });
   ```

4. **Import CSS in app.css:**
   ```css
   @import "./modules/my-module.css";
   ```

5. **Add to Vite config:**
   ```javascript
   // vite.config.mjs
   input: {
     'modules/my-module': resolve(__dirname, 'resources/js/modules/my-module.js'),
   }
   ```

6. **Rebuild:**
   ```bash
   npm run build
   ```

### Modifying Tailwind Config

Edit `tailwind.config.js` to add custom colors, fonts, or utilities:

```javascript
theme: {
  extend: {
    colors: {
      'my-color': '#123456',
    },
  },
}
```

## 🐛 Troubleshooting

### Assets not loading in dev mode
- Ensure `npm run dev` is running
- Check that `WP_DEBUG` is `true` in `wp-config.php`
- Verify Vite dev server is accessible at `http://localhost:5173`

### Assets not loading in production
- Run `npm run build` to compile assets
- Check that `dist/` folder exists and contains files
- Clear WordPress cache and browser cache

### Module JS not loading
- Ensure `inim_register_module('module-name')` is called in the PHP template
- Check that the module name matches the JS filename
- Verify the module is added to `vite.config.mjs` input

### Tailwind classes not working
- Run `npm run build` to regenerate CSS
- Check that your PHP files are in the `content` array in `tailwind.config.js`
- Ensure classes are not dynamically generated (Tailwind needs to see full class names)

## 📝 License

This theme follows the original project's licensing.

## 🤝 Support

For issues or questions, refer to:
- [TailPress Documentation](https://tailpress.io)
- [Vite Documentation](https://vitejs.dev)
- [Tailwind CSS Documentation](https://tailwindcss.com)
- [ACF Documentation](https://www.advancedcustomfields.com)
