// JavaScript source code

//Họ và tên
function a() {
    var a = document.getElementById("a1").value;
    var rega = /^([A-Z]{1}[a-z]*\s)*([A-Z]{1}[a-z]*\s)*([A-Z]{1}[a-z]*)$/;
    if (rega.test(a)) {
        document.getElementById("a2").innerHTML = " ";
    }
    else {
        document.getElementById("a2").innerHTML = "Tên sai!!!";
    }

}

//Mã sản phẩm 123-24567

function b() {
    var b = document.getElementById("b1").value;
    var regb = /([0-9]{3,3}-){1}([0-9]{5}){1}/;
    if (regb.test(b)) {
        document.getElementById("b2").innerHTML = " ";
    }
    else {
        document.getElementById("b2").innerHTML = "Mã sai!!!";
    }

}

//Ngày đặt hàng
$(document).ready(function () {
    $("#c1").blur(function () {
        var nd = new Date($("#c1").val());
        var nht = new Date();
        var tg = nd.getTime() - nht.getTime();
        var ngay = Math.round(tg / (1000 * 60 * 60 * 24));
        if (ngay == 0) {
            $("#c2").html(" ");
        }
        else {
            $("#c2").html("Ngày đặt phải là ngày hiện tại!!!");
        }
    })
})




//Ngày nhận hàng

$(document).ready(function () {
    $("#f1").blur(function () {
        var nn = new Date($("#f1").val());
        var nd = new Date($("#c1").val());
        var tg = nn.getTime() - nd.getTime();
        var ngay = Math.round(tg / (1000 * 60 * 60 * 24));
        if (ngay > 0) {
            $("#f2").html(" ");
        }
        else {
            $("#f2").html("Ngày nhận phải sau ngày đặt!!!");
        }
    })
})

//Số điện thoại

function g() {
    var g = document.getElementById("g1").value;
    var regg = /[0]([0-9]){9}/;
    if (regg.test(g)) {
        document.getElementById("g2").innerHTML = " ";
    }
    else {
        document.getElementById("g2").innerHTML = "Số điện thoại gồm 10 số!!!";
    }

}

//Địa chỉ nhà

function h() {
    var h = document.getElementById("h1").value;
    if (h != "") {
        document.getElementById("h2").innerHTML = " ";
    }
    else {
        document.getElementById("h2").innerHTML = "Địa chỉ không dc bỏ trống!!!";
    }

}

//Chèn xuống
$(document).ready(function () {
 
    var count = 1;
    $("#s").click(function () {
        var ten, ma, nd, sp1, gia1, nn, sdt, dc, pt1, pvc, tt;
        ten = $("#a1").val();
        ma = $("#b1").val();
        nd = $("#c1").val();
        sp = $("#d1 option:selected").val();
        sp1 = sp.substring(8, sp.length);
        gia = $("#e1").val();
        gia1 = sp.substring(0, 8);
        nn = $("#f1").val();
        sdt = $("#g1").val();
        dc = $("#h1").val();
        pt = $("input[type='radio']:checked").val();
        pt1 = pt.substring(0, 12);
        pvc = pt.substring(12, 16);
        tt = $("#l1").val();
        tt1 = parseInt(gia1) +(parseInt(pvc) * gia1)/100;

        var cm = "<tr><td>" + count + "</td><td>" + ten + "</td><td>" + ma + "</td><td>" + nd + "</td><td>" + sp1 + "</td><td>"
        + gia1 + "</td><td>" + nn + "</td><td>" + sdt + "</td><td>" + dc + "</td><td>" + pt1 + "</td><td>" + pvc + "</td><td>"
        + tt1 + "</td></tr>"
        $("#ds").append(cm);
        count++;
    })
})