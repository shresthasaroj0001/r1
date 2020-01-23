$(function () {
    $('.mgbottom15').on('click', function () {
        $('#checkavailabityBtn').hide();
        $('#boksDiv').show();
        $('.book-now-btn').show();
        $('.booking-select-time').show();
        // $('#iti1').show();
        // $('.iti li').removeClass('active');
        // $('.tab-pane    .sa123').removeClass('active');
        // $('.tab-content .sa123').removeClass('active');
        //.addClass('notSelectedTab');
        //$('.tab-pane .sa123').find('a[href="'+active_tab+'"]').parent().addClass('active');
        // $(".sa123 li").addClass('active').siblings().removeClass('active');
        // $(".iti li").eq(0).addClass('active'); 
        // $('.iti li').trigger('change');

        // $(".sa123").eq(0).addClass('active'); 
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
    if(mnts == ""){
        monthchangeEvent(currentmonth);
    }else{
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
                // console.log(datas);
            },
            error: function (eror) {

            },
            complete: function () {
                if(initLoad){
                    $("#datepicker").datepicker("setDate", mnts);
                    initLoad=false;
                }
                $("#datepicker").datepicker('refresh');
                if (monthdatas.find(x => x.tdate == $("#datepicker").val()) != undefined) {
                    DateSelectEvent($("#datepicker").val());
                }
            }
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
                bookingSelectionDateChange();
            },
            success: function (datas) {
                //monthdatas = datas;
                // console.log(datas);
                dayData = [];
                dayData = datas;
                $('#bookingtimeselection').empty();
                i = "";
                if (datas.length != 0) {
                    datas.forEach(function (item, index, array) {
                        if (parseInt(item.paxs) > 0) {
                            i += "<option value='" + index + "'>" + item.tourdatetime + " -" + item.paxs + " Available " + "</option>";
                        } else {
                            i += "<option value=''>" + "<b>Sold Out</b>" + "</option>";
                        }
                    });
                }
                $('#bookingtimeselection').append(i);

                if (datas.length != 0) {
                    $('#bookingtimeselection').val(0);
                    bookingTimechange();
                    CalculateAmount();
                    $('#bookingtimeNotselected').hide();
                    $('#bookingbtnDiv').show();
                }
            },
            error: function (eror) {

            },
            complete: function () {
                $("#datepicker").datepicker('refresh');
            }
        }); //ajax ending
    }

    function bookingSelectionDateChange() {
        $('#bookingtimeselection').empty();
        $('#AdultRate').html('Please Select Time');
        $('#ChildRate').html('Please Select Time');

        $('#bookingbtnDiv').hide();
        $('#bookingnotAvailable').hide();
        $('#bookingtimeNotselected').show();
    }

    var adultrate = 0;
    var childrate = 0;
    var optionSelectedd = "";
    var seatsleft = 0;
    var totalPrice = 0;

    function bookingTimechange() {
        var optionSelected = $("#bookingtimeselection option:selected").text();
        var valueSelected = $('#bookingtimeselection').val();
        //console.log(optionSelected, valueSelected);

        var parsedValue = parseInt(valueSelected);
        optionSelectedd = optionSelected;
        adultrate = parseFloat(dayData[parsedValue].rate_adult);
        childrate = parseFloat(dayData[parsedValue].rate_child);
        seatsleft = parseInt(dayData[parsedValue].paxs);
        $('#AdultRate').html('$ ' + adultrate);
        $('#adult-rate').html(adultrate)
        $('#ChildRate').html('$ ' + childrate);
        $('#child-rate').html(childrate)

    }

    $('#bookingtimeselection').on('change', function (e) {
        bookingTimechange();
        CalculateAmount();
    });

    var adulttimes = 0;
    var childtimes = 0;

    function CalculateAmount() {
        try {
            adulttimes = parseInt($("#adultqty").val());
            childtimes = parseInt($("#childqty").val());
        } catch (e) {
            adulttimes = 0;
            childtimes = 0;
        }

        $("#adultfinalr").html('$ ' + (adulttimes * adultrate));
        $("#childfinalr").html('$ ' + (childtimes * childrate));
        totalPrice = ((adulttimes * adultrate) + (childtimes * childrate));
        $('#totalprice').html('$ ' + totalPrice);

        if (totalPrice > 0) {
            if ((adulttimes + childtimes) > seatsleft) {
                $("#bookingExced").show();
                $("#bookingbtnDiv").hide();
                $("#BookNowBtn").prop("disabled", true);
                $("#BookNowBtn").attr("disabled", true);
            } else {
                $("#bookingExced").hide();
                $("#bookingbtnDiv").show();
                $("#BookNowBtn").prop("disabled", false);
                $("#BookNowBtn").removeAttr("disabled");

            }
        }
    }

    $('.changeqty').on('change', function (e) {
        CalculateAmount();
        if (adulttimes > 0 || childtimes > 0) {} else {
            $('#bookingExced').hide();
            $('#bookingnotAvailable').hide();
        }
    });
    finaltime=0;
    $('#boksDiv').on("click", "#BookNowBtn", function () {
        if (totalPrice > 0) {
            if ((adulttimes + childtimes) <= seatsleft) {
                finaltime = $('#bookingtimeselection').val();
                if (finaltime != null) {
                    // $('#redirectForm').submit();

                    
                    $('#bookingForm #redirectFrmId').val(dayData[parseInt(finaltime)].ids);
                    $('#bookingForm #redirectFrmadults').val(adulttimes);
                    $('#bookingForm #redirectFrmchilds').val(childtimes);

                    $('#modal-overlaysss').modal('show');
                }
            }
        }
    });

    //nxt
    $('#modal-overlaysss').on('click', '.submitbtn', function (event) {
        var res = validateForm();
        // $('#bookingForm #redirectFrmId').val(dayData[parseInt(finaltime)].ids);
        // $('#bookingForm #redirectFrmadults').val(adulttimes);
        // $('#bookingForm #redirectFrmchilds').val(childtimes);
        console.log($('#redirectFrmId').val());
        console.log($('#redirectFrmadults').val());
        console.log($('#redirectFrmchilds').val());
        console.log(res);
        if (res == true) {
            $('#redirectFrmId').val(dayData[parseInt(finaltime)].ids);
            $('#redirectFrmadults').val(adulttimes);
            $('#redirectFrmchilds').val(childtimes);
            var obj = {
                calId: $('#redirectFrmId').val(),
                adults: $('#redirectFrmadults').val(),
                childs: $('#redirectFrmchilds').val(),
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
        if ($('#calId').val() == '' || $('#adults').val() == '' || $('#childs').val() == '') {
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