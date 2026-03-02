<instructions>
## 🚨 MANDATORY: CHANGELOG TRACKING 🚨

You MUST maintain this file to track your work across messages. This is NON-NEGOTIABLE.

---

## INSTRUCTIONS

- **MAX 5 lines** per entry - be concise but informative
- **Include file paths** of key files modified or discovered
- **Note patterns/conventions** found in the codebase
- **Sort entries by date** in DESCENDING order (most recent first)
- If this file gets corrupted, messy, or unsorted -> re-create it. 
- CRITICAL: Updating this file at the END of EVERY response is MANDATORY.
- CRITICAL: Keep this file under 300 lines. You are allowed to summarize, change the format, delete entries, etc., in order to keep it under the limit.

</instructions>

<changelog>
### 2026-03-02 — ACF Field Group Hiding Filter Added
- Applied write_to_file to functions.php after replace_in_file failed
- Added hide_acf_groups_from_post_editor filter to prevent field groups from showing in post editor
- All 16 module field groups now hidden from direct post editing (only accessible via page builder)

### 2026-03-02 — Footer Module Theme Settings Integration Fixed
- Applied write_to_file to modules/footer.php after replace_in_file failed
- Footer now falls back to theme settings for logo, tagline, contact info, and social links
- Uses inim_get_setting(), inim_get_contact_info(), and inim_render_social_icons()

### 2026-03-02 — Confirmed Task Completion Status
- Verified README.md module settings documentation task completed successfully
- No active issues logged in DEBUGGING.md; all recent tasks resolved

### 2026-03-02 — README Updated with Module Settings Documentation
- Updated README.md to include module settings features and implementation guide
- Documented 12 field groups (added group_module_settings.json)
- Added enqueue instructions for module-settings.css and GSAP scripts
- Included code examples for implementing module settings in custom modules

### 2026-03-02 — ACF JSON Split for Auto-Sync
- Split acf-field-groups.json into 11 individual files in acf-json/ folder
- Each field group now has its own JSON file (group_header.json, group_hero.json, etc.)
- Enables ACF Extended Pro auto-sync functionality for version control and deployment

### 2026-03-02 — PHP Conversion with ACF Integration
- Converted static HTML (index.html) to modular PHP structure with 11 separate module files
- Created comprehensive ACF field groups for all modules (header, hero, about, sectors, products, footer, etc.)
- Generated acf-field-groups.json (importable) and acf-implementation.php (PHP code for functions.php)
- All modules use get_field() with proper escaping (esc_html, esc_url, wp_kses_post)
- Maintained original CSS/JS files unchanged; modules reference existing Swiper sliders
</changelog>
