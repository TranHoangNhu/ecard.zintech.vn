<?php 
require('../../lib/db.php');
require('../../lib/clsKhachHang.php');
require('../../functions/lichsuphieu.php');
$sgDep = new clsKhachHang($conn);
@session_start();	

$client_code = $_POST['client_code'];
$client_name = $_POST['client_name'];
$client_tel = $_POST['client_tel'];

$data = [];
$rs = $sgDep->searchCustomer( $client_code, $client_name, $client_tel);
if($rs != false)
{
	foreach($rs as $r)
	{
		$data[] = '<tr>
    	<td class="sorting_1">' . $r["MaDoiTuong"]  .' </td>
    	<td>'. $r["TenDoiTuong"] . '</td>
    	<td>' . $r["DienThoai"] .'</td>
    	<td>' . $r["DiaChi"] . '</td>
    	<td>' . $r["MaTheVip"] . '</td>
    	<td><button type="button" class="btn btn-primary" id="client_selected" value="' .$r["MaDoiTuong"] . '">Select</button></td>
  		</tr>';
	}
}

echo json_encode($data);
