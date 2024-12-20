if ("undefined" == typeof jQuery)
    throw new Error("jQuery plugins need to be before this file");
$(document).ready(function() {
    var e;
    $(window).on("scroll", function() {
        100 <= (e = $(window).scrollTop()) ? $(".body-header").addClass("scrolled-nav shadow-sm") : e < 100 && $(".body-header").removeClass("scrolled-nav shadow-sm")
    })
}),
$(function() {
    "use strict";
    document.documentElement;
    $(".avio-docs .sidebar-togle").on("click", function() {
        $(".avio-docs .sidebar").toggleClass("open")
    }),
    $(".btn-right a").on("click", function() {
        $(".rightbar").toggleClass("open")
    }),
    $(".sidebar-mini-btn").on("click", function() {
        $(".sidebar").toggleClass("sidebar-mini")
    }),
    $(".hamburger-icon").on("click", function() {
        $(this).toggleClass("active")
    }),
    $(".inbox .fa-star").on("click", function() {
        $(this).toggleClass("active")
    }),
    $(".main-search input").on("focus", function() {
        $(".search-result").addClass("show")
    }),
    $(".main-search input").on("blur", function() {
        setTimeout(function() {
            $(".search-result").removeClass("show")
        }, 200)
    }),
    $(".font_setting input:radio").on("click", function() {
        var e = $("[name='" + this.name + "']").map(function() {
            return this.value
        }).get().join(" ");
        console.log(e),
        $("body").removeClass(e).addClass(this.value)
    }),
    $(".select-all.form-check-input").on("change", function() {
        var t = $(this).is(":checked"),
            e = $(this).parent().parent().parent().parent().parent().find(".row-selectable");
        0 < e.length && e.each(function(e) {
            $(this).find(".form-check-input")[0].checked = t
        })
    }),
    document.getElementById("notifications") && document.getElementById("notifications").addEventListener("click", function(e) {
        e.stopPropagation()
    });
    [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function(e) {
        return new bootstrap.Tooltip(e)
    })
}),
$(function() {
    "use strict";
    let e = document.documentElement;
    $(".choose-skin li").on("click", function() {
        var e = $("body"),
            t = $(this);
        $(".choose-skin li.active").data("theme");
        $(".choose-skin li").removeClass("active"),
        t.addClass("active"),
        e.attr("data-avio", "theme-" + t.data("theme"))
    }),
    $("#primaryColorPicker").colorpicker().on("changeColor", function() {
        e.style.setProperty("--primary-color", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#secondaryColorPicker").colorpicker().on("changeColor", function() {
        e.style.setProperty("--secondary-color", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#BodyColorPicker").colorpicker().on("changeColor", function() {
        e.style.setProperty("--body-color", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#CardColorPicker").colorpicker().on("changeColor", function() {
        e.style.setProperty("--card-color", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#BorderColorPicker").colorpicker().on("changeColor", function() {
        e.style.setProperty("--border-color", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#chartColorPicker1").colorpicker().on("changeColor", function() {
        e.style.setProperty("--chart-color1", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#chartColorPicker2").colorpicker().on("changeColor", function() {
        e.style.setProperty("--chart-color2", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#chartColorPicker3").colorpicker().on("changeColor", function() {
        e.style.setProperty("--chart-color3", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#chartColorPicker4").colorpicker().on("changeColor", function() {
        e.style.setProperty("--chart-color4", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $("#chartColorPicker5").colorpicker().on("changeColor", function() {
        e.style.setProperty("--chart-color5", $(this).colorpicker("getValue", "#ffffff"))
    }),
    $(".theme-rtl input:checkbox").on("click", function() {
        $(this).is(":checked") ? $("body").addClass("rtl_mode") : $("body").removeClass("rtl_mode");
        var e = $(".scale-left"),
            t = $(".scale-right");
        e.addClass("scale-right"),
        e.removeClass("scale-left"),
        t.addClass("scale-left"),
        t.removeClass("scale-right")
    }),
    $(".radius-switch input:checkbox").on("click", function() {
        $(this).is(":checked") ? $("body").addClass("radius-0") : $("body").removeClass("radius-0")
    }),
    $(".fluid-switch input:checkbox").on("click", function() {
        $(this).is(":checked") ? ($(".container").addClass("container-fluid"), $(".container").removeClass("container")) : ($(".container-fluid").addClass("container"), $(".container-fluid").removeClass("container-fluid"))
    }),
    $(".shadow-switch input:checkbox").on("click", function() {
        $(this).is(":checked") ? $(".card").addClass("shadow-active") : $(".card").removeClass("shadow-active")
    })
}),
$(function() {
    $("#font_apply").on("click", function() {
        var e = $("#font_url").val(),
            t = $("#font_family").val(),
            o = $("head");
        $("body").css("font-family", t),
        o.append('<link href="' + e + '" rel="stylesheet" data-type="font-url">'),
        e && t && $(".font_setting input[name=font]").attr("disabled", !0)
    }),
    $("#font_cancel").on("click", function() {
        var e = $("link").filter(function() {
            if ("font-url" == $(this)[0].getAttribute("data-type"))
                return $(this)[0]
        });
        $("body").css("font-family", ""),
        e[0].remove(),
        $("#font_url").val(""),
        $("#font_family").val("");
        $(".font_setting input[name=font]").attr("disabled", !1)
    })
}),
$(function() {
    $(".next").on("click", function() {
        var e = $(this).parents(".tab-pane").next().attr("id");
        return $("a[href=\\#" + e + "]").tab("show"), !1
    }),
    $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function(e) {
        e = $(e.target).data("bs-step"),
        e = parseInt(e) / 5 * 100;
        $("#create_project .progress-bar").css({
            width: e + "%"
        })
    }),
    $(".first").on("click", function() {
        $("#myWizard a:first").tab("show")
    })
}),
$(function() {
    $(".password-meter .form-control").on("input", function() {
        var e = 0,
            t = $(this).val(),
            o = new RegExp("[A-Z]"),
            c = new RegExp("[a-z]"),
            n = new RegExp("[0-9]"),
            r = new RegExp("^(?=.*?[#?!@$%^&*-]).{1,}$");
        7 < t.length && e++,
        0 < t.length && t.match(o) && e++,
        0 < t.length && t.match(c) && e++,
        0 < t.length && t.match(n) && e++,
        0 < t.length && t.match(r) && e++,
        $(".password-meter .progress-bar")[0].style.width = 20 * e + "%"
    })
}),
$(function() {
    $(".image-input .form-control").on("change", function() {
        var e = URL.createObjectURL(this.files[0]);
        $(this).parent().parent().children(".avatar-wrapper")[0].style.background = "url(" + e + ") no-repeat"
    })
}),
$(function() {
    $(".card-fullscreen").on("click", function(e) {
        return $(this).closest("div.card").toggleClass("fullscreen"), e.preventDefault(), !1
    })
});