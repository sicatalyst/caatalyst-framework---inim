import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import { resolve } from 'path';

export default defineConfig({
  plugins: [tailwindcss()],
  
  build: {
    outDir: 'dist',
    manifest: true,
    emptyOutDir: true,
    
    rollupOptions: {
      input: {
        // Main app entry
        app: resolve(__dirname, 'resources/js/app.js'),
        
        // Module-specific entries
        'modules/header': resolve(__dirname, 'resources/js/modules/header.js'),
        'modules/hero': resolve(__dirname, 'resources/js/modules/hero.js'),
        'modules/logo-slider': resolve(__dirname, 'resources/js/modules/logo-slider.js'),
        'modules/about': resolve(__dirname, 'resources/js/modules/about.js'),
        'modules/clients-grid': resolve(__dirname, 'resources/js/modules/clients-grid.js'),
        'modules/sectors-slider': resolve(__dirname, 'resources/js/modules/sectors-slider.js'),
        'modules/trusted-by': resolve(__dirname, 'resources/js/modules/trusted-by.js'),
        'modules/fire-systems': resolve(__dirname, 'resources/js/modules/fire-systems.js'),
        'modules/products-slider': resolve(__dirname, 'resources/js/modules/products-slider.js'),
        'modules/logos-slider': resolve(__dirname, 'resources/js/modules/logos-slider.js'),
        'modules/footer': resolve(__dirname, 'resources/js/modules/footer.js'),
        'modules/module-settings': resolve(__dirname, 'resources/js/modules/module-settings.js'),
      },
      
      output: {
        entryFileNames: 'js/[name].[hash].js',
        chunkFileNames: 'js/[name].[hash].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.endsWith('.css')) {
            return 'css/[name].[hash][extname]';
          }
          return 'assets/[name].[hash][extname]';
        },
      },
    },
  },
  
  server: {
    host: true,
    strictPort: true,
    port: 5173,
    hmr: {
      host: 'localhost',
    },
  },
});
