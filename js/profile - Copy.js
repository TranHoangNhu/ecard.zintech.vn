const downContact = document.querySelector('#back-to-top');

function downloadCSV() {
  const FirstName = document.getElementById('tenkh').value;
  const LastName = document.getElementById('bophan').value;
  const slogan = document.getElementById('bophan').value;
  const typePhone = "HOME"; //document.querySelector(".form-select").value;
  const phone = document.getElementById('dienthoai').value;
  const vcfStructure = `BEGIN:VCARD VERSION:3.0 
  PRODID:-//Apple Inc.//iPhone OS 9.2.1//EN
N:"+ ${LastName};${FirstName};;;   
FN: Zintech
ORG: ${slogan};
TEL;type=${typePhone};type=VOICE;type=pref:${phone}
END:VCARD
`;
  const vcfString = vcfStructure.toString();
  const encodeVcf = window.btoa(vcfString);
  console.log(downContact, FirstName, LastName, slogan, typePhone, phone);
  console.log(encodeVcf);
  const vcf = `data:text/x-vcard;charset=utf-8;base64,${encodeVcf}=`;
  console.log(vcf);

  const excel = encodeURI(vcf);
  //console.log("123");
  const link = document.createElement("a");
  //console.log("456");
  link.setAttribute("href", excel);
  //console.log("789");
  link.setAttribute("download", "contact.vcf");
  //console.log("012");
  link.click();
  //console.log("345");
}

downContact.addEventListener("click", downloadCSV);
