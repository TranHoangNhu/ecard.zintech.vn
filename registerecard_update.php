<?php 
require('lib/db.php');
require('lib/SPA.php');

@session_start();

$tenkh = ""; $phone = ""; $email = ""; $address = ""; $company = ""; $department = ""; $position ="";
//
//
$spa1 = new SPA($dbCon); 
//
//-------debug 1: check khai bao nhan vien , hang ban: ok
//
if(isset($_POST['tenkh']))
{
    $tenkh = $_POST['tenkh'];
}

if(isset($_POST['phone']))
{
    $phone = $_POST['phone'];
}

if(isset($_POST['email']))
{
    $email = $_POST['email'];
}

if(isset($_POST['address']))
{
    $address = $_POST['address'];
}

if(isset($_POST['company']))
{
    $company = $_POST['company'];
}

if(isset($_POST['department']))
{
    $department = $_POST['department'];
}

if(isset($_POST['position']))
{
    $position = $_POST['position'];
}
//
if($tenkh != "")
{
    $matrungtam = "01";
    //
    $hientai = date('Y-m-d H:i:s');
    //
    $year = substr($hientai,0,4); //str, start, len
    $month = substr($hientai,5,2); if(strlen($month) == 1) $month = "0".$month;
    $day = substr($hientai,8,2);
    $hour = substr($hientai,11,2);
    $minute = substr($hientai,14,2);
    $second = substr($hientai,17,2);
    //
    $maregister = $matrungtam."-".$year.$month.$day.$hour.$minute.$second;
    //
    $sql = "insert into tblKhachHangDangKyECard(MaDangKy,TenKH,DienThoai,Email,DiaChi,CongTy,BoPhan,ChucVu, ThoiGianTao,TinhTrangID) values('$maregister',N'$tenkh','$phone',N'$email',N'$address',N'$company',N'$department',N'$position','$hientai','1')";
    $dbCon->query($sql);
}
?>