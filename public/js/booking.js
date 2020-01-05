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

    $('#bookingForm').on('click', '.submitbtn', function (event) {
        var res = validateForm();
        console.log(res);
        if (res) {
            $("#bookingForm .submitbtn").attr("disabled", true);
            $("#bookingForm .submitbtn").prop("disabled", true);

            $('#bookingForm').submit();
        }
    });

    function validateForm() {
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
        if (!((parseInt($('#noofpassenger').val()) == 1) || (parseInt($('#noofpassenger').val()) == 2))) {
            isValid = false;
            $('#invalid_noofpassenger').show();
            if (!isFocusSet) {
                $('#noofpassenger').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_noofpassenger').hide();
        }

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