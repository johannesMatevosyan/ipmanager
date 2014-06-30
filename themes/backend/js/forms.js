$(function(){
    $('.date-picker').datepicker();

    $('.selectpicker').selectpicker();
    //selectpicker doesn't seem to be flexible enough (can't change template), so need to replace span.caret externally
    $('.selectpicker + .bootstrap-select span.caret').replaceWith("<i class='icon-caret-down'></i>");
    $('.selectpicker + .bootstrap-select span.pull-left').removeClass("pull-left");

    $("#phone, #fax").mask("(999) 999-9999");
    $("#publish-time").mask("99:99");

    //teach select2 to accept data-attributes
    $(".chzn-select").each(function(){
        $(this).select2($(this).data());
    });
    $("#article-tags").select2({
        tags: ['photoshop', 'colors', 'plugins', 'themes', 'bike']
    });

    //changing default parsley behaviour so it adds error messages to labels.
    //label - is a parent of element
    $("#user-form").parsley({
        errors: {
            container: function ( elem, isRadioOrCheckbox ) {
                return elem.parents(".control-group").children("label");
            }
        }
    });

    $("input:checkbox").iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey'
    });

    var customWysihtml5Templates = {
        "font-styles": function(locale) {
            return "<li class='dropdown'>" +
            "<a class='btn btn-small dropdown-toggle' data-toggle='dropdown' href='#'>" +
            "<i class='icon-font'></i>&nbsp;<span class='current-font'>" + locale.font_styles.normal + "</span>&nbsp;&nbsp;<i class='icon-caret-down'></i>" +
            "</a>" +
            "<ul class='dropdown-menu'>" +
            "<li><a data-wysihtml5-command='formatBlock' data-wysihtml5-command-value='div'>" + locale.font_styles.normal + "</a></li>" +
							"<li><a data-wysihtml5-command='formatBlock' data-wysihtml5-command-value='p'>" + locale.font_styles.normal + "</a></li>" +
							"<li><a data-wysihtml5-command='formatInline' data-wysihtml5-command-value='span'>" + locale.font_styles.normal + "</a></li>" +
            "<li><a data-wysihtml5-command='formatBlock' data-wysihtml5-command-value='h1'>" + locale.font_styles.h1 + "</a></li>" +
            "<li><a data-wysihtml5-command='formatBlock' data-wysihtml5-command-value='h2'>" + locale.font_styles.h2 + "</a></li>" +
							"<li><a data-wysihtml5-command='formatBlock' data-wysihtml5-command-value='h3'>" + locale.font_styles.h3 + "</a></li>" +
            "</ul>" +
            "</li>"
        },
        "emphasis":  function(locale) {
            return "<li>" +
            "<div class='btn-group'>"
            + "<a class='btn btn-small ' data-wysihtml5-command='bold' title='CTRL+B'><i class='icon-bold'></i></a>"
            + "<a class='btn btn-small ' data-wysihtml5-command='italic' title='CTRL+I'><i class='icon-italic'></i></a>"
            //,+ "<a class='btn' data-wysihtml5-command='underline' title='CTRL+U'>Underline</a>"
            + "</div>"
            + "</li>"
        },
        "lists": function(locale) {
                return "<li>"
            + "<div class='btn-group'>"
            + "<a class='btn btn-small ' data-wysihtml5-command='insertUnorderedList' title='" + locale.lists.unordered + "'><i class='icon-list'></i></a>"
            + "<a class='btn btn-small ' data-wysihtml5-command='insertOrderedList' title='" + locale.lists.ordered + "'><i class='icon-th-list'></i></a>"
            + "<a class='btn btn-small ' data-wysihtml5-command='Outdent' title='" + locale.lists.outdent + "'><i class='icon-indent-right'></i></a>"
            + "<a class='btn btn-small ' data-wysihtml5-command='Indent' title='" + locale.lists.indent + "'><i class='icon-indent-left'></i></a>"
            + "</div>"
            + "</li>"
        },

        "link": function(locale) {
                    return "<li>"

            + "<div class='bootstrap-wysihtml5-insert-link-modal modal hide fade'>"
            + "<div class='modal-header'>"
            + "<a class='close' data-dismiss='modal'>×</a>"
            + "<h3>" + locale.link.insert + "</h3>"
            + "</div>"
            + "<div class='modal-body'>"
            + "<input value='http://' class='bootstrap-wysihtml5-insert-link-url input-xlarge'>"
            + "</div>"
            + "<div class='modal-footer'>"
            + "<a href='#' class='btn' data-dismiss='modal'>" + locale.link.cancel + "</a>"
            + "<a href='#' class='btn btn-primary' data-dismiss='modal'>" + locale.link.insert + "</a>"
            + "</div>"
            + "</div>"

            + "<a class='btn btn-small ' data-wysihtml5-command='createLink' title='" + locale.link.insert + "'><i class='icon-share'></i></a>"

            + "</li>"
        },

        "image": function(locale) {
                        return "<li>"

            + "<div class='bootstrap-wysihtml5-insert-image-modal modal hide fade'>"
            + "<div class='modal-header'>"
            + "<a class='close' data-dismiss='modal'>×</a>"
            + "<h3>" + locale.image.insert + "</h3>"
            + "</div>"
            + "<div class='modal-body'>"
            + "<input value='http://' class='bootstrap-wysihtml5-insert-image-url input-xlarge'>"
            + "</div>"
            + "<div class='modal-footer'>"
            + "<a href='#' class='btn' data-dismiss='modal'>" + locale.image.cancel + "</a>"
            + "<a href='#' class='btn btn-primary' data-dismiss='modal'>" + locale.image.insert + "</a>"
            + "</div>"
            + "</div>"

            + "<a class='btn btn-small ' data-wysihtml5-command='insertImage' title='" + locale.image.insert + "'><i class='icon-picture'></i></a>"

            + "</li>"
        },

        "html": function(locale) {
                            return "<li>"
                + "<div class='btn-group'>"
                + "<a class='btn btn-small ' data-wysihtml5-action='change_view' title='" + locale.html.edit + "'><i class='icon-pencil'></i></a>"
                + "</div>"
                + "</li>"
        }
    };
    $("#text").wysihtml5({
        html: true,
        customTemplates: customWysihtml5Templates,
        stylesheets: []
    });
});