<?php 
require('../lib/db.php');
require('../functions/lichsuphieu.php');

@session_start();//session_destroy();
//error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING); 
date_default_timezone_set('Asia/Bangkok');

$order = 0; $l_sResult = "";
if(isset($_GET['order']))
{
	$order = intval($_GET['order']);
}

if($order == 1)
{
	//echo "xac nhan order";
	$matrungtam = $_SESSION['MaTrungTam'];
	$manv = $_SESSION['MaNV'];
	$tennv = $_SESSION['TenNV'];
	$makhu = $_SESSION['MaKhu'];
	$maban = $_SESSION['MaBan'];
	//
	//-----------------------xử lý các giá trị post, get ------------------//
	//
	$malichsuphieu = "";
	if(isset($_POST['malichsuphieu']))
	{
	 	$malichsuphieu = $_POST['malichsuphieu'];
	}

	if(isset($_GET['malichsuphieu']))
	{
	 	$malichsuphieu = $_GET['malichsuphieu'];
	}

	if(isset($_SESSION['MaLichSuPhieu']))
	{
		$malichsuphieu = $_SESSION['MaLichSuPhieu'];
	}
	//
	//----------------phiếu mới ---------------------//
	if ($malichsuphieu == NULL || $malichsuphieu == "")
	{
		$malichsuphieu = func_TaoLichSuPhieuID($conn,$matrungtam);
		if($malichsuphieu != "")
		{
			$l_sResult = ""; $orderid = ""; $lydo = "";
			$l_sResult = func_InsertLichSuPhieu($conn,$malichsuphieu,$makhu,$maban,$manv);

			$makh = ""; $tenkh = ""; $mathevip = "";
			if(isset($_SESSION['MaKhachHang'])) $makh = $_SESSION['MaKhachHang'];
			if(isset($_SESSION['TenKhachHang'])) $tenkh = $_SESSION['TenKhachHang'];
			if(isset($_SESSION['MaTheVip'])) $mathevip = $_SESSION['MaTheVip'];
			$l_sResult = func_LSPhieu_UpdateKH($conn,$malichsuphieu, $makh, $tenkh, $mathevip);

			if($l_sResult != "") echo $l_sResult;

			reset($_SESSION['TenHangBan']);
			reset($_SESSION['MaDVT']);
			reset($_SESSION['Gia']);
			reset($_SESSION['SoLuong']);
			reset($_SESSION['YeuCauThem']);

			for ($i = 0; $i< count( $_SESSION['TenHangBan']) ; $i++)
			{
				( $mahangban=key($_SESSION['TenHangBan']) );
				( $tenHB=current($_SESSION['TenHangBan']) );
				( $madvt=current($_SESSION['MaDVT']) );
				( $giaHB=floatval(current($_SESSION['Gia'])) );
				$soluong=floatval(current($_SESSION['SoLuong']));
				$thanhtien=$soluong*$giaHB;

				$l_sResult = "";
				if($orderid == "")
				{
					$orderid = func_TaoOrderID($conn,$matrungtam); // chỉ tạo 1 lần
					$l_sResult = func_InsertOrder($conn,$orderid,$malichsuphieu,$manv,$tennv);
					if($l_sResult != "") echo $l_sResult;
				}

				if($orderid != "" && $l_sResult == "")
				{
					echo "insert order moi ".$tenHB." so luong".$soluong;

					$l_sResult = func_InsertOrderChiTiet($conn,$orderid,$manv,$malichsuphieu,$mahangban,$madvt,$soluong,$giaHB,$thanhtien,$tenHB,$lydo);
					if($l_sResult != "") echo $l_sResult;
				}
	 
				next($_SESSION['TenHangBan']);
				next($_SESSION['MaDVT']);
				next($_SESSION['Gia']);
				next($_SESSION['SoLuong']);
				next($_SESSION['YeuCauThem']);
			}//end for ($i = 0; $i< count( $_SESSION['TenHangBan']) ; $i++)
		}//end insert lich su phieu
		//////////////////////TEST TAO PHIEU HANG BAN OK///////////////////////////
	} //end if ($malichsuphieu == NULL || $malichsuphieu == "")
	else
	{
		//-------------------ĐÃ CÓ MÃ LỊCH SỬ PHIẾU: XỬ LÝ ORDER THÊM (THÊM, TRẢ)------------//
		//
		$makh = ""; $tenkh = ""; $mathevip = "";
		if(isset($_SESSION['MaKhachHang'])) $makh = $_SESSION['MaKhachHang'];
		if(isset($_SESSION['TenKhachHang'])) $tenkh = $_SESSION['TenKhachHang'];
		if(isset($_SESSION['MaTheVip'])) $mathevip = $_SESSION['MaTheVip'];
		if($tenkh != "")
		{
			$l_sResult = func_LSPhieu_UpdateKH($conn,$malichsuphieu, $makh, $tenkh, $mathevip);
		}
		//
		//
		$changeSL = 0; $hangbanmoi=""; $orderid = ""; $lydo= ""; $slsession = 0;
		//
		if(!isset($_SESSION['TenHangBan']))
		{
			echo "test sau khi remove sp,khong con session hang ban";
		}
		else
		{
			reset($_SESSION['TenHangBan']);
			reset($_SESSION['MaDVT']);
			reset($_SESSION['Gia']);
			reset($_SESSION['SoLuong']);
			reset($_SESSION['YeuCauThem']);
			$slsession = count( $_SESSION['TenHangBan']);

			for ($i = 0; $i< count( $_SESSION['TenHangBan']) ; $i++)
			{
				$flag = 0; $changeSL = 0;

				( $mahangban=key($_SESSION['TenHangBan']) );
				( $tenHB=current($_SESSION['TenHangBan']) );
				( $madvt=current($_SESSION['MaDVT']) );
				( $giaHB=floatval(current($_SESSION['Gia'])) );
				$soluong=floatval(current($_SESSION['SoLuong']));
				$thanhtien = $giaHB*$soluong;

				if($hangbanmoi == "")	//lay ds de kiem tra hang ban removed
				{
					$hangbanmoi = $mahangban;
				}
				else
				{
					$hangbanmoi = $hangbanmoi."','".$mahangban;
				}
				//
				//----kiem tra hang ban moi trong db ----//
				//
				$l_sql = "Select MaHangBan, Sum(SoLuong) as SoLuong from tblLSPhieu_HangBan Where MaLichSuPhieu like '$malichsuphieu' and MaHangBan like '$mahangban' Group by MaHangBan";
				try
				{
					$result_lsp = $conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);
					if($result_lsp !== false)	//co hang ban cu
					{
						foreach($result_lsp as $r)
						{
							$r['MaHangBan'];
							$r['SoLuong'];
					
							$flag = 1;	// day hang ban cu
							$changeSL = $soluong - $r['SoLuong']; // co tang, giảm
							$thanhtien = $giaHB*$changeSL;
							//echo "sua sl".$changeSL;
						}//end while duyet hang ban cu
					}//end if co du lieu hang ban cu
				}
				catch(Exception $e) { $flag = 0; }

				$l_sResult = "";
				if($flag == 0 || $changeSL != 0) //----có hàng bán mới hoặc thay đổi số lượng
				{
					if($orderid == "")
					{
						echo "tao order id";
						
						$orderid = func_TaoOrderID($conn,$matrungtam); // chỉ tạo 1 lần
						$l_sResult = func_InsertOrder($conn,$orderid,$malichsuphieu,$manv,$tennv);
						if($l_sResult != "") echo $l_sResult;
					}
				}
				//
				//---------xu ly du lieu thay doi -------------//
				//
				if($flag == 0 && $orderid != "" && $l_sResult == "") 						
				{
					echo "update order hang".$tenHB." so luong".$soluong;
					//----hang ban mới hoàn toàn ----//
					//
					$l_sResult = func_InsertOrderChiTiet($conn,$orderid,$manv,$malichsuphieu,$mahangban,$madvt,$soluong,$giaHB,$thanhtien,$tenHB,$lydo);
					
					if($l_sResult != "") echo $l_sResult;
				}
				elseif($flag == 1 && $changeSL != 0 && $orderid != "" && $l_sResult == "")
				{
					//----hang bán cũ thay đổi số lượng --//
					//
					if($changeSL < 0) $lydo = "Tra hang";
					$l_sResult = func_InsertOrderChiTiet($conn,$orderid,$manv,$malichsuphieu,$mahangban,$madvt,$changeSL,$giaHB,$thanhtien,$tenHB,$lydo);
					if($l_sResult != "") echo $l_sResult;
				}

				next($_SESSION['TenHangBan']);
				next($_SESSION['MaDVT']);
				next($_SESSION['Gia']);
				next($_SESSION['SoLuong']);
				next($_SESSION['YeuCauThem']);
			}//end for duyet session hang ban
		}
		//
		//-----------xu ly viec tra hang, theo so luong > 0 neu co -------------//
		//
		if($hangbanmoi != "" || $slsession == 0) //ds hàng bán có session hoặc session ko có dịch vụ
		{
			$orderid = ""; $changeSL = 0; $dongia = 0;
			$tenhangban = ""; $mahangban = ""; $madvt = "";
			$l_sql = "Select MaHangBan, TenHangBan, MaDVT, DonGia, Sum(SoLuong) as SoLuong from tblLSPhieu_HangBan Where MaLichSuPhieu like '$malichsuphieu' and MaHangBan not in ('$hangbanmoi') Group by MaHangBan, TenHangBan, MaDVT, DonGia Having sum(SoLuong) > 0";
			try
			{
				$result_lsp = $conn->query($l_sql)->fetchAll(PDO::FETCH_ASSOC);
				if($result_lsp !== false)	//co hang ban cu bi tra lai
				{
					foreach($result_lsp as $r)
					{
						$r['MaHangBan'];
						$r['TenHangBan'];
						$r['MaDVT'];
						$r['SoLuong'];
						$r['DonGia'];

						$mahangban = $r['MaHangBan'];
						$tenhangban = $r['TenHangBan'];
						$madvt = $r['MaDVT'];
						$changeSL = 0 - $r['SoLuong']; // trả hàng
						$dongia = $r['DonGia'];

						$thanhtien = $dongia*$changeSL;
						$lydo = "Huy mon";

						$l_sResult = "";
						if($orderid == "")
						{
							//echo "tao order id";
							$orderid = func_TaoOrderID($conn,$matrungtam); // chỉ tạo 1 lần
							$l_sResult = func_InsertOrder($conn,$orderid,$malichsuphieu,$manv,$tennv);
							if($l_sResult != "") echo $l_sResult;
						}

						if($changeSL != 0 && $orderid != "" && $l_sResult == "")
						{
							//----hang bán cũ tra lai het --//
							//
							$l_sResult = func_InsertOrderChiTiet($conn,$orderid,$manv,$malichsuphieu,$mahangban,$madvt,$changeSL,$dongia,$thanhtien,$tenhangban,$lydo);
							if($l_sResult != "") echo $l_sResult;
						}
					}//end foreach($result_lsp as $r)
				}//end if($result_lsp !== false)
			}
			catch(Exception $e) { }
		}//end if co hang ban moi

		func_TinhTienThucTra($conn,$malichsuphieu);
	}//end else co ma lich su phieu
	
	$_SESSION['MaLichSuPhieu'] = $malichsuphieu;
}//end if co xac nhan order
//
########################----------XỬ LÝ XÓA SESSION HÀNG BÁN VÀ QUAY LẠI FORM ORDER --------#
unset($_SESSION['NhapMon']);
unset($_SESSION['MaNhomHangBan']);
unset($_SESSION['MaHangBan']);
unset($_SESSION['ThemMonSetMenu']);
?>
<!--<form>
<button type="submit" class="btn" style="color:red" name ="back" formaction="home.php">home</button>
</form>  -->
<script>
	setTimeout('window.location="../order.php"',0);
</script>