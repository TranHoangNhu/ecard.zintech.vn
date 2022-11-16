<?php 
require('lib/db.php');
require('lib/SPA.php');

@session_start();

$tenkh = ""; $phone = ""; $mail = ""; $soluong = 1; $ngay = ""; $tugio ="";
$madichvu = ""; $manv = ""; $tendichvu = ""; $tennv = "";
//
//
$spa1 = new SPA($dbCon); 
$hb = new HangBan();
$nv = new NhanVien();
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

if(isset($_POST['mail']))
{
    $mail = $_POST['mail'];
}

if(isset($_POST['soluong']))
{
    $soluong = $_POST['soluong'];
}

if(isset($_POST['ngay']))
{
    $ngay = $_POST['ngay'];
}

if(isset($_POST['gio']))
{
    $tugio = $_POST['gio'];
}

if(isset($_POST['dichvu']))
{
    $madichvu = $_POST['dichvu'];
}

if(isset($_POST['nhanvien']))
{
    $manv = $_POST['nhanvien'];
}
//
if($tenkh != "")
{
    $matrungtam = "01";
    $giobatdau = $ngay." ".$tugio;
    $gioketthuc = $giobatdau;
    //
    //
    if($madichvu != "")
    {
        $hb = $spa1->getHangBan($madichvu); //ok
    }
    //
    if($manv != "")
    {
        $nv = $spa1->getNhanVien($manv); //ok
    }
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
    $mabooking = "web".$year.$month.$day.$hour.$minute.$second;
    if($giobatdau != "" && $hb->ThoiGianLam > 0)
    {
        $timestamp = strtotime($giobatdau);
        $time = $timestamp + $hb->ThoiGianLam*60;
        $gioketthuc = date('Y-m-d H:i:s',$time);
        //ok
    }
    //
    $sql = "insert into tblKhachHangBooking(MaBooking,TenKH,SoLuong,DichVu,GioBatDau,GioKetThuc,TinhTrangBookingID, MaNV, ThoiGianTao,DienThoai,Email,MaTrungTam,MaNV_KTV, TenNV_KTV) values('$mabooking',N'$tenkh','$soluong',N'$hb->TenHangBan','$giobatdau','$gioketthuc','1','HDQT','$hientai','$phone','$mail','$matrungtam','$manv',N'$nv->TenNV')";
    $dbCon->query($sql);
}
?>