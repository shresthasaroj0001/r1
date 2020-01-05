$(function () {
    $("#contactForm .sendmailbtn").attr("disabled", true);
    $("#contactForm .sendmailbtn").prop("disabled", true);

    $('#contactForm').on('click', '.sendmailbtn', function (event) {
        var res = validateForm();
        if (res) {
            var verified = grecaptcha.getResponse();
            if (verified.length === 0) {
                event.preventDefault();
            }
            $("#contactForm .sendmailbtn").attr("disabled", true);
            $("#contactForm .sendmailbtn").prop("disabled", true);

            $('#contactForm').submit();
        }
    });

    function validateForm() {
        var isValid = true;
        var isFocusSet = false;
        if ($('#fullname').val() == '') {
            isValid = false;
            $('#invalid_fullname').show();
            isFocusSet = true;
            $('#fullname').focus();
        } else {
            $('#invalid_fullname').hide();
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
                isFocusSet = true;
                $('#email').focus();
            }
        }

        if ($('#phone').val() == '') {
            isValid = false;
            $('#invalid_phone').show();
            if (!isFocusSet) {
                $('#phone').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_phone').hide();
        }

        if ($('#subject').val() == '') {
            isValid = false;
            $('#invalid_subject').show();
            if (!isFocusSet) {
                $('#subject').focus();
            }
        } else {
            $('#invalid_subject').hide();
        }

        if ($('#msgs').val() == '') {
            isValid = false;
            $('#invalid_msgs').show();
            if (!isFocusSet) {
                $('#msgs').focus();
            }
            isFocusSet = true;
        } else {
            $('#invalid_msgs').hide();
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