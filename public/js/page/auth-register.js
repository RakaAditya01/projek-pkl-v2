"use strict";

$(".pwstrength").pwstrength();

$('#reload').click(function () {
    $.ajax({
        type: 'GET',
        url: 'reload-captcha',
        success: function (data) {
            $(".captcha span").html(data.captcha);
        }
    });
});