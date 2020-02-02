$(function () {
    var menuId = parseInt($('#menuids').val());
    var date = new Date();
    $('#mdp-demoo').multiDatesPicker({
        dateFormat: "yy-mm-dd",
        // minDate: 0, // today
        maxDate: 200 // +30 days from today
        // preselect the 14th and 19th of the current month
        // addDates: [date.setDate(14), date.setDate(19)]
    });

    var selectedDates;
    $('#addevents').click(function () {
        var dates = $('#mdp-demoo').multiDatesPicker('getDates');
        if (dates.length == 0) {
            alert('Please select at one date')
            return false;
        }
        console.log(dates);
        selectedDates = dates;
        $('#selectedDate').html(dates.join(", "));
        $('#dateselection').hide();
        $('#timeselectionDiv').show();
    });

    $('#timepicker1').timepicker({
        defaultTime: false,
        showMeridian: false
    });

    $('#timepicker1').timepicker('setTime', '');

    var TimePickerValue = "";
    $('#addtime').click(function () {
        var datees = $('#timepicker1').val();
        if (datees == "") {
            alert('Please select Time');
            return false;
        }
        TimePickerValue = datees;
        rateinputDivShow();
        console.log(datees);
    });

    function rateinputDivShow() {
        $("#addtime").attr("disabled", true);
        $("#addtime").prop("disabled", true);
        $('#rateinputDiv').show();
        $(".moneyValidator").val('');
        $("#noOfAvailable").val('');
    }

    $('#rateinputDiv').on('keyup', ".moneyValidator", function (event) {
        var ress = $(this).val();
        var valid = /^\d{0,16}(\.\d{0,2})?$/.test(ress);
        if (!valid && ress != null) {
            $(this).val(ress.substring(0, ress.length - 1));
            return false;
        }
    });

    $('#rateinputDiv').on('keyup', "#noOfAvailable", function (event) {
        var ress = $(this).val();
        var valid = /(?<=\s|^)\d+(?=\s|$)/.test(ress);
        if (!valid && ress != null) {
            $(this).val(ress.substring(0, ress.length - 1));
            return false;
        }

    });

    function validateRateInput() {
        var r1 = parseFloat($('#rateForAdult').val());
        var r2 = parseFloat($('#rateForChild').val());
        var r3 = parseInt($('#noOfAvailable').val());
        if (r1 > 1 && r2 > 1 && r3 > 0) {
            return true;
        }
        return false;
    }
    var TimeSelected = [];
    $('#addTOlistBtn').click(function () {
        var r = validateRateInput();
        if (!r) {
            alert('All Fields Are Mandatory');
            return false;
        }
        var obj = {
            "Time": TimePickerValue,
            "r1": parseFloat($('#rateForAdult').val()),
            "r2": parseFloat($('#rateForChild').val()),
            "r3": parseInt($('#noOfAvailable').val())
        };
        TimeSelected.push(obj);
        $('#rateinputDiv').hide();
        $('#timepicker1').timepicker('setTime', '');
        $("#addtime").prop("disabled", false);
        $("#addtime").removeAttr("disabled");

        RefreshTimeList();
    });

    function RefreshTimeList() {
        var i = "";
        $("#dataTbl").empty();

        TimeSelected.forEach(function (item, index, array) {
            i += "<tr><td>" + item.Time + "</td><td>" + item.r1;
            i += "</td><td>" + item.r2 + "</td><td>" + item.r3;
            i += "</td><td><button class='btn btn-danger deleterow' data-ids='" + index + "' type='button'>Remove</button></td></tr>";
        });
        // console.log(TimeSelected);

        $("#dataTbl").html(i);

        if (TimeSelected.length > 0) {
            $("#12div").show();
            $("#finaldiv").show();
            $("#finalsubmitbtn").prop("disabled", false);
            $("#finalsubmitbtn").removeAttr("disabled");
        } else {
            $("#finalsubmitbtn").attr("disabled", true);
            $("#finalsubmitbtn").prop("disabled", true);
            $("#12div").hide();
            $("#finaldiv").hide();
        }
    }
    $("#finalsubmitbtn").attr("disabled", true);
    $("#finalsubmitbtn").prop("disabled", true);

    console.log(window.location.href);

    $('#finalsubmitbtn').click(function () {
        if (TimeSelected.length > 0) {
            // $("#finalsubmitbtn").attr("disabled", true);
            // $("#finalsubmitbtn").prop("disabled", true);
            var finalObj = [];
            TimeSelected.forEach(function (item, index, array) {
                selectedDates.forEach(function (itemm, indexx, arrayy) {
                    var reqO = {
                        "tourdetails_id":menuId,
                        "tourdatetime":itemm +" "+item.Time,
                        "paxs":item.r3,
                        "rate_children":item.r2,
                        "rate_adult":item.r1,
                        "stats":1,
                    };
                    finalObj.push(reqO);
                });
            });
            console.log(finalObj)

            $.ajax(
                {
                    url: window.location.href,
                    headers: {'X-CSRF-TOKEN': $('#tooken').val() },
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data:JSON.stringify(finalObj),
                    success: function (datas) {
                        if(parseInt(datas)==1){
                            alert("Success");
                        }else{
                            alert("Error.. Please Report us");
                        }
                        location.reload(true);
                    },
                    complete: function () { },
                    error: function (jqXHR, textStatus, errorThrown) { console.log('error'); }
                });
        }
    });

    $('#dataTbl').on("click", ".deleterow", function (e) {
        var r = parseInt($(this).attr("data-ids"));
        if (r >= 0) {
            var deleteditem = TimeSelected.splice(r, 1);
            // console.log(deleteditem);
            RefreshTimeList();
        } else {
            alert('error');
        }

    })

});
