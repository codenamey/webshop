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

## How it works

1. Admin configures which print areas (front/back) are available per product via the **PrintEngine — Print areas** meta box on the product edit screen.
2. Admin optionally adds images to the **Image Library** (WooCommerce → Image Library).
3. Customer visits a product page, selects imprint type (text or image) and optionally a print area.
4. On add-to-cart, the imprint data is validated and stored as a `print_config` JSON field on the cart item.
5. On checkout, the `print_config` is copied to the order line item meta as `_print_config` for downstream DTF pipeline processing.

---

## Requirements

- WordPress 6.0+
- WooCommerce 8.0+
- PHP 8.0+