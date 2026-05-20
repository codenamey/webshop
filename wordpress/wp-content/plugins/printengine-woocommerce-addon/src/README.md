# src/

Core PHP classes for the PrintEngine WooCommerce Addon.

---

## Plugin.php

**Role:** Singleton core class. Entry point after WooCommerce dependency check.

**What it does:**
- Instantiated once via `Plugin::init()` on the `plugins_loaded` action
- Loads all module files via `require_once`
- Calls `register()` on each module to attach WordPress/WooCommerce hooks
- Loads the plugin text domain for translations

**Key method:** `bootstrap()` — loads and registers all sub-modules in dependency order.

---

## PrintConfig.php

**Role:** Value object representing a customer's complete print configuration.

**What it does:**
- Encapsulates all print data: `image`, `size`, `color`, `print_area`, `meta`, and internal fields (`mode`, `text`, `image_source`, `attachment_id`)
- Provides factory methods to build a PrintConfig from different sources:
  - `from_post()` — reads `$_POST` on add-to-cart; resolves `size`/`color` from the selected WooCommerce variation automatically, resolves `print_area` from product admin settings
  - `from_json()` — deserialises from a stored JSON string (cart/order meta)
  - `from_cart_item()` — convenience wrapper around `from_json()` for cart items
- `to_json()` / `to_array()` — serialises to the canonical JSON structure for storage
- `errors()` — returns a list of validation error strings; empty if valid
- `is_valid()` — returns true if there are no validation errors

**Storage format (JSON):**
```json
{
  "image": "42",
  "size": "m",
  "color": "black",
  "print_area": "front",
  "meta": {},
  "_mode": "text",
  "_text": "Hello World",
  "_image_source": "",
  "_attachment_id": 0
}
```

Fields prefixed with `_` are internal and not part of the public spec.