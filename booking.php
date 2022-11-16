<?php
require('lib/db.php');
require('lib/SPA.php');

@session_start();

$spa = new SPA($dbCon);

if(isset($_POST['tungay']))
{
	$tungay = substr($_POST['tungay'],6) . "-" . substr($_POST['tungay'],3,2) . "-" . substr($_POST['tungay'],0,2);
}

if(isset($_POST['denngay']))
{
	$denngay = substr($_POST['denngay'],6) . "-" . substr($_POST['denngay'],3,2) . "-" . substr($_POST['denngay'],0,2);
}

if (isset( $_POST['tugio']))
{
	$tugio = $_POST['tugio'];
}

if (isset( $_POST['dengio']))
{
	$dengio = $_POST['dengio'];
}

if ( !isset($tungay) )  $tungay = date('Y-m-d');//, strtotime('+30 minute'));
if ( !isset($denngay) ) $denngay = date('Y-m-d');
if ( !isset($tugio) ) 
{
	$datetime = date("Y-m-d H:i:s");
	$timestamp = strtotime($datetime);

	// Subtract time from datetime
	$time = $timestamp + 1800;

	$tugio = date("H:i", $time);

	//$tugio = date('H:i', strtotime('+30 minute'));// '00:00';
}
if ( !isset($dengio) ) $dengio = '23:59';

?>
<!DOCTYPE HTML>
<html>
<head>
<title>ZinSpa - Giải pháp quản lý spa chuyên nghiệp</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Phần mềm quản lý Spa ZinSPA">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Bootstrap Core CSS -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!-- jQuery -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	<div class="row" style="padding-top:10px !important;">
		<div class="col-md-12">
			<img src="images\golden_logo.png" width="194px" height="93px" style="padding-top:30px !important;" />
		</div>
	</div>
	<h1 class="wthree">VUI LÒNG ĐẶT LỊCH HẸN CHO CHÚNG TÔI</h1>
	<div class="login-section">
			<div class="login-form">			
					<div class="row">	
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="text" style="font-size: 16px !important;height: 32px !important; width: 80% !important;" name="tenkh" id="tenkh" placeholder="Tên" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="mail" style="font-size: 16px !important;height: 32px !important;width: 80% !important;" name="email" id="email" placeholder="Email" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="w3ls-icon">
								<input type="text" style="font-size: 16px !important;height: 32px !important;" name="phone" id="phone" placeholder="Phone" required />
							</div>
						</div>
						<div class="col-md-3">
							<div class="w3ls-icon">
								Số lượng
								<input type="number" style="font-size: 16px !important;width: 60px; height: 32px !important;" name="soluong" id="soluong" value="1" />
							</div>
						</div>
						<div class="col-md-3">
							<div class="w3ls-icon">
								Ngày
								<input type="date" style="font-size: 16px !important;height: 32px !important;" name="ngay" id="ngay" placeholder="Ngày" value="<?=$tungay?>" required />
							</div>
						</div>
						<div class="col-md-3">
							<div class="w3ls-icon">
								Giờ
								<input type="time" style="font-size: 16px !important;height: 32px !important;" name="gio" id="gio" placeholder="Giờ" value="<?=$tugio?>" required />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="w3ls-icon">
								<!--<input type="text" style="font-size: 16px !important;height: 32px !important;" name="dichvu" placeholder="Dịch vụ" /> -->
								<select name="dichvu" id="dichvu" style="font-size: 16px !important;height: 32px !important; width: 80% !important;">
<?php 
$hangban = ""; $manhomhb = ""; $total = 0;
$rshb = $spa->getDanhSachHangBan($hangban, $manhomhb);
if($rshb != false)
{
	//echo "lay danh sach hang:".count($rshb); //ok
	foreach ($rshb as $r)
	{
		?>
						<option value="<?php echo $r['MaHangBan'];?>"><?php echo $r['TenHangBan'];?></option>
		<?php
	}//end foreach ($rs_tt as $r)
}
?>
								<option value="" selected="selected">Dịch vụ (không bắt buộc)</option>
							</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="w3ls-icon">
								<!--<input type="text" style="font-size: 16px !important;height: 32px !important;width: 80% !important;" name="ghichu" placeholder="Ghi chú" /> -->
								<select name="nhanvien" id="nhanvien" style="font-size: 16px !important;height: 32px !important; width: 80% !important;">
<?php 
$nhanvien = ""; $manhomnv = ""; $chinhanh = "all"; $ktv = "1"; $total = 0;
$rsnv = $spa->getDanhSachNhanVien($nhanvien, $manhomnv, $ktv, $chinhanh);
if($rsnv != false)
{
	foreach ($rsnv as $r)
	{
		?>
						<option value="<?php echo $r['MaNV'];?>"><?php echo $r['TenNV'];?></option>
		<?php
	}//end foreach ($rsnv as $r)
}
?>
								<option value="" selected="selected">Kỹ thuật viên (không bắt buộc)</option>
							</select>								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="signin-rit">
							<div class="clear"> </div>
							</div>
							<button type="button" onclick="booking()" id="btnBooking" style="background-color:#5fb565;color: white;height: 40px;width: 120px;">Gửi đặt lịch</button>
						</div>
						<div class="col-md-4"></div>
					</div>
			</div>
	<!-- //login -->   
<script>
    function booking() {
            
        var tenkh = $("#tenkh").val();
        var mail = $("#email").val();
        var phone = $("#phone").val();
        var soluong = $("#soluong").val();
        var ngay = $("#ngay").val();
        var gio = $("#gio").val();
        var dichvu = $("#dichvu").val();
        var nhanvien = $("#nhanvien").val();

        //alert("cam on quy khach: " + tenkh + ",mail: " + mail + ",phone: " + phone + ",sl:" + soluong + ",ngay:" + ngay + ",gio:" + gio + ",dich vu:" + dichvu + ", ktv:" + nhanvien); //ok
                    
 		$.ajax({
      		url:"booking_update.php",
      		method:"POST",
      		data:{'tenkh':tenkh,'phone':phone,'mail':mail,'soluong':soluong,'ngay':ngay,'gio':gio,'dichvu':dichvu,'nhanvien':nhanvien},
      		dataType:"text",
      		success:function(output)
      		{
          		console.log('first ajax: ' + output);
      		},
      		complete: function() { 
          		console.log("complete");
      		}
      	});//ajax*/

        //var ajaxurl = 'booking_update.php',
        //data =  {'tenkh':tenkh,'phone':phone,'mail':mail,'soluong':soluong,'ngay':ngay,'gio':gio,'dichvu':dichvu,'nhanvien':nhanvien};
        //$.post(ajaxurl, data, function (response) {
        //});

        alert("Cảm ơn quý khách đã đặt lịch cho chúng tôi !!!");
    }
</script>   
		<div class="clear"></div>	
	</div> 	
	<div class="row" style="padding-top: 20px !important;"></div>
    <div class="footer">
		<p class="title" style="padding-top: 20px !important;">Designed by CÔNG TY TNHH GIẢI PHÁP CÔNG NGHỆ ZINTECH</h2>
        <p>Phone:02839310042 - Hotline: 078 622 8768</p>
        <p>Email:sales@zintech.vn</p>
        <p>Website:www.zintech.vn</p>
        </br>
     </div>
		<!--//login-->
</body>
</html>