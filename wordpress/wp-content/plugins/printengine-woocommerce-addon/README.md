# PrintEngine WooCommerce Addon

A WooCommerce plugin that adds custom print configuration (imprint) functionality to products. Customers can add imprint text or upload/select an image before adding a product to the cart.

---

## Directory structure

```
printengine-woocommerce-addon/
├── printengine-woocommerce-addon.php   Main plugin file — bootstraps the plugin
├── assets/
│   ├── css/
│   │   └── customizer.css             Styles for the imprint widget on the product page
│   └── js/
│       ├── customizer.js              Frontend logic for the imprint widget
│       └── block-cart.js              Renders imprint data in the WooCommerce block cart
└── src/
    ├── Plugin.php                     Core plugin class — loads all modules
    ├── PrintConfig.php                Value object for print configuration data
    └── Product/
        ├── CustomizerField.php        Imprint widget — product page, cart, and order
        ├── ImageLibrary.php           Admin image library management
        ├── PrintAreaSettings.php      Per-product print area settings (admin meta box)
        └── BlockCartIntegration.php   WooCommerce Store API integration for block cart
```

---

## Activation hook

Runs automatically when the plugin is activated:

- Blocks activation if PHP < 8.0
- Saves plugin version to `printengine_wc_addon_version` option
- Initialises empty `printengine_image_library` option
- Creates WooCommerce attributes `pa_size` (S/M/L/XL/XXL) and `pa_color` (Black/White/Gray) if they don't exist

After activation, verify under **WooCommerce → Attributes** that both attributes appear.

---

## How it works
### Cart → Order dataflow

1. PRODUCT PAGE <br>
   Customer selects: variation (size + color) + imprint (text or image) + print area
   └── PrintConfig::from_post() builds a validated config object

2. ADD TO CART  [woocommerce_add_cart_item_data] <br>
   └── PrintConfig JSON stored as cart item key: printengine_print_config

3. CART PAGE <br>
   └── woocommerce_get_item_data renders size / color / print area / imprint

4. CHECKOUT  [woocommerce_checkout_create_order_line_item] <br>
   └── PrintConfig JSON copied to order line item meta (see keys below)

5. ORDER (admin) <br>
   └── display_in_admin_order() renders a summary block: size, color, SKU,
       print area, imprint text or image with download link

6. DTF PIPELINE <br>
   └── Read _printengine_print_config (full JSON) or individual keys below

#### Order line item meta keys
| Key | Type | Description |
|---|---|---|
| `_printengine_print_config` | JSON | Full PrintConfig — single source of truth |
| `_printengine_size` | string | Clothing size slug, e.g. `l` |
| `_printengine_color` | string | Color slug, e.g. `black` |
| `_printengine_variation_sku` | string | SKU of selected variation, e.g. `TSHIRT-BLACK-L` |
| `_printengine_print_area` | string | `front` or `back` |
| `_printengine_mode` | string | `text` or `image` |
| `_printengine_print_text` | string | Imprint text (text mode only) |
| `_printengine_image_id` | int | WP attachment ID (image mode only) |
| `_printengine_image_url` | string | Direct file URL for DTF download (image mode only) |
| `_printengine_image_source` | string | `upload` or `library` (image mode only) |
---

## Requirements

- WordPress 6.0+
- WooCommerce 8.0+
- PHP 8.0+

---

## Product & SKU conventions

Products with custom imprinting use **WooCommerce variable products** with two attributes: `pa_size` (S/M/L/XL/XXL) and `pa_color` (Black/White/Gray). One product listing per garment type — no separate product per size/colour combination.

SKU format: `{PRODUCT}-{COLOR}-{SIZE}` — e.g. `TSHIRT-BLACK-L`, `TSHIRT-WHITE-M`.

Size and colour are read automatically from the selected variation when the customer adds to cart — no duplicate input fields shown.
