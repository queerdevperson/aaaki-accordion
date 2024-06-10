jQuery(document).ready(function ($) {
    // Progressive enhancement: utilizing a no-js class
    // $("html").addClass("js").removeClass("no-js");
    // in css: .hidden.no-js { display: block }

    // Now set up the event listeners
    // Look for all buttons that are inside a correct level heading inside the accordion container
    $(".ow-accordion-container")
        .find(".ow-heading")
        .find("button")
        .on("click", function (e) {
            if ($(this).attr("aria-expanded") == "true") {
                hideAccordion($(this));
            } else {
                showAccordion($(this));
            }
        });

    function showAccordion(obj) {
        var $thisId = $(obj).attr("data-id");
        var $wrapper = $("#accordion-item-" + $thisId);
        var $panel = $("#accordion-panel-" + $thisId);

        // $(".ow-accordion-item").each(function (index) {
        //     $(this).removeClass("ow-open");
        //     $(this).find(".ow-accordion-panel").addClass("ow-hidden");
        //     $(this)
        //         .find(".ow-heading")
        //         .find("button")
        //         .attr("aria-expanded", "false");
        // });

        $($wrapper).addClass("ow-open");
        $($panel).removeClass("ow-hidden");
        $(obj).attr("aria-expanded", "true");
        $(obj).focus();
    }

    function hideAccordion(obj) {
        var $thisId = $(obj).attr("data-id");
        var $wrapper = $("#accordion-item-" + $thisId);
        var $panel = $("#accordion-panel-" + $thisId);

        $($wrapper).removeClass("ow-open");
        $($panel).addClass("ow-hidden");
        $(obj).attr("aria-expanded", "false");
        $(obj).focus();
    }
});
