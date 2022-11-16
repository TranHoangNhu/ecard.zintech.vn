<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');
require('functions/lichsuphieu.php');
$sgDep = new clsKhachHang($conn);

@session_start();

$malichsuphieu = ""; $l_iCoDuLieu = 0;
if(isset($_SESSION['MaLichSuPhieu']))
{
	$malichsuphieu = $_SESSION['MaLichSuPhieu'];
}
$client_code = $_POST['client_code'];

$data = []; 
//$output = "";

$rs = $sgDep->getClientInfo( $client_code );
if($rs !== false)
{
	foreach($rs as $r)
	{
		array_push( $data, $r['MaDoiTuong'], $r['TenDoiTuong'], $r['DienThoai'], $r['DiaChi'], $r['MaTheVip'], $r['LoaiTheVip'],$r['NgayKetThuc'], $r['IsGhiNoDV'], $r['IsGhiNoTT'], $r['ConLai'] ); 
		//
		//
		if($malichsuphieu != "")
		{
			$sql = "Update tblLichSuPhieu set MaKhachHang = '".$r['MaDoiTuong']."', TenKhachHang = N'".$r['TenDoiTuong']."', MaTheVip = '".$r['MaTheVip']."' where MaLichSuPhieu like '$malichsuphieu'";
			$conn->query($sql);
		}

		$l_iCoDuLieu = 1;
	}
}
//
//
if($l_iCoDuLieu == 1)
{
	$_SESSION['MaKhachHang'] = $data[0]; //ma
	$_SESSION['TenKhachHang'] = $data[1];
	$_SESSION['DienThoai'] = $data[2];
	$_SESSION['DiaChi'] = $data[3];
	$_SESSION['MaTheVip'] = $data[4];
	$_SESSION['LoaiTheVip'] = $data[5];
	$_SESSION['NgayHetHan'] = $data[6];
	$_SESSION['LaTheDV'] = $data[7];
	$_SESSION['LaTheGT'] = $data[8];
	$_SESSION['SoDuTheVip'] = $data[9];
}

//echo $output;
echo json_encode($data);
