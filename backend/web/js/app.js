$(function() {
    "use strict";

    //Use diy confirm box
    yii.confirm = function (message, ok, cancel) {
        bootbox.confirm(
            {
                message: message,
                buttons: {
                    confirm: {
                        label: "确认"
                    },
                    cancel: {
                        label: "取消"
                    }
                },
                callback: function (confirmed) {
                    if (confirmed) {
                        !ok || ok();
                    } else {
                        !cancel || cancel();
                    }
                }
            }
        );
        return false;
    }

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    }).disableSelection();
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");
})