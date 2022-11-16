<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');
require('functions/lichsuphieu.php');
require('helper/custom-functions.php');

@session_start();
$kh = new clsKhachHang($conn);
date_default_timezone_set('Asia/Bangkok');

if(!isset($_SESSION['TenSD'])) //------check session nhân viên, ko có thoát ra đăng nhập lại
{
?>
<script>
	setTimeout('window.location="login.php"',0);
</script>
<?php
}

$matrungtam = $_SESSION['MaTrungTam'];
$tentrungtam = $_SESSION['TenTrungTam'];
$ngay = date("d");
$thang = date("m");
$nam = date("Y");

$themmoi = 0; $chinhsua = 0; $xoa = 0; $lichsuSD = 0; $makhcu = ""; $tenkh = ""; $dienthoai = ""; $diachi = ""; $ghichu = ""; $manhomkh = ""; $tennhomkh = ""; $mathevip = ""; $loaithevip = "";
if(@$_GET['chinhsua'] != null)
{
  $chinhsua = @$_GET['chinhsua'];
}
else 
{
  $chinhsua = 0;
}

if(@$_GET['themmoi'] != null)
{
  $themmoi = @$_GET['themmoi'];
}
else 
{
  $themmoi = 0;
}

if(@$_GET['xoa'] != null)
{
  $xoa = @$_GET['xoa'];
}
else 
{
  $xoa = 0;
}
//
//
if(@$_GET['lichsuSD'] != null)
{
  $lichsuSD = @$_GET['lichsuSD'];
}
else 
{
  $lichsuSD = 0;
}

if(@$_GET['makh'] != null)
{
  $makhcu = @$_GET['makh'];
  
  if($makhcu != "")
  {
    $l_sql="select a.*, b.Ten as TenNhomKH, c.MaTheVip, c.LoaiTheVip from tblDMKHNCC a left join tblDMNhomKH b On a.MaNhomKH = b.Ma left join tblKhachHang_TheVip c On a.MaDoiTuong = c.MaKhachHang Where a.MaDoiTuong like '$makhcu'";
    try
    {
      $rs=$conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);
      if($rs !== false)
      {
        foreach($rs as $r)
        {
            $r['MaDoiTuong'];
            $r['TenDoiTuong'];
            $r['DienThoai'];
            $r['DiaChi'];
            $r['GhiChu'];
            $r['MaNhomKH'];
            $r['TenNhomKH'];
            $r['MaTheVip'];
            $r['LoaiTheVip'];

            $tenkh = $r['TenDoiTuong'];
            $ghichu = $r['GhiChu'];
            $dienthoai = $r['DienThoai'];
            $diachi = $r['DiaChi'];
            $manhomkh = $r['MaNhomKH'];
            $tennhomkh = $r['TenNhomKH'];
            $mathevip = $r['MaTheVip'];
            $loaithevip = $r['LoaiTheVip'];
        }
      }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
  }
}
else 
{
  $makhcu = "";
}

if($xoa == 1 && $makhcu != "")
{
      //----xu ly chuyen ca
      $sql = "Delete from tblDMKHNCC Where MaDoiTuong like '$makhcu'";
      $rs=$conn->query($sql);
      $xoa = 0;
}

if($themmoi == 1)
{
  $makhcu = "";
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>ZinSpa - Giải pháp quản lý Spa chuyên nghiệp</title> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Phần mềm quản lý Spa-massage ZinSpa" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!-- Custom CSS -->
<link href="css/style1.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/search-form-home.css" rel='stylesheet' type='text/css' />
<link href="css/custom.css" rel="stylesheet">
<!-- jQuery -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!---//webfonts--->  
<!-- Bootstrap Core JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- DataTable plugin --> 
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<style> 
  /**
 * Striped table for popup
 */
.custab{
  border: 1px solid #ccc;
  padding: 5px;
  margin: 5% 0;
  box-shadow: 3px 3px 2px #ccc;
  transition: 0.5s;
  }
.custab:hover{
  box-shadow: 3px 3px 0px transparent;
  transition: 0.5s;
  }

/**
 * Striped table for popup
 */
.dataTables_wrapper #ktv_list_filter input{
  width: 21em;
}
.dataTables_wrapper #ktv_list_filter {
  width:50%;
  text-align:center;
  float: left;
}

/*--new menu 19042020 ---*/
.li-level1
{
  padding: 8px 8px 8px 5px;
}

.menu-level1 {
  font-size: 14px;
  color: #818181;
}

.menu-level1:hover {
  color: #f1f1f1;
}

.menu-level2 {
  padding: 8px 8px 8px 15px;
  font-size: 14px;
  color: #818181;
}

.menu-level2:hover {
  color: #f1f1f1;
}

.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 8px 8px 8px 5px; /*top right bottom left*/
  text-decoration: none;
  font-size: 14px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: green;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 12px;
  line-height: 2em;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 12px;}
}

/*-----end style new menu 19042020*/

#myDIV {
    margin: 10px; /*original: 25px */
    width: 100%; /*original: 550px */
    background: orange;
    position: relative;
    font-size: 20px; /*original: 20px */
    text-align: center;
    -webkit-animation: mymove 3s infinite; /* Chrome, Safari, Opera 4s */
    animation: mymove 3s infinite;
}

@media (min-width:768px){	
.titledieutour {
  font-size: 2em;
	}
}

/* Chrome, Safari, Opera from {top: 0px;}
    to {top: 200px;}*/
@-webkit-keyframes mymove {
    from {top: 0px;}
    to {top: 0px;}
}

@keyframes mymove {
    from {top: 0px;}
    to {top: 0px;}
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
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
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

/* The Close Button 2 */
.close2 {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close2:hover,
.close2:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}


.khu_active {
    background: #F9B703;
    color: #fff;
    font-size: 1em;
    border: 2px solid transparent;
    text-transform: capitalize;
    border: 2px solid transparent;
    width: 100px;
    outline: none;
    cursor: pointer;
    -webkit-appearance: none;
    padding: 0.5em 0;
    margin-top: 0em;
    margin-left: 5px;
    margin-bottom: 5px;
	}

.khu {
    background: #0073aa;
    color: #fff;
    font-size: 1em;
    border: 2px solid transparent;
    text-transform: capitalize;
    border: 2px solid transparent;
    width: 100px;
    outline: none;
    cursor: pointer;
    -webkit-appearance: none;
    padding: 0.5em 0;
    margin-top: 0em;
    margin-left: 5px;
    margin-bottom: 5px;
	}

.ban_dangchon {
    background: #F9B703;
    color: #fff;
    font-size: 1em;
    border: 2px solid transparent;
    text-transform: capitalize;
    border: 2px solid transparent;
    width: 150px;
    height: 140px;
    outline: none;
    cursor: pointer;
    -webkit-appearance: none;
    padding: 0.5em 0;
    margin-top: 0em;
    margin-left: 5px;
    margin-bottom: 5px;
	}

.ban_cokhach {
	background: #F9B703; /*#FFFF99;  /*#DAFFC0; #DAFFC0;*/
    color: #000;
    font-size: 1em;
    border: 2px solid transparent;
    text-transform: capitalize;
    border: 2px solid transparent;
    width: 150px;
    height: 140px;
    outline: none;
    cursor: pointer;
    -webkit-appearance: none;
    padding: 0.5em 0;
    margin-top: 0em;
    margin-left: 5px;
    margin-bottom: 5px;
	}

.ban_trong {
    background: #0073aa;
    color: #fff;
    font-size: 1em;
    border: 2px solid transparent;
    text-transform: capitalize;
    border: 2px solid transparent;
    width: 150px;
    height: 140px;
    outline: none;
    cursor: pointer;
    -webkit-appearance: none;
    padding: 0.5em 0;
    margin-top: 0em;
    margin-left: 5px;
    margin-bottom: 5px;
	}
	
/*quy css*/
@media (min-width:1024px){
  .col-md-12 .grid  {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
    box-sizing: border-box;
    
    grid-row-gap: 7px;
  }
}

@media (min-width:600px) and (max-width: 1024px) {
  .col-md-12 .grid  {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
    box-sizing: border-box;
    
    grid-row-gap: 7px;
  }
}

@media (max-width:600px){
  .col-md-12 .grid  {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    box-sizing: border-box;
    
    grid-row-gap: 5px;
  }
}

aside.floating {
    width: 100%;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 9999999;
    background-color: #395ca3;
    -webkit-box-shadow: 0 -1px 0 rgba(0,0,0,.2);
    -moz-box-shadow: 0 -1px 0 rgba(0,0,0,.2);
    box-shadow: 0 -1px 0 rgba(0,0,0,.2);
    font-size: 1.2em;
}
.cover {
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
}
aside.floating section.chatus, aside.floating section.inside > a {
    float: left;
    border-right: 1px dotted #ccc;
    vertical-align: middle;
    color: #fff;
    text-align: center;
    width: 25%;
    padding: 15px 0;
    cursor: pointer;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    position: relative;
}
aside.floating section.inside > a {
    font-size: 1em;
}

/**
 * Fake table
 */
 .Table
{
    display: table;
}
.Heading
{
  display: table-header-group;
  font-weight: bold;
  text-align: center;
  background-color: #ddd;
}
.Row
{
  display: table-row;
}
.Cell
{
  display: table-cell;
  width: 27%;
  border: solid;
  border-width: thin;
  padding: 3px 10px;
  border: 1px solid #999999;
  text-align: center;
}
</style>
</head>
<body>
<div id="wrapper">
	 <?php include 'menukhu.php'; ?>
    <div id="page-wrapper">
      <div class="col-md-12 graphs">
	       <div class="xs">

<div  id="ktv_list_selected">
    <div class="form-group" >
       <div class="col-sm-6 col-md-2">
            <select  class="form-control">
              <option selected="true" disabled="disabled">Chọn Nhóm KH</option>
              <option value="all">Tất cả</option>
<?php
       $khGroup = $kh->getClientGroup();
       if($khGroup != false)
       {
        foreach($khGroup as $r)
        {
        ?>
          <option value="<?=$r['Ten']?>"><?=$r['Ten']?></option>

        <?php
        }
      }
?>
           </select>
        </div>
    </div>
</div>
<div  id="ktv_list_tour_order">
    <div class="form-group">
       <div class="col-sm-6 col-md-2">
            <select  class="form-control">
              <option selected="true" disabled="disabled">Loại thẻ vip</option>
              <option value = 'all'>Tất cả </option>
<?php
       $vipGroup = $kh->getVipGroup();
       if($vipGroup != false)
       {
        foreach($vipGroup as $r)
        {
        ?>
          <option value="<?=$r['TenLoaiThe']?>"><?=$r['TenLoaiThe']?></option>

        <?php
        }
      }
?>
           </select>
        </div>
    </div>
</div>

<!--                                  The Modal 1 : thong tin khach hang                        -->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h3>THÔNG TIN KHÁCH HÀNG</h3>
    <form action="KH_update.php" method="post" >
      <p>Mã : </p>
      <p><input type="hidden" name="makhcu" value="<?php echo @$makhcu; ?>" style="width:100%;">
      <input type="text" name="makhmoi" value="<?php echo @$makhcu; ?>" style="width:100%;"></p>
      <p>Tên : </p>
      <p><input type="text" name="tenkh" value="<?php echo @$tenkh; ?>" style="width:100%;"></p>   
      <p>Điện thoại : </p>
      <p><input type="text" name="dienthoai" value="<?php echo @$dienthoai; ?>" style="width:100%;"></p>
      <p>Địa chỉ : </p>
      <p><input type="text" name="diachi" value="<?php echo @$diachi; ?>" style="width:100%;"></p>
      <p>Nhóm KH : </p>
      <p>
        <select name="manhomkh" class="form-control">
<?php
        $khGroup = $kh->getClientGroup();
        if($khGroup != false)
        {
            foreach($khGroup as $r)
            {
              if($manhomkh == $r['Ma'])
              {
?>
            <option value="<?=$r['Ma']?>" selected="true"><?=$r['Ten']?></option>
<?php
              }
              else
              {
?>
            <option value="<?=$r['Ma']?>"><?=$r['Ten']?></option>
<?php
              }
            }
        }//end if($khGroup != false)
?>
        </select>
      </p>
      <p>Thẻ Vip : </p>
      <p><input type="hidden" name="mathevipcu" value="<?php echo @$mathevip; ?>" style="width:100%;">
        <input type="text" name="mathevipmoi" value="<?php echo @$mathevip; ?>" style="width:100%;"></p>
      <p>Loại thẻ Vip: </p>
      <p>
        <select name="loaithevip" class="form-control">
<?php
        $vipGroup = $kh->getVipGroup();
        if($vipGroup != false)
        {
            foreach($vipGroup as $r)
            {
              if($loaithevip == $r['MaLoaiThe'])
              {
?>
            <option value="<?=$r['MaLoaiThe']?>" selected="true"><?=$r['TenLoaiThe']?></option>
<?php
              }
              else
              {
?>
            <option value="<?=$r['MaLoaiThe']?>"><?=$r['TenLoaiThe']?></option>
<?php
              }
            }
        }//end if($vipGroup != false)
?>
        </select>
      </p>
      <p>Ghi chú : </p>
      <p><input type="text" name="ghichu" value="<?php echo @$ghichu; ?>" style="width:100%;"></p>
      <p style="padding-top:20px;"></p>
      <input type="submit" name="btn_update" value="Cập nhật">
    </form>
  </div>
</div>

<?php
if($chinhsua == 1 || $themmoi == 1)  // co thong tin nhập típ
{
  $chinhsua = 0;
  $themmoi = 0;
?>
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
//btn.onclick = function() {
    modal.style.display = "block";
//}

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

<!--                           The Modal 2                            -->

<div id="myModal2" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close2">&times;</span>
    <h3>LỊCH SỬ SỬ DỤNG KH <?php echo $tenkh; ?></h3>
      <div class="row">
          <div class="col-md-12">
              <table class="table" id="kh_list">
                  <thead>
                    <tr>
                      <th>Ngày</th>          
                      <th>Thẻ VIP</th>        
                      <th>Dịch vụ</th>    
                      <th>SL</th>
                      <th>Thành tiền</th>
                      <th>Bill</th>                 
                    </tr>
                  </thead>
                <tbody>
<?php
    $l_sql="select a.GioVao, a.MaTheVip, b.TenHangBan, b.SoLuong, b.ThanhTien, a.MaLichSuPhieu from tblLichSuPhieu a, tblLSPhieu_HangBan b Where a.MaLichSuPhieu = b.MaLichSuPhieu and a.MaKhachHang is not null and a.MaKhachHang <> '' and a.MaKhachHang like '$makhcu' Order by a.GioVao";
    try
    {
      $rs=$conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);;
      if($rs != false)
      {
        foreach($rs as $r)
        {
            $r['GioVao'];
            $r['MaTheVip'];
            $r['TenHangBan'];
            $r['SoLuong'];
            $r['ThanhTien'];
            $r['MaLichSuPhieu'];
?>
                  <tr class="success">
                    <td><?php echo $r['GioVao'];?></td>
                    <td><?php echo $r['MaTheVip'];?></td>      
                    <td><?php echo $r['TenHangBan'];?></td>
                    <td><?php echo $r['SoLuong'];?></td>
                    <td><?php echo $r['ThanhTien'];?></td>
                    <td><?php echo $r['MaLichSuPhieu'];?></td>
                  </tr>
<?php
        }//end foreach($rs as $r)
      }//end if($rs != false)
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
?>
                </tbody>
              </table>
          </div>
      </div>
      <p style="padding-top:20px;"></p>
  </div>
</div>
<!--                                               end The Modal 2                       -->

<?php
if($lichsuSD == 1) 
{
  $lichsuSD = 0;
?>
<script>
// Get the modal
var modal = document.getElementById('myModal2');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
//btn.onclick = function() {
    modal.style.display = "block";
//}

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
}//end if($lichsuSD == 1) 

$kh_list = $kh->getAllClients();
$kh_arr = array();

foreach($kh_list as $r)
{
  $kh_arr[] = [
          'MaKH' => $r['MaDoiTuong'], 
          'TenKH' => $r['TenDoiTuong'], 
          'MaTheVip' => $r['MaTheVip'], 
          'TenLoaiThe' => $r['TenLoaiThe'], 
          'IsGhiNoDV' => $r['IsGhiNoDV'],
          'IsGhiNoTT' => $r['IsGhiNoTT'],
          'TenNhomKH' => $r['TenNhomKH'], 
          'DienThoai' => $r['DienThoai'], 
          'DiaChi' => $r['DiaChi'], 
          'GhiChu' => $r['GhiChu']
  ];
}

$makhtemp = "";
$kh_list =  customizeArrayKH2( $kh_arr );//var_dump(sizeof($client_list));die; 

?>
<div class="row">
    <form action="KH_list.php" method="GET">
<?php
    echo "   So Luong KH: ".sizeof($kh_arr); 
?>
        <button type="submit" class="btn" style="background-color: green;color:white;margin-left: 10px;font-style: bold;font-weight: 100px" name ="themmoi" value="1">Thêm Mới</button>

    </form>

</div>

<div class="row">
</div>
	         <div class="row">
		          <div class="col-md-12">
                <table class="table" id="ktv_list">
                <thead>
                  <tr>
                    <th>Mã</th>           
                    <th>Tên</th>    
                    <th>Nhóm</th>
                    <th>Thẻ vip</th>    
                    <th>Loại thẻ</th>    
                    <th>Là thẻ DV</th>    
                    <th>Là thẻ tiền</th>    
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>          
                    <th>Lịch sử SD</th>             
                  </tr>
            </thead>
            <tbody>
<?php 

foreach( $kh_list as $k )
{
  $makhtemp = $k->MaKH;//.",".$ktv->NhomNhanVien;
?>
          <tr class="success">
              <td><a href="KH_list.php?makh=<?php echo $k->MaKH; ?>&chinhsua=1"><?php echo $k->MaKH;?></a></td>            
              <td><?php echo $k->TenKH;?></td>      
              <td><?php echo $k->TenNhomKH;?></td>
              <td><?php echo $k->MaTheVip;?></td>      
              <td><?php echo $k->TenLoaiThe;?></td>     
              <td><?php echo $k->IsGhiNoDV;?></td>
              <td><?php echo $k->IsGhiNoTT;?></td> 
              <td><?php echo $k->DienThoai;?></td>
              <td><?php echo $k->DiaChi;?></td>
              <td><?php echo $k->GhiChu;?></td>
              <td><a href="KH_list.php?makh=<?php echo $k->MaKH; ?>&lichsuSD=1">Lịch sử SD</a></td>
          </tr> 
<?php 
}
?>
<script>
$(document).ready(function() {

  var selectedKTV = $('#ktv_list_selected');
 $('#ktv_list_selected').remove();

 var orderTour = $('#ktv_list_tour_order');
 $('#ktv_list_tour_order').remove();

  $.noConflict();
  function createTable () { 
      $('#ktv_list').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
         "pageLength": 10,
        "drawCallback": function( settings ) {
           $('#ktv_list_filter').after(selectedKTV);
           $('#ktv_list_selected').after(orderTour);

        } 
      });
  }
  
  createTable();

  $('#ktv_list_selected select').change(function(){
        let selected = $(this);
        var ktv = selected.val();

        let table = $('#ktv_list').DataTable();
            
        if(ktv !== "all")
        {
            table.column(2).search( ktv ).draw();//(1)
            table.on( 'search.dt', function () {//(2)
                 // console.log('Currently applied global search: '+table.search() );
               });
        }
        else
        {
            table.destroy();
            createTable ();
        }
  });

  $('#ktv_list_tour_order select').change(function(){//alert($(this).val());

        let selected = $(this);
        let loaithevip = selected.val();
        let table = $('#ktv_list').DataTable();
               
        if(loaithevip !== "all")
        {
            table.column(4).search( loaithevip ).draw();//(1)
            table.on( 'search.dt', function () {//(2)
                 // console.log('Currently applied global search: '+table.search() );
               });
        }
        else
        {
            table.destroy();
            createTable ();
        }
  });

});
</script>
              </tbody>
              </table> 
		          </div>
		          <!-- /#col-md-12 -->
	         </div>
	       </div>   
	       <!-- /div class="xs" -->
  	 </div>
	   <!-- /div class="col-md-12 graphs"-->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Nav CSS -->
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<link href="js/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" /> 

<script>
	/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  	this.classList.toggle("active");
  	var dropdownContent = this.nextElementSibling;
  	if (dropdownContent.style.display === "block") {
  		dropdownContent.style.display = "none";
  	} else {
  		dropdownContent.style.display = "block";
  	}
  });
}
</script>
<script>
$('.navbar-toggle').on('click', function() {
  $('.sidebar-nav').toggleClass('block');  
});
</script>
</body>
</html>

<?php
/**
 * Note
 */
//(1): https://datatables.net/reference/api/draw()
//(2): https://datatables.net/reference/event/search