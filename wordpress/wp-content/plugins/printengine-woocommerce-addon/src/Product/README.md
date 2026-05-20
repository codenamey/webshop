# src/Product/

WooCommerce product-level modules. Each class is responsible for one area of functionality and registers its own WordPress/WooCommerce hooks via a static `register()` method.

---

## CustomizerField.php

**Role:** The main imprint widget — renders the customer-facing form on the product page and persists the data through cart → order.

**Hooks registered:**
| Hook | Method | Purpose |
|---|---|---|
| `woocommerce_before_add_to_cart_button` | `render_field()` | Renders the imprint widget on the product page |
| `wp_enqueue_scripts` | `enqueue_assets()` | Loads CSS and JS on product pages |
| `wp_enqueue_scripts` | `enqueue_block_cart_assets()` | Loads block cart script on the cart page |
| `woocommerce_product_supports` | `disable_ajax_add_to_cart()` | Forces standard form POST (required for file upload) |
| `woocommerce_add_to_cart_validation` | `validate()` | Validates imprint data before adding to cart |
| `woocommerce_add_cart_item_data` | `save_to_cart()` | Saves `print_config` JSON to the cart item |
| `woocommerce_get_item_data` | `display_in_cart()` | Shows imprint details in the cart |
| `woocommerce_checkout_create_order_line_item` | `save_to_order()` | Copies `_print_config` to the order line item |
| `woocommerce_after_order_itemmeta` | `display_in_admin_order()` | Shows imprint details in the admin order view |
| `woocommerce_order_item_display_meta_value` | `display_meta_value()` | Renders attachment thumbnails in order emails |
| `woocommerce_add_to_cart_redirect` | `stay_on_product_page()` | Keeps customer on the product page after add-to-cart |

**What `render_field()` renders:**
- Print area selector (only shown if the product has both front and back configured)
- Tab switcher: Text / Upload image / Choose from library
- Text panel: textarea with character counter
- Upload panel: file input (JPG, PNG, SVG, max 10 MB)
- Library panel: grid of admin-curated images (if any exist)

**Validation (`validate()`):**
- Verifies WooCommerce nonce if present
- For image uploads: checks MIME type and sanitises SVG content (rejects `<script>`, event handlers, `javascript:` URIs)
- For library selections: verifies attachment ID is in the approved library
- Delegates text/config validation to `PrintConfig::errors()`

**Data flow:**
```
$_POST → PrintConfig::from_post() → print_config JSON → cart item
cart item → PrintConfig::from_cart_item() → order line item meta (_print_config)
```

---

## ImageLibrary.php

**Role:** Manages the admin-curated image library that customers can choose from on the product page.

**What it does:**
- Adds a **WooCommerce → Image Library** submenu page in the admin
- Admin can add images from the WordPress media library and remove them
- Images are stored as an array of attachment IDs in the `printengine_image_library` WordPress option
- `get_library()` returns the current list of attachment IDs for use in `CustomizerField`

**Security:**
- `manage_woocommerce` capability required to view and save
- `check_admin_referer()` on save
- All attachment IDs sanitised with `absint()`
- Admin JS uses `createElement()` instead of string concatenation to avoid XSS

---

## PrintAreaSettings.php

**Role:** Manages which print areas (front/back) are available for each product.

**What it does:**
- Adds a **PrintEngine — Print areas** meta box to the product edit screen (sidebar)
- Admin checks front, back, or both for each product
- Settings saved as `_printengine_print_areas` post meta (array of strings)
- `get_areas( $product_id )` returns the allowed areas; defaults to `['front']` if not configured

**How it's used:**
- `CustomizerField::render_field()` calls `get_areas()` to decide whether to show a print area selector or use a hidden field
- `PrintConfig::from_post()` calls `get_areas()` to resolve and validate the submitted print area

**Security:**
- `wp_nonce_field()` / `wp_verify_nonce()` on save
- `current_user_can( 'edit_post' )` check
- Values validated against `VALID_AREAS` whitelist before saving

---

## BlockCartIntegration.php

**Role:** Exposes PrintEngine data to the WooCommerce Block Cart via the Store API.

**What it does:**
- Registers an endpoint data extension on `woocommerce_blocks_loaded` using `StoreApi::register_endpoint_data()`
- Adds a `printengine` namespace to each cart item in the Store API response containing `mode`, `print_text`, and `image_url`
- `block-cart.js` reads this data from the `wc/store/cart` Redux store and renders it under each line item in the block cart

**Note:** Only active when WooCommerce Blocks (`Automattic\WooCommerce\StoreApi\StoreApi`) is available.