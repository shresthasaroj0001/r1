$('table').each(function(){
    if (!$(this).parent().hasClass('table-responsive')) {
        if ($(this).attr("id") == undefined || $(this).attr("id") == "") {
            $(this).wrap("<div class='table-responsive'></div>");
            $(this).addClass("styled-table");
        }
    }
});