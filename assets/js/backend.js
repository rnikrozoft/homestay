$(document).ready(function() {

    var id_check = $("#id-check").val();
    var pathname = window.location.pathname + "?id=" + id_check;

    if (pathname == "/homestay.dev/views/backend/homes-details.php?id=" + id_check || pathname == "/homestay.dev/views/backend/activities-details.php?id=" + id_check) {
        function randerChart(month, price, ctx) {
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: month,
                    datasets: [{
                        label: 'รายได้ตลอดทั้งเดือน',
                        data: price,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
        }

        var ctx = document.getElementById('report-content-top6');
        var month = jQuery.parseJSON($("#date-order").attr("data-month"));
        var price = jQuery.parseJSON($("#date-order").attr("data-price"));

        randerChart(month, price, ctx);

        $(".order").click(function() {
            var name = $(this).attr("name");
            var ctx = "report-content";

            if (name == "acts") {
                var data_find_month = {
                    mode: "acts",
                    findDateForList: true,
                    acID: $(this).val(),
                };
                $("#id").val($(this).val()); //use in modal#report-modal
            } else if (name == "rooms") {
                var data_find_month = {
                    mode: "rooms",
                    findDateForList: true,
                    hmID: $(this).val(),
                };
                $("#id").val($(this).val()); //use in modal#report-modal
            }

            $("#year").attr("name", name);

            $.ajax({
                type: "POST",
                url: "../../routes/backend/route-report.php",
                data: data_find_month,
                success: function(data) {
                    var result = jQuery.parseJSON(data);
                    $('#year').find('option').remove();
                    $('#year').append('<option value="0">เลือกปี</option>');

                    $.each(result, function(value, value) {
                        $('#year').append($("<option></option>").attr("value", value).text(value));
                    });
                }
            });
            $("#report-modal").modal("show");
            $("#report-modal").on('shown.bs.modal', function() {
                $("#year").on("change", function() {
                    var year_value = $(this).val();
                    var name = $(this).attr("name");

                    if (name == "acts") {
                        var mode = "acts";
                    } else if (name == "rooms") {
                        var mode = "rooms";
                    }

                    $.ajax({
                        type: "POST",
                        url: "../../routes/backend/route-report.php",
                        data: {
                            mode,
                            render: true,
                            year_value,
                            id: $("#id").val()
                        },
                        success: function(res) {
                            var result = jQuery.parseJSON(res);
                            var month = [];
                            var price = [];
                            for (i = 0; i < result.length; i++) {
                                month[i] = result[i].month;
                                price[i] = result[i].price;
                            }
                            randerChart(month, price, ctx);
                        }
                    });
                });
            });
        });
    }

    function readURL(input, modalID) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#img-preview" + modalID + "," + "#img-preview-room" + modalID).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file-add,#file-edit,#file-add-room,#file-edit-room").change(function() {
        var modalID = $(this).attr("modal-id");
        readURL(this, modalID);
    });

    // member
    $("#edit-members").on("hidden.bs.modal", function() {
        $("#file-edit").val("");
    });

    $(".edit").click(function() {
        var name = $(this).attr("name");
        var data_array = $(this).attr("data");
        var data = JSON.parse(decodeURIComponent(data_array));

        if (name == "member") {

            $("#defaultID").val(data["ID"]);
            $("#defaultImg").val(data["IMG"]);

            $("#id").val(data["ID"]);
            $("#tel").val(data["TEL"]);
            $("#prefix").val(data["PREFIX"]);
            $("#fname").val(data["FNAME"]);
            $("#lname").val(data["LNAME"]);

            $("#img-preview").attr("src", "../../assets/img/members/" + data["IMG"]);

            $("#edit-members").modal("show");
        } else if (name == "room") {

            $("#defaultID").val(data["ID"]);
            $("#defaultImg").val(data["IMG"]);

            $("#name").val(data["NAME"]);
            $("#price").val(data["PRICE"]);
            $("#qty").val(data["QTY"]);
            $("#detail").val(data["DETAIL"]);
            $("#note").val(data["NOTE"]);

            $("#img-preview-room").attr("src", "../../assets/img/rooms/" + data["IMG"]);

            $("#edit-rooms").modal("show");
        }

    });

    //delete
    $(".del").click(function() {
        var name = $(this).attr("name");

        if (name == "member") {
            var url = "../../routes/backend/route-members.php";
            var locationReturn = "members.php";
            var ajaxdata = {
                members: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "homes") {
            var url = "../../routes/backend/route-homes.php";
            var locationReturn = "homes.php";
            var ajaxdata = {
                homes: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "room") {
            var url = "../../routes/backend/route-homes.php";
            var locationReturn = "homes-details.php?id=" + $(this).attr("home-id");
            var ajaxdata = {
                rooms: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "img-home") {
            var url = "../../routes/backend/route-img.php";
            var locationReturn = "homes-details.php?id=" + $(this).attr("home-id");
            var ajaxdata = {
                home: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "acts") {
            var url = "../../routes/backend/route-acts.php";
            var locationReturn = "activities.php";
            var ajaxdata = {
                acts: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "img-acts") {
            var url = "../../routes/backend/route-img.php";
            var locationReturn = "activities-details.php?id=" + $(this).attr("acts-id");
            var ajaxdata = {
                acts: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "atts") {
            var url = "../../routes/backend/route-atts.php";
            var locationReturn = "attractions.php";
            var ajaxdata = {
                atts: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "img-atts") {
            var url = "../../routes/backend/route-img.php";
            var locationReturn = "attractions-details.php?id=" + $(this).attr("atts-id");
            var ajaxdata = {
                atts: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "prod") {
            var url = "../../routes/backend/route-prod.php";
            var locationReturn = "products.php";
            var ajaxdata = {
                products: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "img-prod") {
            var url = "../../routes/backend/route-img.php";
            var locationReturn = "products-details.php?id=" + $(this).attr("prod-id");
            var ajaxdata = {
                prod: true,
                delete: true,
                id: $(this).val()
            };
        } else if (name == "customer") {
            var url = "../../routes/backend/route-customers.php";
            var locationReturn = "customers.php";
            var ajaxdata = {
                customers: true,
                delete: true,
                id: $(this).val()
            };
        }

        Swal.fire({
            title: "ยืนยันการลบข้อมูลนี้",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#5e72e4',
            cancelButtonColor: '#f5365c',
            confirmButtonText: 'ตกลง',
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: ajaxdata,
                    success: function() {
                        Swal.fire(
                            'สำเร็จ',
                            'ลบข้อมูลออกจากระบบเรียบร้อย',
                            'success'
                        ).then((value) => {
                            window.location.href = "" + locationReturn + "";
                        });
                    }
                });
            }
        });
    });

    //drop
    $(".drop").click(function() {
        var name = $(this).attr("name");

        if (name == "member") {
            var url = "../../routes/backend/route-members.php";
            var locationReturn = "members.php";
            var ajaxdata = {
                members: true,
                drop: true
            };
        } else if (name == "homes") {
            var url = "../../routes/backend/route-homes.php";
            var locationReturn = "homes.php";
            var ajaxdata = {
                homes: true,
                drop: true
            };
        } else if (name == "room") {
            var url = "../../routes/backend/route-homes.php";
            var locationReturn = "homes-details.php?id=" + $(this).attr("home-id");
            var ajaxdata = {
                rooms: true,
                drop: true
            };
        } else if (name == "img-home") {
            var url = "../../routes/backend/route-img.php";
            var locationReturn = "homes-details.php?id=" + $(this).val();
            var ajaxdata = {
                home: true,
                drop: true,
                id: $(this).val()
            };
        } else if (name == "acts") {
            var url = "../../routes/backend/route-acts.php";
            var locationReturn = "activities.php";
            var ajaxdata = {
                acts: true,
                drop: true
            };
        } else if (name == "img-acts") {
            var url = "../../routes/backend/route-img.php";
            var locationReturn = "activities-details.php?id=" + $(this).val();
            var ajaxdata = {
                acts: true,
                drop: true,
                id: $(this).val()
            };
        } else if (name == "atts") {
            var url = "../../routes/backend/route-atts.php";
            var locationReturn = "attractions.php";
            var ajaxdata = {
                atts: true,
                drop: true
            };
        } else if (name == "img-atts") {
            var url = "../../routes/backend/route-img.php";
            var locationReturn = "attractions-details.php?id=" + $(this).val();
            var ajaxdata = {
                atts: true,
                drop: true,
                id: $(this).val()
            };
        } else if (name == "prod") {
            var url = "../../routes/backend/route-prod.php";
            var locationReturn = "products.php";
            var ajaxdata = {
                products: true,
                drop: true
            };
        } else if (name == "img-prod") {
            var url = "../../routes/backend/route-img.php";
            var locationReturn = "products-details.php?id=" + $(this).val();
            var ajaxdata = {
                prod: true,
                drop: true,
                id: $(this).val()
            };
        } else if (name == "customer") {
            var url = "../../routes/backend/route-customers.php";
            var locationReturn = "customers.php";
            var ajaxdata = {
                customers: true,
                drop: true
            };
        }

        Swal.fire({
            title: "ยืนยันการลบข้อมูลทั้งหมด",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#5e72e4',
            cancelButtonColor: '#f5365c',
            confirmButtonText: 'ตกลง',
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: ajaxdata,
                    success: function() {
                        Swal.fire(
                            'สำเร็จ',
                            'ลบข้อมูลออกจากระบบเรียบร้อย',
                            'success'
                        ).then((value) => {
                            window.location.href = "" + locationReturn + "";
                        });
                    }
                });
            }
        });
    });

    $(".save").click(function() {
        var type = $(this).attr("type");
        if (type == "button") {
            $(this).html("บันทึกข้อมูล").attr("name", "update").removeClass("btn-warning").addClass("btn-success").attr("type", "submit");
            $("form#acts :input,form#atts :input,form#prod :input,form#homes :input").each(function() {
                $(this).removeAttr("disabled");
            });
            return false;
        }

    });

    // acts,atts validate select date
    $("#acts,#atts").on("submit", function() {
        if ($("#mn").prop("checked") == true || $("#tu").prop("checked") == true || $("#wd").prop("checked") == true || $("#th").prop("checked") == true || $("#fi").prop("checked") == true || $("#sa").prop("checked") == true || $("#su").prop("checked") == true) {
            return true;
        } else {
            alert("กรุณาเลือกวันที่เปิดให้บริการอย่างน้อย 1 วัน");
            return false;
        }
    });

    //send products
    $(".send").click(function() {
        Swal.fire({
            title: 'ยืนยันการจัดส่งสินค้า',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "../../routes/backend/route-sendProducts.php",
                    data: {
                        orderID: $(this).val()
                    },
                    success: function() {
                        Swal.fire({
                            title: 'สำเร็จ',
                            type: 'success',
                            timer: 1000,
                            showConfirmButton: false
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });

    //dashboard backend
    $(".end").click(function() {
        Swal.fire({
            title: 'ยืนยัน',
            text:'สิ้นสุดการเข้าพักหรือไม่ ?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "../../routes/backend/route-endRooms.php",
                    data: {
                        cmID: $(this).attr("cmID"),
                        rmID: $(this).attr("rmID"),
                        datesave: $(this).attr("datesave")
                    },
                    success: function() {
                        Swal.fire({
                            title: 'สำเร็จ',
                            type: 'success',
                            timer: 1000,
                            showConfirmButton: false
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
});