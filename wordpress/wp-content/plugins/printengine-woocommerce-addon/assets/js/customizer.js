(function ($) {
    'use strict';

    var data    = window.PrintEngineData || {};
    var i18n    = data.i18n || {};
    var maxSize = data.maxFileSize || 10 * 1024 * 1024;
    var allowed = data.allowedTypes || ['image/jpeg', 'image/png', 'image/svg+xml'];
    var maxText = data.maxTextLength || 20;

    // Ensure the add-to-cart form supports file uploads.
    $(function () {
        $('form.cart').attr('enctype', 'multipart/form-data');
    });

    function showError($el, msg) {
        $el.text(msg).removeAttr('hidden');
    }

    function clearError($el) {
        $el.text('').attr('hidden', true);
    }

    function setPreview($container, src, alt) {
        var img = document.createElement('img');
        img.src = src;
        img.alt = alt || '';
        $container.empty().append(img).removeAttr('hidden');
    }

    function clearPreview($container) {
        $container.empty().attr('hidden', true);
    }

    $(document).on('click', '.printengine-tab', function () {
        var tab = $(this).data('tab');
        $('.printengine-tab').removeClass('printengine-tab--active').attr('aria-selected', 'false');
        $(this).addClass('printengine-tab--active').attr('aria-selected', 'true');
        $('.printengine-panel').attr('hidden', true);
        $('#printengine-panel-' + tab).removeAttr('hidden');
        $('#printengine_print_mode').val(tab === 'text' ? 'text' : 'image');
        $('#printengine_image_source').val('');
        $('#printengine_library_attachment_id').val('');
        clearPreview($('#printengine-upload-preview'));
        clearPreview($('#printengine-library-preview'));
        $('#printengine_upload').val('');
        $('.printengine-library-item').attr('aria-selected', 'false');
    });

    $(document).on('input', '#printengine_print_text', function () {
        var remaining = maxText - $(this).val().length;
        $('#printengine-text-remaining').text(Math.max(0, remaining));
        if (remaining < 0) {
            showError($('#printengine-text-error'), i18n.textTooLong || 'Teksti on liian pitkä.');
        } else {
            clearError($('#printengine-text-error'));
        }
    });

    $(document).on('change', '#printengine_upload', function () {
        var $error   = $('#printengine-upload-error');
        var $preview = $('#printengine-upload-preview');
        var file     = this.files && this.files[0];
        clearError($error);
        clearPreview($preview);
        $('#printengine_image_source').val('');
        if (!file) return;
        if (allowed.indexOf(file.type) === -1) {
            showError($error, i18n.invalidType || 'Sallitut tiedostomuodot: JPG, PNG, SVG.');
            $(this).val('');
            return;
        }
        if (file.size > maxSize) {
            showError($error, i18n.fileTooLarge || 'Tiedosto on liian suuri (max 10 Mt).');
            $(this).val('');
            return;
        }
        var reader = new FileReader();
        reader.onload = function (e) {
            setPreview($preview, e.target.result, file.name);
        };
        reader.readAsDataURL(file);
        $('#printengine_image_source').val('upload');
        $('#printengine_library_attachment_id').val('');
    });

    $(document).on('click', '.printengine-library-item', function () {
        var $btn     = $(this);
        var url      = $btn.data('url');
        var id       = $btn.data('id');
        var $preview = $('#printengine-library-preview');
        $('.printengine-library-item').attr('aria-selected', 'false');
        $btn.attr('aria-selected', 'true');
        setPreview($preview, url, $btn.find('img').attr('alt') || '');
        $('#printengine_image_source').val('library');
        $('#printengine_library_attachment_id').val(id);
        $('#printengine_upload').val('');
        clearPreview($('#printengine-upload-preview'));
    });

    $(document).on('click', '.single_add_to_cart_button', function (e) {
        var mode = $('#printengine_print_mode').val();
        if (mode === 'text') {
            var text = $('#printengine_print_text').val().trim();
            if (!text) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var msgText = i18n.requiredText || 'Kirjoita painatusteksti.';
                if (typeof wc_add_notice === 'function') {
                    wc_add_notice(msgText, 'error');
                } else {
                    alert(msgText);
                }
            }
            return;
        }
        var source = $('#printengine_image_source').val();
        if (!source) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var msgImg = i18n.requiredImage || 'Valitse tai lataa painatuskuva.';
            if (typeof wc_add_notice === 'function') {
                wc_add_notice(msgImg, 'error');
            } else {
                alert(msgImg);
            }
        }
    });

}(jQuery));