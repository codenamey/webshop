(function () {
    'use strict';

    var wooBlocks = window.wc && window.wc.blocksCheckout;
    if ( ! wooBlocks ) return;

    var registerPlugin   = wooBlocks.registerPlugin   || ( window.__experimentalRegisterPlugin );
    var ExperimentalCartMeta = window.__experimentalCartLineItemsMeta;

    // WooCommerce Blocks exposes an "extensions" field on each cart item
    // via the Store API. We read printengine.mode / print_text / image_url
    // and render it beneath the product name.
    if ( window.wc && window.wc.blocksRegistry ) {
        window.wc.blocksRegistry.registerCheckoutBlock &&
        window.wc.blocksRegistry.registerCheckoutBlock( {
            metadata: { name: 'printengine/cart-item-meta' },
            component: function () { return null; },
        } );
    }

    // The reliable cross-version approach: filter cart item class names
    // and inject a DOM node after WooCommerce renders each line item.
    var observer = new MutationObserver( function () {
        document
            .querySelectorAll( '.wc-block-cart-item__product:not([data-pe-rendered])' )
            .forEach( function ( row ) {
                row.setAttribute( 'data-pe-rendered', '1' );

                // Find the product name link to locate the right cart item.
                var nameEl = row.querySelector( '.wc-block-cart-item__product-name' );
                if ( ! nameEl ) return;

                // WooCommerce stores line-item data in a sibling <input> or
                // as data attributes on the row. Try the closest [data-cart-item-key].
                var keyEl = row.closest( '[data-cart-item-key]' );
                var key   = keyEl ? keyEl.getAttribute( 'data-cart-item-key' ) : null;
                if ( ! key ) return;

                // Pull the extension data from the WC store.
                var storeData = getCartItemExtension( key );
                if ( ! storeData ) return;

                renderMeta( row, storeData );
            } );
    } );

    observer.observe( document.body, { childList: true, subtree: true } );

    function getCartItemExtension( key ) {
        try {
            var store  = window.wp && window.wp.data && window.wp.data.select( 'wc/store/cart' );
            if ( ! store ) return null;
            var items  = store.getCartItems ? store.getCartItems() : [];
            var item   = items.find( function ( i ) { return i.key === key; } );
            return item && item.extensions && item.extensions.printengine
                ? item.extensions.printengine
                : null;
        } catch ( e ) {
            return null;
        }
    }

    function renderMeta( row, data ) {
        if ( ! data.mode ) return;

        var existing = row.querySelector( '.pe-cart-meta' );
        if ( existing ) return;

        var el   = document.createElement( 'div' );
        el.className = 'pe-cart-meta';
        el.style.cssText = 'font-size:0.85em;color:#555;margin-top:4px;';

        if ( data.mode === 'text' && data.print_text ) {
            var label  = document.createElement( 'strong' );
            label.textContent = ( window.PrintEngineBlockData && window.PrintEngineBlockData.i18n.printText )
                || 'Painatusteksti';
            label.textContent += ': ';
            var value  = document.createTextNode( data.print_text );
            el.appendChild( label );
            el.appendChild( value );
        } else if ( data.mode !== 'text' && data.image_url ) {
            var img    = document.createElement( 'img' );
            img.src    = data.image_url;
            img.alt    = ( window.PrintEngineBlockData && window.PrintEngineBlockData.i18n.printImage ) || 'Painatuskuva';
            img.style.cssText = 'max-height:48px;max-width:80px;display:block;margin-top:4px;border-radius:3px;border:1px solid #ddd;';
            el.appendChild( img );
        } else {
            return;
        }

        var metaEl = row.querySelector( '.wc-block-cart-item__product-metadata' );
        if ( metaEl ) {
            metaEl.appendChild( el );
        } else {
            nameEl && nameEl.insertAdjacentElement( 'afterend', el );
        }
    }
}());