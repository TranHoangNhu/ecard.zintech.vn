<?php
  //
  // define here all the variable like $name,$image,$company_name & all other
  header('Content-Type: text/x-vcard');  
  header('Content-Disposition: inline; filename= "'.$stt.'.vcf"');  

  if($image!=""){ 
    $getPhoto               = file_get_contents($image);
    $b64vcard               = base64_encode($getPhoto);
    $b64mline               = chunk_split($b64vcard,74,"\n");
    $b64final               = preg_replace('/(.+)/', ' $1', $b64mline);
    $photo                  = $b64final;
  }
  $vCard = "BEGIN:VCARD\r\n";
  $vCard .= "VERSION:3.0\r\n";
  $vCard .= "FN:" . $tenkh . "\r\n";
  $vCard .= "TITLE:" . $congty . "\r\n";

  if($email){
    $vCard .= "EMAIL;TYPE=internet,pref:" . $email . "\r\n";
  }

  if($getPhoto){
    $vCard .= "PHOTO;ENCODING=b;TYPE=JPEG:";
    $vCard .= $photo . "\r\n";
  }

  if($dienthoai){
    $vCard .= "TEL;TYPE=work,voice:" . $dienthoai . "\r\n"; 
  }

  $vCard .= "END:VCARD\r\n";
  echo $vCard;

?>