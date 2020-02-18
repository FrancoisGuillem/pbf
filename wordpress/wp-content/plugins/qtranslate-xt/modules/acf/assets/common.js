jQuery(function ($) {

    var $body = $('body');

    /**
     * Sync qtranslate language switchers with qtranslatex language switchers.
     */
    var onLanguageSwitch = function (language) {
        var parent = $('.multi-language-field');
        parent.find('.current-language').removeClass('current-language');
        parent.find('[data-language="' + language + '"]').addClass('current-language');
        parent.find('input[data-language="' + language + '"], textarea[data-language="' + language + '"]');
    };
    $body.on('click', '.qtranxs-lang-switch', function () {
        var language = $(this).attr('lang');
        onLanguageSwitch(language);
    });

    /**
     * Setup qtranslate language switchers.
     */
    $body.on('click', '.wp-switch-editor[data-language]', function () {
        var parent = $(this).parent('.multi-language-field'), language = $(this).data('language');
        parent.find('.current-language').removeClass('current-language');
        parent.find('[data-language="' + language + '"]').addClass('current-language');
        parent.find('input[data-language="' + language + '"], textarea[data-language="' + language + '"]').focus();
        // TODO shouldn't we use qtx.switchActiveLanguage instead?
        $('.qtranxs-lang-switch[lang="' + language + '"]:first').trigger('click');
    });

    /**
     * Focus/blur fields.
     */
    $body.on('focusin', '.multi-language-field input, .multi-language-field textarea', function () {
        $(this).parent('.multi-language-field').addClass('focused');
    });

    $body.on('focusout', '.multi-language-field input, .multi-language-field textarea', function () {
        $(this).parent('.multi-language-field').removeClass('focused');
    });

    /**
     * Keep the selected editor in sync across languages.
     */
    $body.on('click', '.wp-editor-tabs .wp-switch-editor', function () {
        var parent = $(this).parents('.multi-language-field'),
            editor = $(this).hasClass('switch-tmce') ? 'tmce' : 'html';
        parent.find('.wp-editor-tabs .wp-switch-editor.switch-' + editor).not(this).each(function () {
            var id = $(this).attr('data-wp-editor-id');
            if (id) { // WP 4.3
                window.switchEditors.go(id, editor);
            } else { // WP < 4.3
                switchEditors.switchto(this);
            }
        });
    });

    $(function() {
        // TODO qTranslateConfig should not be accessed here in common.js (temporary fix for LSB edit selection)
        if (!qTranslateConfig.LSB)
            return;
        // select the edit tab from active language
        var language = qTranslateConfig.qtx.getActiveLanguage();
        if (language) {
            // show the correct ACF fields
            onLanguageSwitch(language);
            // sync the switch editors
            var $mlFields = $('.multi-language-field');
            $mlFields.find('.current-language').removeClass('current-language');
            $mlFields.find('[data-language="' + language + '"]').addClass('current-language');
        }
    });

});
