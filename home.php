<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');
require('functions/lichsuphieu.php');
require_once('helper/custom-functions.php');

@session_start();   

$stt = $_SESSION['Stt'];
$tenkh = $_SESSION['TenKH'];
//
//------------xu ly lay thong tin user show len eCard ---------------------//
//
$makh = ""; $tenkh = ""; $dienthoai = ""; $diachi = ""; $email = ""; 
$didong = ""; $congty = ""; $bophan = ""; $chucvu = ""; $urlecard = "";
$username = ""; $matkhau = ""; $image = ""; $website = ""; $urlQR = "";
$website1 = ""; $website2 = ""; $website3 = "";
//
if($stt != "")
{
    $l_sql="select a.* from tblKhachHangECard a Where a.Stt like '$stt'";
    try
    {
        $rs=$conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);
        if($rs !== false)
        {
            foreach($rs as $r)
            {
                $r['MaKH'];$r['TenKH']; $r['DienThoai']; $r['DiDong']; $r['DiaChi'];
                $r['Email']; $r['CongTy']; $r['BoPhan']; $r['ChucVu']; $r['UrlECard'];
                $r['Username']; $r['MatKhau'];

                $makh = $r['MaKH']; $tenkh = $r['TenKH']; $email = $r['Email'];
                $dienthoai = $r['DienThoai'];  $didong = $r['DiDong']; $diachi = $r['DiaChi'];
                $congty = $r['CongTy']; $bophan = $r['BoPhan']; $chucvu = $r['ChucVu'];
                $urlecard = $r['UrlECard']; $username = $r['Username']; $matkhau = $r['MatKhau'];
            }
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}
//
if($urlecard != "")
{
    $urlQR = $urlecard."login_action.php?username=".$username."&password=".$matkhau;
}
//
//
$showqr = 0;
if(isset($_POST['showqr']))
{
    $showqr = $_POST['showqr'];
    //echo "show qr".$showqr; //ok
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="shortcut icon"
      type="image/jpg"
      href="https://cdn.glitch.com/d08bb326-e251-4744-9266-f454d653c7c1%2Ffavicon.png?v=1624373448629"
    />
    <link rel="stylesheet" href="css/profile/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/qr/font.css" />
    <link rel="stylesheet" href="css/qr/style.css" />
</head>
<style type="text/css">
@media (max-width: 400px) {
    .hidden-mobile {
       display: none;
    }
}
    /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
@media (min-width:768px) {
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 30px;
    border: 1px solid #888;
    width: 400px;
    }
}

@media (min-width:400px) and (max-width: 768px) {
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 25px;
    border: 1px solid #888;
    width: 400px;
    }
}

@media (max-width:400px) {
  .modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 8px;
    border: 1px solid #888;
    width: 360px;
    }
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
<body>
<!--                                  The Modal 1 : thong tin qr                     -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h4 class="hidden-mobile">YOUR QR:</h4>
      <p>
            <input type="hidden" name="stt" value="<?php echo @$stt; ?>" style="width:100%;">
            <input type="hidden" name="urlQR" id="urlQR" value="<?php echo @$urlQR; ?>" style="width:100%;">
      </p>
      <p style="text-align:center !important;">
        
            
        </p>
      <p style="padding-top:20px;"></p>
  </div>
</div>

<?php

if($showqr == 1) 
{
    $showqr = 0;
?>
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        modal.style.display = "block";

        span.onclick = function() {
            modal.style.display = "none";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            }
        }
    </script>
<?php

}//end if

?>
<!--                          END THE MODAL 1                         -->

	<div class="row" style="padding-top:0px !important;">
	   <div class="col-md-12" style="background-color: #fff !important; padding-top: 0px !important;">
            <?php include 'profile2.php'; ?>
	   </div>
	   <!-- /#col-md-12 -->
	</div>
</body>
</html>
