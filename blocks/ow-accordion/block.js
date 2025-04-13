jQuery(document).ready(function ($) {
    // Progressive enhancement: utilizing a no-js class
    // $("html").addClass("js").removeClass("no-js");
    // in css: .hidden.no-js { display: block }

    // Now set up the event listeners
    // Look for all buttons that are inside a correct level heading inside the accordion container
    $(".aaaki-accordion-container")
        .find(".aaaki-heading")
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

        // $(".aaaki-accordion-item").each(function (index) {
        //     $(this).removeClass("aaaki-open");
        //     $(this).find(".aaaki-accordion-panel").addClass("aaaki-hidden");
        //     $(this)
        //         .find(".aaaki-heading")
        //         .find("button")
        //         .attr("aria-expanded", "false");
        // });

        $($wrapper).addClass("aaaki-open");
        $($panel).removeClass("aaaki-hidden");
        $(obj).attr("aria-expanded", "true");
        $(obj).focus();
    }

    function hideAccordion(obj) {
        var $thisId = $(obj).attr("data-id");
        var $wrapper = $("#accordion-item-" + $thisId);
        var $panel = $("#accordion-panel-" + $thisId);

        $($wrapper).removeClass("aaaki-open");
        $($panel).addClass("aaaki-hidden");
        $(obj).attr("aria-expanded", "false");
        $(obj).focus();
    }
});
