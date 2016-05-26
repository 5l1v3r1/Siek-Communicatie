$(function() {

    /**
     * All possible syntax for the editor
     * @var object
     */
    var syntax = {
        "bold"      : ["((", "))"],
        "italic"    : ["{{", "}}"],
        "underline" : ["[[", "]]"],
        "paragraph" : ["#[", "]#"],
        "list"      : "•\t"
    };
    var html = {

        /* Bold, italic, underline */
        "{{" : "<i>",
        "}}" : "</i>",
        "((" : "<b>",
        "))" : "</b>",
        "[[" : "<u>",
        "]]" : "</u>",

        /* Headings */
        "#[" : "<h2>",
        "]#" : "</h2>"
    };

    /**
     * substr_replace equivalent
     * @param str
     * @param replace
     * @param start
     * @param length
     * @returns {string}
     */
    function substr_replace(str, replace, start, length) {
        if (start < 0) { // start position in str
            start = start + str.length;
        }
        length = length !== undefined ? length : str.length;
        if (length < 0) {
            length = length + str.length - start;
        }

        return str.slice(0, start) + replace.substr(0, length) + replace.slice(length) + str.slice(start + length);
    }

    /**
     * Preview the text
     * @param $editor
     * @return void
     */
    function previewText($editor) {

        // Fetch the text, then escape it.
        var bullet = "•\t";
        var title  = $editor.parent().prev().find("input").val();
        var text   = $editor.val();
            text   = $('<div/>').text(text).html();

            // Fixes a bug with the bullet points
            text += "<br />";

        // Replace all newlines with breaks
        while (text.indexOf("\n") != -1) {
            text = text.replace("\n", "<br />");
        }

        // Loop through the syntax and apply styles
        for (character in html) {
            if (html.hasOwnProperty(character)) {
                while (text.indexOf(character) != -1) {
                    text = text.replace(character, html[character]);
                }
            }
        }

        // Add bullet points
        while (text.indexOf(bullet) != -1) {
            var start = text.indexOf(bullet);
            var end   = text.substring(start).indexOf("<br />");
            var item  = text.substr(start, end).replace(bullet, '<span class="li">') + '</span>';
            text      = substr_replace(text, item, start, end);
        }

        // Output the text onto the correct place.
        $("div#preview h1").text(title);
        $("div#preview article").html(text);
    }

    /**
     * When clicking on the buttons, do the action the button describes.
     * @return void
     */
    $("div.editor > div.form-group > a[data-action]").click(function() {

        // Fetch the action
        var action = $(this).data('action');
        var $editor = $(this).parent().next().next().next().find('textarea');

        // Check if the editor needs to prepend a string
        if (typeof syntax[action] == "string") {
            $editor.selection("insert", {"text" : syntax[action], "mode" : "before"});
            previewText($editor);
            return true;
        }

        // Check if the editor needs to wrap a piece of text
        if ($.isArray(syntax[action])) {
            $editor.selection("insert", {"text" : syntax[action][0], "mode" : "before"});
            $editor.selection("insert", {"text" : syntax[action][1], "mode" : "after"});
            previewText($editor);
            return true;
        }
    });

    /**
     * Preview the text on keyup
     * @return void
     */
    $("div.editor > div.form-group > input[name='title']").keyup(function() {
        previewText($(this).parent().next().find("textarea"));
    })
    $("div.editor > div.form-group > textarea").keyup(function() {
       previewText($(this));
    }).trigger('keyup');
});