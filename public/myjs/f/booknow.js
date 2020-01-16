$(function () {
    $('#traveldate').daterangepicker({
        timePicker: true,
        minDate: new Date(),
        singleDatePicker: true,
        autoUpdateInput: false,
        maxYear: parseInt(moment().format('YYYY'), 10)
    });

    $('#traveldate').val('');
    $('input[name="traveldate"]').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MMM D, YYYY hh:mm A'));
        // $('#traveldate').val(picker.format('MMM D, YYYY hh:mm A'));
        var r = picker.startDate.format('YYYY-M-DD HH:mm:ss');
        console.log(r)
        $('#traveldatetime').val(r);
    });

    $('#modal-overlaysss').on('click', '.submitbtn', function (event) {
        var res = validateForm();
        console.log(res);
        console.log(dayData[parseInt(finaltime)].ids);
        console.log(adulttimes);
        console.log(childtimes);

        if (res == true) {
            $('#redirectFrmId').val(dayData[parseInt(finaltime)].ids);
            $('#redirectFrmadults').val(adulttimes);
            $('#redirectFrmchilds').val(childtimes);
            var obj = {
                calId:$('#calId').val(),
                adults:$('#adults').val(),
                childs:$('#childs').val(),
                firstname:$('#firstname').val(),
                lastname:$('#lastname').val(),
                mobilenos:$('#mobilenos').val(),
                altmobilenumber:$('#alt_mobilenos').val(),
                email:$('#email').val(),
                cruiseterminal:$("input[name='cruiseterminal']:checked").val(),
                airport:$("input[name='airport']:checked").val(),
                triptype:$('input[name=triptype]:checked').val(),
                traveldatetime:$('#traveldatetime').val(),
                pickupaddress:$('#pickupaddress').val(),
                flightinfo:$('#flightinfo').val(),
                privatecharter:$('input[name=privatecharter]:checked').val(),
                additionalinfo:$('#adInfos').val()
            };

            $("#bookingForm .submitbtn").attr("disabled", true);
            $("#bookingForm .submitbtn").prop("disabled", true);

            // $('#bookingForm').submit();
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
            window.location = "/toursss";
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

        var tripvalue = $('input[name=triptype]:checked').val();
        if (tripvalue == undefined) {
            isValid = false;
            $('#invalid_triptype').show();
            if (!isFocusSet) {
                $('#triptyperdr').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_triptype').hide();
        }

        if ($('#traveldatetime').val() == '') {
            isValid = false;
            $('#invalid_traveldate').show();
            if (!isFocusSet) {
                $('#traveldate').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_traveldate').hide();
        }

        if ($('#pickupaddress').val() == '' || $('#pickupaddress').val().length < 3) {
            isValid = false;
            $('#invalid_pickupaddress').show();
            if (!isFocusSet) {
                $('#pickupaddress').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_pickupaddress').hide();
        }

        // if (($('#noofpassenger').val() == '') || (parseInt($('#noofpassenger').val()) != 1) || (parseInt($('#noofpassenger').val()) != 2)) 
        // if (!((parseInt($('#noofpassenger').val()) == 1) || (parseInt($('#noofpassenger').val()) == 2))) {
        //     isValid = false;
        //     $('#invalid_noofpassenger').show();
        //     if (!isFocusSet) {
        //         $('#noofpassenger').focus();
        //     }
        //     isFocusSet = true;
        // } else {
        //     $('#invalid_noofpassenger').hide();
        // }

        if ($('#flightinfo').val() == '') {
            isValid = false;
            $('#invalid_flightinfo').show();
            if (!isFocusSet) {
                $('#flightinfo').focus();
            }
        } else {
            $('#invalid_flightinfo').hide();
        }

        var privatecharters = $('input[name=privatecharter]:checked').val();
        if (privatecharters == undefined) {
            isValid = false;
            $('#invalid_privatecharter').show();
            if (!isFocusSet) {
                $('#pvtcharter').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_privatecharter').hide();
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