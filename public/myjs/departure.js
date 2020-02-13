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
        $('#headingss').html('Update Rate For Tour Time: '+datees);
        
        // console.log(datees);
    });
    // $('#modal-overlays').modal('show');

    function rateinputDivShow() {
        $("#addtime").attr("disabled", true);
        $("#addtime").prop("disabled", true);
        // $('#rateinputDiv').show();
        $(".moneyValidator").val('');
        // $("#noOfAvailable").val('');
        $('#modal-overlays').modal('show');
    }

    $('#modal-overlays').on('keyup', ".moneyValidator", function (event) {
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
        var Isvalid = true;
        $('#feeratetbl tbody tr').each(function () {
            var tds = $(this).find('input');

            if (tds != null) {
                var tdsid = tds[0]['id'];

                if(tds[0].value != null){
                    var r = $.trim(tds[0].value);
                    if(r.length <= 0){
                        Isvalid = false;
                        return false;
                    }
                    
                }
               
            }
        });

        return Isvalid;
    }

    var tempi="<tr><th>Time</th>";
    $('#feeratetbl tbody tr').each(function () {
        var tds = $(this).find('input');
        if (tds != null) {
            var tdsname = tds[0]['name'];
            tempi+="<th>"+tdsname+"</th>";
        }
    });
    tempi+="<th>Action</th>";
    $('#dataTbl_head').html(tempi);

    var TimeSelected = [];
    $('#addTOlistBtn').click(function () {
        var r = validateRateInput();
        if (!r) {
            alert('All Fields Are Mandatory');
            return false;
        }

        var size=0;
        var ls=[];
        $('#feeratetbl tbody tr').each(function () {
            var tds = $(this).find('input');
            if (tds != null) {
                var tdsid = tds[0]['id'];
                if(tds[0].value != null){
                    var r = $.trim(tds[0].value);
                    var rates = parseFloat(r).toFixed(2);
                    var a = {"name":tds[0]['name'], "id": parseInt(tdsid), "rates":rates};
                    ls.push(a);
                    size += 1;
                }
            }
        });
        //console.log(ls);
        TimeSelected.push({ "ddata" : ls, "Time": TimePickerValue, "mId":menuId})
        // $('#rateinputDiv').hide();
        $('#modal-overlays').modal('hide');
        $('#timepicker1').timepicker('setTime', '');
        $("#addtime").prop("disabled", false);
        $("#addtime").removeAttr("disabled");

        RefreshTimeList();
        console.log(TimeSelected);
    });

    function RefreshTimeList() {
        var i = "";
        $("#dataTbl").empty();

        TimeSelected.forEach(function (item, index, array) {
            var items = item.ddata;
            i += "<tr><td>" + item.Time + "</td>";
            items.forEach(function (iteme, indexx, array) {
                i+="<td>"+iteme.rates+"</td>";
            });
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

    // console.log(window.location.href);

    $('#finalsubmitbtn').click(function () {
        if (TimeSelected.length > 0) {

            $.ajax(
                {
                    url: window.location.href,
                    headers: {'X-CSRF-TOKEN': $('#tooken').val() },
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    data:JSON.stringify({"TimeSelected":TimeSelected, "selectedDates":selectedDates}),
                    beforeSend:function(){
                        $("#finalsubmitbtn").attr("disabled", true);
                        $("#finalsubmitbtn").prop("disabled", true);
                    },
                    success: function (datas) {
                        if(parseInt(datas)==1){
                            alert("Success");
                        }else{
                            alert("Error.. Please Report us");
                        }
                        location.reload(true);
                    },
                    complete: function () { 
                        $("#finalsubmitbtn").prop("disabled", false); 
                        $("#finalsubmitbtn").removeAttr("disabled");
                    },
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
