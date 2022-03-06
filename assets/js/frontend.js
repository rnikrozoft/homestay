$(document).ready(function() {
    var id_check = $("#id-check-acName").val();
    var pathname = window.location.pathname + "?id=" + id_check;

    if (pathname == "/homestay.dev/views/frontend/activitie-details.php?id=" + id_check) {
        var date_split = $("#date-enabled").val().split(" ");
        var d = new Array(
            "อาทิตย์",
            "จันทร์",
            "อังคาร",
            "พุธ",
            "พฤหัสฯ",
            "ศุกร์",
            "เสาร์"
        );
        for (j = 0; j < d.length; j++) {
            for (i = 0; i < date_split.length; i++) {
                if (d[j] == date_split[i]) {
                    d[j] = "";
                    continue;
                }
            }
        }
        var datesDisabled = []; //[]
        var index = 0;
        for (i = 0; i < d.length; i++) {
            if (d[i] != "") {
                datesDisabled[index++] = i;
            }
        }

        $("#in-acts").datepicker("destroy");
        $("#in-acts").datepicker({
            format: "yyyy-mm-dd",
            startDate: "toDay",
            daysOfWeekDisabled: datesDisabled
        });

        $("#form-selected-acts").on("submit", function() {

            if ($("#form-selected-acts #in-acts").val() != "") {
                $.ajax({
                    type: "POST",
                    url: "../../routes/frontend/route-setData.php",
                    data: {
                        acts: true,
                        set: true,
                        acID: $("#acID").val(),
                        acTime: $("#id-check-acTime").val(),
                        date: $("#in-acts").val()
                    },
                    success: function(data) {
                        if (data == "found") {
                            var title = 'คุณมีกิจกรรมอื่นในช่วงเวลานี้แล้ว';
                            var type = "warning";
                            var href = "history-tour.php";
                        } else {
                            var title = 'เพิ่มลงแผนทัวร์ของคุณแล้ว';
                            var type = "success";
                            var href = "plans.php";
                        }
                        Swal.fire({
                            title: title,
                            text: 'ต้องการดูแผนทัวร์ของคุณหรือไม่ ?',
                            type: type,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ใช่,ฉันต้องการดูแผนทัวร์ของฉัน',
                            cancelButtonText: 'ไว้ทีหลัง'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = href;
                            } else {
                                window.location.href = "activities.php";
                            }
                        });
                    }
                });
                return false;
            } else {
                alert("กรุณาเลือกวันที่ที่จะเข้าร่วมกิจกรรม");
                return false;
            }
        });
    }

    $("#select-room-list").on("change", function() {
        if ($(this).val() != 0) {
            $("#in,#out").val("");
            $("#in,#out").removeAttr("disabled");
            var roomID = $(this).val();
            $.ajax({
                type: "POST",
                url: "../../routes/frontend/route-freeDay.php",
                data: {
                    roomID: roomID
                },
                success: function(res) {
                    var data = jQuery.parseJSON(res);
                    $("#in,#out").datepicker("destroy");
                    $("#in,#out").datepicker({
                        format: "yyyy-mm-dd",
                        startDate: "toDay",
                        datesDisabled: data
                    });
                }
            });

        } else {
            $("#in,#out").val("");
            $("#in,#out").attr("disabled", true);
        }
    });

    $("#form-selected-room").on("submit", function() {
        var checkIn = $("#form-selected-room #in").val();
        var checkOut = $("#form-selected-room #out").val();

        if (checkIn == "" && checkOut == "") {
            alert("โปรดกรอกข้อมูลให้ครบถ้วน");
            return false;
        }
        if (checkIn == "") {
            alert("โปรดกรอกข้อมูลวันที่เช็คอิน");
            return false;
        }
        if (checkOut == "") {
            alert("โปรดกรอกข้อมูลวันที่เช็คเอ้าท์");
            return false;
        }

        if (checkIn > checkOut) {
            alert("วันที่เช็คอินต้องน้อยกว่าวันที่เช็คเอ้าท์");
            return false;
        }
    });

    $(".del-list").click(function() {
        if ($(this).attr("name") == "rooms") {
            var data = {
                rooms: true,
                delete: true
            };
            var text = "คุณต้องการเลือกดูบ้านพักอื่นๆหรือไม่ ?";
            var href = "../../views/frontend/index.php";
        } else if ($(this).attr("name") == "acts") {
            var data = {
                acts: true,
                delete: true,
                acID: $(this).attr("id"),
                date: $(this).attr("date")
            };
            var text = "คุณต้องการเลือกดูกิจกรรมอื่นๆหรือไม่ ?";
            var href = "../../views/frontend/activities.php";
        } else if ($(this).attr("name") == "prod") {
            var data = {
                prod: true,
                delete: true,
                pdID: $(this).val()
            };
            var text = "คุณต้องการเลือกสินค้าอื่นๆหรือไม่ ?";
            var href = "../../views/frontend/products.php";
        }

        Swal.fire({
            title: 'ยืนยันการลบข้อมูล',
            text: 'ต้องการลบข้อมูลนี้ของคุณหรือไม่ ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่,ฉันต้องการ',
            cancelButtonText: 'ไม่'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "../../routes/frontend/route-setData.php",
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            title: 'สำเร็จ ลบข้อมูลเรียบร้อย',
                            text: text,
                            type: 'success',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ใช่,ฉันต้องการ',
                            cancelButtonText: 'ไม่'
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = href;
                            } else {
                                location.reload();
                            }
                        });
                    }
                });
            }
        });
    });


    //products
    $("#form-selected-prod").on("submit", function() {
        // var checkIn = $("#form-selected-room #in").val();
        $.ajax({
            type: "POST",
            url: "../../routes/frontend/route-setData.php",
            data: {
                prod: true,
                set: true,
                id: $("#pdID").val(),
                qty: $("#qty").val()
            },
            success: function(data) {
                Swal.fire({
                    title: 'เพิ่มสินค้าลงตะกร้าเรียบร้อย',
                    text: 'ต้องการดูตะกร้าสินค้าหรือไม่ ?',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่,ฉันต้องการ',
                    cancelButtonText: 'ไม่,เลือกสินค้าอย่างอื่นก่อน'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'cart.php';
                    } else {
                        window.location.href = 'products.php';
                    }
                });
            }
        });
        return false;
    });

    $(".edit-address").click(function() {
        var data_str = $(this).attr("data");
        var data = JSON.parse(decodeURIComponent(data_str));

        $("#defaultID").val(data["ID"]);
        $("#homeID").val(data["HouseNo"]);
        $("#moo").val(data["Moo"]);
        $("#road").val(data["Road"]);
        $("#alley").val(data["IAlleyD"]);
        $("#vname").val(data["VillageName"]);
        $("#subDistrict").val(data["SubDistrict"]);
        $("#district").val(data["District"]);
        $("#province").val(data["Province"]);
        $("#zipcode").val(data["Zipcode"]);
        $("#edit-address").modal("show");
    });

    $(".del-address").click(function() {
        var id = $(this).val();
        Swal.fire({
            title: 'ยืนยันการลบข้อมูล',
            text: 'คุณต้องการลบข้อมูลนี้หรือไม่ ?',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่,ฉันต้องการ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "../../routes/frontend/route-address.php",
                    data: {
                        address: true,
                        delete: true,
                        id: id
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'สำเร็จ ลบข้อมูลเรียบร้อย',
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

    $("#edit-information").on("submit", function() {
        Swal.fire({
            title: 'ยืนยันการแก้ไขข้อมูล',
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "../../routes/frontend/route-authentications.php",
                    data: {
                        update: true,
                        id: $("#id").val(),
                        fname: $("#fname").val(),
                        lname: $("#lname").val(),
                        tel: $("#tel").val(),
                        email: $("#email").val(),
                    },
                    success: function(data) {
                        Swal.fire({
                            title: 'แก้ไขข้อมูลเรียบร้อย',
                            type: 'success',
                        }).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
        return false;
    });

    $(".like").click(function() {
        var name = $(this).attr("name");
        var id = $(this).attr("id");

        if (name == "rooms") {
            var data = {
                rooms: true,
                rmID: $(this).attr("id")
            }
        } else if (name == "acts") {
            var data = {
                activities: true,
                acID: $(this).attr("id")
            }
        } else if (name == "atts") {
            var data = {
                attractions: true,
                atID: $(this).attr("id")
            }
        } else if (name == "prod") {
            var data = {
                prod: true,
                pdID: $(this).attr("id")
            }
        }


        $.ajax({
            type: "GET",
            url: "../../routes/frontend/route-like.php",
            data: data,
            success: function(data) {
                $("#" + id).html(data + " &nbsp;<i class='far fa-thumbs-up'></i>");
            }
        });
    });

});