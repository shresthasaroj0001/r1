Dropzone.options.dropzoneForm = {
    maxFilesize: 3,
    parallelUploads: 1,
    acceptedFiles: "image/*",
    success: function (file, response) {
        console.log(response);
        if (response.isSuccess) {
            SuccessUpload(response.datas);
        }
    }
};
loadData();
var table;

function loadData() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#tokken').val()
        },
        url: window.location.href + "s",
        type: 'POST',
        success: function (datas) {
            //monthdatas = datas;
            // console.log(datas);
            table = $("#mytbl").DataTable({
                "data": datas,
                "searching": false,
                "info": false,
                "paging": false,
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                iDisplayLength: -1,
                "responsive": true,
                order: [3, "desc"],
                columnDefs: [
                    // { "targets": [3], "orderable": false },
                    // { "targets": [ 0 ], "visible": false }
                ],
                columns: [{
                        data: "title",
                        name: "title",
                        render: function (data) {
                            return "<img src='/uploads/" + data + "' alt='imgloading' width='150' height='150'>";
                        }
                    },
                    {
                        data: "isfeatureimg",
                        name: "isfeatureimg",
                        render: function (data) {
                            if (data) {
                                return "Yes";
                            } else {
                                return "No";
                            }
                        }
                    },
                    {
                        data: "stats",
                        name: "stats",
                        render: function (data) {
                            if (data) {
                                return "Active";
                            } else {
                                return "In-Active";
                            }
                        }
                    },
                    {
                        data: "orderb",
                        name: "orderb",
                    },
                    {
                        data: "id",
                        name: "id",
                        render: function (data) {
                            return "<button type='button' class='btn btn-danger action-delete' data-id='" + data + "'>Delete</button><button type='button' class='btn btn-primary edit-modal' data-id='" + data + "'>Edit</button>";
                        },
                    },
                ]
            });
        },
        error: function (eror) {

        },
        complete: function () {}
    }); //ajax ending
}

var rowId = 0;
var rowIdName, titlename;
$('#closeModalBtn').click(function () {
    var OrrderNo = $('#OrderNoId').val();
    var IsFeatureIMGS = $('#isFeatureImgs').val();
    var StatusO = $('#statsOption').val();

    if (parseInt(OrrderNo) <= 0) {
        alert("Validation Error");
        return false;
    }
    if (parseInt(IsFeatureIMGS) == 0 || parseInt(IsFeatureIMGS) == 1) {} else {
        alert("Validation Error");
        return false;
    }
    if (parseInt(StatusO) == 0 || parseInt(StatusO) == 1) {} else {
        alert("Validation Error");
        return false;
    }
    var obj = {
        id: rowId,
        title: titlename,
        isfeatureimg: IsFeatureIMGS,
        stats: StatusO,
        orderb: OrrderNo
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#tokken').val()
        },
        data: obj,
        url: window.location.href + "/" + rowId,
        type: 'PUT',
        beforeSend: function () {
            $("#modalsss").LoadingOverlay("show", {
                background: "rgba(165, 190, 100, 0.5)"
            });
            $("#modalsss").LoadingOverlay("show");
        },
        success: function (datas) {
            // console.log(datas);
            $("#modalsss").LoadingOverlay("hide");

            if (parseInt(datas) == 1) {
                table.row('#mytbl .' + rowIdName).remove().draw(false);
                table.row.add(obj).draw(false);

            } else {
                console.log("error");
            }
        },
        error: function (eror) {

        },
        complete: function () {
            $("#modalsss").LoadingOverlay("hide");
            $('#modal-overlays').modal('hide');
        },
    }); //ajax ending
});

function SuccessUpload(response) {
    table.row.add(response).draw(false);
}

$('#mytbl').on("click", ".edit-modal", function () {
    rowIdName = "";
    var datas = table.row($(this).closest('tr')).data();
    rowIdName = "rowid" + datas.id;
    $(this).closest('tr').addClass(rowIdName);

    rowId = parseInt($(this).attr("data-id"));
    $('#modal-overlays').modal('show');
    console.log(datas);

    rowId = datas.id;
    $('#OrderNoId').val(datas.orderb);
    $('#isFeatureImgs').val(datas.isfeatureimg);
    $('#statsOption').val(datas.stats);
    titlename = datas.title;
});


$('#mytbl').on("click", ".action-delete", function () {
    button = null;
    button = $(this);
    //(button.attr('rowid'));

    var result = confirm("Are You Sure You want to delete ?");
    if (result) {
        // rowIdName="";
        var datas = table.row($(this).closest('tr')).data();
        // rowIdName = "rowid" + datas.id;
        // $(this).closest('tr').addClass(rowIdName);

        var i = window.location.href + "/" + (button.attr('rowid'));
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('#tokken').val()
            },
            url: window.location.href + "/" + datas.id,
            type: 'Delete',
            beforeSend: function () {
                $('#closeModalBtn').attr("disabled");
                $('#closeModalBtn').prop("disabled", true);
            },
            success: function (ddata) {
                if (!(ddata)) {
                    alert('Internal Error');
                    return false;
                }

                if (parseInt(ddata) == 1) {
                    button.closest('tr').addClass('Row4Delete');
                    $('.Row4Delete').remove();
                }
            },
            complete: function () {
                $('#closeModalBtn').prop("disabled", false);
                $('#closeModalBtn').removeAttr("disabled");
            }
        });
    }
});
