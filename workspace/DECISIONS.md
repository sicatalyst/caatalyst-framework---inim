# System Decisions

*This file is the single source of truth for architectural and implementation decisions in this project.*

## Purpose

Records key technical decisions, their rationale, alternatives considered, and outcomes. This file prevents the same discussions from happening twice and helps future-you (or future-sessions) understand *why* things are the way they are.

## When to Update This File

Update this file when:
- A significant technical or architectural decision is made
- A library, framework, or tool is chosen over alternatives
- A design pattern or approach is selected for a non-trivial problem
- A previous decision is revisited, changed, or reversed
- A constraint or trade-off is discovered that shaped the implementation
- A workaround is chosen due to external limitations (API quirks, library bugs, etc.)

**Do not** log trivial decisions (variable naming, minor formatting). If it wouldn't be worth explaining to a teammate joining the project, skip it.

## Format

Each entry follows this structure:

```
### [YYYY-MM-DD] — [Short Decision Title]

**Status:** Accepted | Superseded | Deprecated
**Context:** Why this decision was needed. What problem or question triggered it.
**Decision:** What was decided.
**Alternatives Considered:**
- [Alternative A] — Why it was rejected.
- [Alternative B] — Why it was rejected.
**Consequences:** What this decision enables, constrains, or risks.
```

If this file gets corrupted, re-create it. 
CRITICAL: Keep this file under 300 lines. You are allowed to summarize, change the format, delete entries, etc., in order to keep it under the limit.

---

## Decisions

### 2026-03-02 — PHP Modular Architecture with ACF

**Status:** Accepted
**Context:** User requested conversion from static HTML to PHP with modular components and ACF integration for WordPress CMS management.
**Decision:** Split single index.html into index.php (main template) and 11 separate module files in modules/ directory. Each module uses ACF get_field() to retrieve dynamic content.
**Alternatives Considered:**
- Single PHP file with inline ACF calls — Rejected: Poor maintainability, difficult to update individual sections
- Gutenberg blocks — Rejected: User specifically requested ACF implementation
- Hardcoded PHP templates — Rejected: No content management flexibility
**Consequences:** Enables non-technical users to manage all page content via WordPress admin. Modules are independently editable. Requires ACF Pro plugin. All 11 field groups must be imported or registered via PHP.
