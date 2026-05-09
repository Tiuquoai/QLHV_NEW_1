// JavaScript source code
function KiemtraTendn() {
    var ten = document.getElementById("textTendn").value;
    var regten = /^([A-Z]{1}[a-z]*\s)*([A-Z]{1}[a-z]*)$/;
    if (regten.test(ten)) {
        document.getElementById("Ten").innerHTML = "(*)";
    }
    else {
        document.getElementById("Ten").innerHTML = "Nhập sai!!!";
    }
}
function KiemtraMK() {
    var mk = document.getElementById("textMk").value;
    var regmk = /^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[@#$&-_]).{6,}$/;
    if (regmk.test(mk)) {
        document.getElementById("KTMK").innerHTML = "(*)";
    }
    else {
        document.getElementById("KTMK").innerHTML = "Mật khẩu sai!!!";
    }
}
function KiemtraNLMK() {
    var mk1 = document.getElementById("textMk").value;
    var mk2 = document.getElementById("textNLMK").value;
    if (mk1 == mk2) {
        document.getElementById("testlaiMK").innerHTML = "(*)";
    }
    else {
        document.getElementById("testlaiMK").innerHTML = "Mật khẩu không khớp!!!";
    }
}
function KtraNS() {
    var ns = new Date(document.getElementById("KTNS").value);
    if (ns.getFullYear() <= 2001) {
        document.getElementById("NS").innerHTML = " ";
    }
    else {
        document.getElementById("NS").innerHTML = "Năm sinh < 2002";
    }
}
function KTDT() {
    var dt = document.getElementById("KTrDT").value;
    var regdt = /([0]){1}([1-9]){8,9}$/;
    if (regdt.test(dt)) {
        document.getElementById("DT").innerHTML = "(*)";
    }
    else {
        document.getElementById("DT").innerHTML = "SDT phải từ 9-10 số";
    }
}
function ktmail() {
    var mail = document.getElementById("ktemail").value;
    var regmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (regmail.test(mail)) {
        document.getElementById("mail").innerHTML = "(*)";
    }
    else {
        document.getElementById("mail").innerHTML = "Email không hợp lệ";
    }
}
function KtrDC() {
    var diachi = document.getElementById("KTDC").value;
    if (diachi != "") {
        document.getElementById("DC").innerHTML = "(*)";
    }
    else {
        document.getElementById("DC").innerHTML = "Địa chỉ sai!!!";
    }
}
function DT() {
    var dt = document.getElementById("KTDT").value;
    var regdt = /([0]){1}([1-9]){8,9}$/;
    if (regdt.test(dt)) {
        document.getElementById("DT1").innerHTML = "(*)";
    }
    else {
        document.getElementById("DT1").innerHTML = "SDT phải từ 9-10 số";
    }
}
function MK() {
    var mk = document.getElementById("tMk").value;
    var regmk = /^(?=.*[A-Za-z])(?=.*[0-9])(?=.*[@#$&-_]).{6,}$/;
    if (regmk.test(mk)) {
        document.getElementById("MK").innerHTML = "(*)";
    }
    else {
        document.getElementById("MK").innerHTML = "Mật khẩu sai!!!";
    }
}

