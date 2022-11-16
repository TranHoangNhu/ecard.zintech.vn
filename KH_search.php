<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');
require('functions/lichsuphieu.php');
$sgDep = new clsKhachHang($conn);
@session_start();	

$client_code = $_POST['client_code'];
$client_name = $_POST['client_name'];
$client_tel = $_POST['client_tel'];

$data = [];

$output = "";

$rs = $sgDep->searchCustomer( $client_code, $client_name, $client_tel);
//$l_sql="select a.*, b.MaTheVip from tblDMKHNCC a left join tblKhachHang_TheVip b On a.MaDoiTuong = b.MaKhachHang Where MaDoiTuong like '01-201909-001'";  
try
{
    //$rs= $conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);
    if($rs != false)
    {
	   foreach($rs as $r)
	   {
		$output = $output.'<tr>
    	<td class="sorting_1">' . $r["MaDoiTuong"]  .' </td>
    	<td>'. $r["TenDoiTuong"] . '</td>
    	<td>' . $r["DienThoai"] .'</td>
    	<td>' . $r["DiaChi"] . '</td>
    	<td>' . $r["MaTheVip"] . '</td>
    	<td><button type="button" class="btn btn-primary" id="client_selected" value="' .$r["MaDoiTuong"] . '">Select</button></td>
  		</tr>';
        //array_push( $data, $output);
	   }
    }
}
    catch (Exception $e) {
        echo $e->getMessage();
}

echo $output;
//echo json_encode($data);
