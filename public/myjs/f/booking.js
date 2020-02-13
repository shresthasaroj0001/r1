$(function () {
    var IscheckavailabityBtnPressed = false;
    $('.mgbottom15').on('click', function () {
        IscheckavailabityBtnPressed = true;
        $('#checkavailabityBtn').hide();
        $('#TimselectionDiv').show();
        $('.book-now-btn').show();
        $('.booking-select-time').show();
    });

    var initLoad = true;
    var productId = parseInt($('#product-id').val());
    var tooken = $('#tokenn').val();
    var d = new Date();
    var mydate = "" + d.getFullYear() + "-" + (parseInt(d.getMonth()) + 1) + "-" + d.getDate();
    var currentmonth = "" + d.getFullYear() + "-" + (parseInt(d.getMonth()) + 1) + "-01";

    var monthdatas = [];

    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: mydate,
        // showButtonPanel: true,
        closeText: 'X',
        currentText: 'Today',
        //firstDay: weekStartOn, // 0 Sunday to 6 Saturday: default is 1 - Monday
        yearRange: '2020:2021',
        beforeShowDay: function (mydate) {
            return checkIndividualAvailability(mydate);
        },
        //altField: inputObj.attr('data-alt-field'),
        altFormat: 'yy-mm-dd',
        onChangeMonthYear: function (year, month, inst) {
            var yyyy = inst.selectedYear.toString();
            var mm = (1 + inst.selectedMonth).toString();
            showdate = yyyy + '-' + (mm[1] ? mm : '0' + mm[0]) + '-01';
            monthchangeEvent(showdate);
        },
        onSelect: function (dateText, inst) {
            DateSelectEvent(dateText);
        },
        // nextText: 'next &rarr;',
        // prevText: '&larr; prev',
        defaultDate: $.datepicker.parseDate('yy-mm-dd', mydate)
        // defaultDate: $.datepicker.parseDate('yy-mm-dd', $('' + inputObj.attr('data-alt-field')).val())
    });
    // $("#datepicker").datepicker("setDate", "10/12/2012");

    function checkIndividualAvailability(mydate) {
        checkdate = $.datepicker.formatDate('yy-mm-dd', mydate);
        if (monthdatas.find(x => x.tdate == checkdate) != undefined) {
            return [true, "available", "Available"];
        }
        return [false, "unavailable", "Not available"];
    }

    var mnts = $('#mydates').val();
    if (mnts == "") {
        monthchangeEvent(currentmonth);
    } else {
        monthchangeEvent(mnts);
    }


    function monthchangeEvent(month) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': tooken
            },
            url: "/tour/getmonthsdetail",
            type: 'POST',
            data: {
                "pid": productId,
                "month": month
            },
            success: function (datas) {
                monthdatas = datas;
                console.log(datas);
                if (initLoad) {
                    $("#datepicker").datepicker("setDate", mnts);
                    initLoad = false;
                }
                $("#datepicker").datepicker('refresh');
                if (monthdatas.find(x => x.tdate == $("#datepicker").val()) != undefined) {
                    DateSelectEvent($("#datepicker").val());
                }
            },
            error: function (eror) {},
            complete: function () {}
        }); //ajax ending
    }

    var dayData = [];

    function DateSelectEvent(datees) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': tooken
            },
            url: "/tour/updaterate",
            type: 'POST',
            data: {
                "pid": productId,
                "month": datees
            },
            beforeSend: function () {
                $('#bookingtimeselection').empty();
                $("#TimselectionDiv").LoadingOverlay("show", {
                    background: "rgba(165, 190, 100, 0.5)"
                });
                $("#TimselectionDiv").LoadingOverlay("show");
                $("#costDiv").LoadingOverlay("show");
                $(".booking-select-time").LoadingOverlay("show");

                $("#bookingFinal").hide();
            },
            success: function (datas) {
                // console.log("asdf",datas);
                dayData = [];
                dayData = datas;
                i = "";
                if (datas.length != 0) {
                    datas.forEach(function (item, index, array) {
                        i += "<option value='" + index + "'>" + item.tourdatetime + "</option>";
                    });
                }
                $('#bookingtimeselection').append(i);

                if (datas.length != 0) {
                    $('#bookingtimeselection').val(0);
                    bookingTimechange();
                }
            },
            error: function (eror) {

            },
            complete: function () {
                $("#datepicker").datepicker('refresh');
                $("#TimselectionDiv").LoadingOverlay("hide", true);
                $("#costDiv").LoadingOverlay("hide", true);
                $(".booking-select-time").LoadingOverlay("hide", true);

                if (IscheckavailabityBtnPressed)
                    $("#bookingFinal").show();
            }
        }); //ajax ending
    }

    var optionSelectedd = "";

    function bookingTimechange() {
        var optionSelected = $("#bookingtimeselection option:selected").text();
        var valueSelected = $('#bookingtimeselection').val();
        //console.log(optionSelected, valueSelected);

        var parsedValue = parseInt(valueSelected);
        optionSelectedd = optionSelected;

        console.log(dayData[parsedValue]);

        var descrptions = dayData[parsedValue].description;
        var rates = descrptions.split("<br>");

        $('#costDiv tr:not(:first)').remove();
        $('#grpSelectionTble tr:not(:first)').remove();
        var i = "";
        var grpSelectionTblehtml = "<tr><td><select name='groupSize' id='groupSize' class='form-control' style='max-width: 75%;'><option disabled selected>Select Group Size</option>";
        rates.forEach(function (item, index, array) {
            var parts = item.split(',');
            var rateId = parts[0].split('R')[1];
            var fpart = parts[1].split('$');

            i += '<tr> <td> <label> ' + fpart[0] + ' </label></td><td> <label> $ ' + fpart[1] + '</label></td></tr>';
            grpSelectionTblehtml += '<option value="' + fpart[1] + '" rId="' + rateId + '"> ' + fpart[0] + ' </option>'
        });
        $('#costDiv #costDivtBody').html(i);
        grpSelectionTblehtml += '</select></td><td><h3 class="finalRate"></h3></td></tr>';
        $('#grpInfo #grpSelectionTble').html(grpSelectionTblehtml);

        $("#grpSelectionTble #groupSize").prop("selectedIndex", 1);

        GrpSizeChangeEvnt();
    }

    $('#grpSelectionTble').on('change', '#groupSize', function (e) {
        GrpSizeChangeEvnt();
    });

    var rId = 0;

    function GrpSizeChangeEvnt() {
        var r = $("#grpSelectionTble #groupSize").val();
        $('.finalRate').html("$" + r);
        rId = $("#grpSelectionTble #groupSize").find(':selected').attr('rid');
    }

    $('#bookingtimeselection').on('change', function (e) {
        bookingTimechange();
        CalculateAmount();
    });

    $("#BookNowBtn").click(function () {
        // $('#boksDiv').on("click", "#BookNowBtn", function () {
        if (rId > 0 && IscheckavailabityBtnPressed) {
            // $('#redirectForm').submit();

            $('#bookingForm #redirectFrmId').val(parseInt(rId));
            $('#modal-overlaysss').modal('show');
        }
    });

    //nxt
    $('#modal-overlaysss').on('click', '.submitbtn', function (event) {
        var res = validateForm();
        
        console.log($('#redirectFrmId').val());
       
        console.log(res);
        if (res == true) {
            // $('#redirectFrmId').val(dayData[parseInt(finaltime)].ids);
            // $('#redirectFrmadults').val(adulttimes);
            // $('#redirectFrmchilds').val(childtimes);
            var obj = {
                calId: $('#redirectFrmId').val(),
                // adults: $('#redirectFrmadults').val(),
                // childs: $('#redirectFrmchilds').val(),
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
                mobilenos: $('#mobilenos').val(),
                altmobilenumber: $('#alt_mobilenos').val(),
                email: $('#email').val(),
                cruiseterminal: $("input[name='cruiseterminal']:checked").val(),
                airport: $("input[name='airport']:checked").val(),
                triptype: $('input[name=triptype]:checked').val(),
                traveldatetime: $('#traveldatetime').val(),
                pickupaddress: $('#pickupaddress').val(),
                flightinfo: $('#flightinfo').val(),
                privatecharter: $('input[name=privatecharter]:checked').val(),
                additionalinfo: $('#adInfos').val()
            };
            console.log(obj);


            $("#modal-overlaysss .submitbtn").attr("disabled", true);
            $("#modal-overlaysss .submitbtn").prop("disabled", true);

            $('#bookingForm').submit();
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('#tokkken').val()
            //     },
            //     // url: "/book-now-now",
            //     url: window.location.href+"w",
            //     type: 'POST',
            //     data: obj,
            //     beforeSend: function () {
            //     },
            //     success: function (datas) {
            //         return datas;
            //     },
            //     error: function (eror) {

            //     },
            //     complete: function () {
            //         console.log("done");
            //         // $("#tourss").LoadingOverlay("hide");
            //     },
            // }); //ajax ending

        }
    });

    function validateForm() {
        if ($('#redirectFrmId').val() == '') {
            alert("Internal Error.. Please Report us");
            window.location = "/tours";
        }

        var isValid = true;
        var isFocusSet = false;
        if ($('#firstname').val() == '') {
            isValid = false;
            $('#invalid_firstname').show();
            isFocusSet = true;
            $('#firstname').focus();
        } else {
            $('#invalid_firstname').hide();
        }
        if ($('#lastname').val() == '') {
            isValid = false;
            $('#invalid_lastname').show();
            if (!isFocusSet) {
                $('#lastname').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_lastname').hide();
        }
        if ($('#mobilenos').val() == '') {
            isValid = false;
            $('#invalid_mobilenos').show();
            if (!isFocusSet) {
                $('#mobilenos').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_mobilenos').hide();
        }

        if ($('#email').val() == '') {
            isValid = false;
            $('#invalid_email').show();
            if (!isFocusSet) {
                $('#email').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_email').hide();
            var res = IsEmail($('#email').val());
            if (!res) {
                isValid = false;
                isFocusSet = true;
                $('#email').focus();
            }
        }

        return isValid;
    }

    $('#email').on('keyup', function () {
        IsEmail($(this).val());
    });

    $('#email').on('focusout', function () {
        IsEmail($(this).val());
    });

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (email != '') {
            $('#invalid_email').hide();
            if (!regex.test(email)) {
                $('#invalid_email_invalid').show();
                return false;
            } else {
                $('#invalid_email_invalid').hide();
                return true;
            }
        } else {
            $('#invalid_email').show();
            $('#invalid_email_invalid').hide();
            return false;
        }
    }

});