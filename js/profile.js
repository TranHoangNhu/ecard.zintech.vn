var downContact = document.querySelector('#back-to-top');

function downloadCSV() {

/*var vCardText = "BEGIN:VCARD\n"
    + "VERSION:2.1\n" 
    + "N:test;test\n"
    + "FN:test test\n"
    + "ORG:ZINTECH\n"
    + "TITLE:Project Engineer\n"
    + "TEL;WORK:+32 (0)11 12 13 14\n"
    + "ADR;WORK:Industrielaan 1;2250 Olen;Belgium\n"
    + "EMAIL:link.com\n"
    + "URL:http://www.link.com\n"
    + "END:VCARD"; */ //ok
    //
    var tenkh = document.getElementById("tenkh").value;
    var dienthoai = document.getElementById("dienthoai").value;
    var didong = document.getElementById("didong").value;

    if(dienthoai == "" && didong != "") dienthoai = didong;

    var congty = document.getElementById("congty").value;
    var bophan = document.getElementById("bophan").value;
    var email = document.getElementById("email").value;
    var diachi = document.getElementById("diachi").value;
    var chucvu = document.getElementById("chucvu").value;

    var vCardText = "BEGIN:VCARD\n"
    + "VERSION:2.1\n" 
    + "N:" + tenkh + ";\n"
    + "FN:" + tenkh + "\n"
    + "ORG:" + congty + "\n"
    + "TITLE:" + chucvu + "\n"
    + "TEL;WORK:" + dienthoai + "\n"
    + "ADR;WORK:" + diachi + "\n"
    + "EMAIL:" + email + "\n"
    + "URL:http://www.zintech.vn\n"
    + "END:VCARD";

const encodeVcf = window.btoa(vCardText.toString());
console.log(encodeVcf);

    var base64 = "QkVHSU46VkNBUkQNClZFUlNJT046My4wDQpQUk9ESUQ6LS8vQXBwbGUgSW5jLi8vaVBob25lIE9TIDkuMi4xLy9FTg0KTjpaaW50ZWNoO0NvbXBhbnk7OzsNCkZOOiBaaW50ZWNoDQpPUkc6IGxlYWQgeW91ciBzb2x1dGlvbjsNClRFTDt0eXBlPVdPUks7dHlwZT1WT0lDRTt0eXBlPXByZWY6MDg1ODYyNjc2OA0KRU5EOlZDQVJEDQo="; //Creates CSV File Format
    //var vcf = "data:text/x-vcard;charset=utf-8;base64," + base64;
    var vcf = "data:text/x-vcard;charset=utf-8;base64," + encodeVcf; //ok
    var excel = encodeURI(vcf); //Links to vcf
    var link = document.createElement("a");
    link.setAttribute("href", excel); //Links to vcf File
    link.setAttribute("download", "contact.vcf"); //Filename that vcf is saved as
    link.click();
}

downContact.addEventListener("click", downloadCSV);