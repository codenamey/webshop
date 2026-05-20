# assets/

Frontend assets for the PrintEngine WooCommerce Addon.

---

## css/customizer.css

**Loaded on:** Product pages only (`is_product()`)

Styles for the imprint widget rendered by `CustomizerField::render_field()`.

**What it styles:**
- `.printengine-customizer` — the outer widget container
- `.printengine-field-row` — label + select rows (print area)
- `.printengine-tabs` / `.printengine-tab` — tab navigation (Text / Upload / Library)
- `.printengine-panel` — tab content panels
- `.printengine-library-grid` / `.printengine-library-item` — image library grid
- `.printengine-preview` — image preview after upload or library selection
- `.printengine-error` — inline validation error messages
- `#printengine_print_text` — imprint textarea
- `.printengine-char-count` — character counter below textarea

---

## js/customizer.js

**Loaded on:** Product pages only (`is_product()`)  
**Dependencies:** jQuery  
**Localised data:** `window.PrintEngineData` (injected via `wp_localize_script`)

```js
PrintEngineData = {
  maxFileSize: 10485760,       // 10 MB in bytes
  maxTextLength: 100,          // max imprint text characters
  allowedTypes: [...],         // accepted MIME types
  i18n: { ... }                // translated error messages
}
```

**What it does:**

| Feature | Description |
|---|---|
| Form enctype | Sets `enctype="multipart/form-data"` on `form.cart` so file uploads work |
| Tab switching | Shows/hides panels and updates `#printengine_print_mode` hidden field |
| Character counter | Updates remaining character count as customer types in the textarea |
| File validation | Client-side MIME type and file size check before upload |
| File preview | Shows a preview image after a valid file is selected |
| Library selection | Highlights selected library image and sets hidden attachment ID field |
| Submit guard | Prevents add-to-cart if no imprint is configured; shows appropriate error |

**Note:** Client-side validation is for UX only. All validation is repeated server-side in `CustomizerField::validate()`.

---

## js/block-cart.js

**Loaded on:** Cart page only (`is_cart()`)  
**Dependencies:** None (vanilla JS)  
**Localised data:** `window.PrintEngineBlockData`

**What it does:**
- Uses a `MutationObserver` to watch for WooCommerce block cart line items rendering in the DOM
- For each line item, reads the `printengine` extension data from the `wc/store/cart` Redux store (populated by `BlockCartIntegration.php` via the Store API)
- Injects imprint text or image thumbnail below the product name in each cart line item
- Uses `document.createElement()` for all DOM manipulation (no string concatenation)

**Why MutationObserver:** The block cart is a React application that renders asynchronously — standard `DOMContentLoaded` is not sufficient to catch dynamically rendered elements.