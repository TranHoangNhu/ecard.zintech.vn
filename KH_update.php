<?php 
require('lib/db.php');
require('functions/lichsuphieu.php');
@session_start();

$manv = "";
$manv = $_SESSION['MaNV'];

$makhcu = ""; $makhmoi = ""; $tenkh = ""; $ghichu= ""; $dienthoai =""; $diachi = ""; $manhomkh = ""; $mathevipcu = ""; $loaithevip = "";

if(isset($_POST['makhcu'])) 
{
  $makhcu = $_POST['makhcu'];
  $makhmoi = $_POST['makhmoi']; 
  $tenkh = $_POST['tenkh'];
  $dienthoai = $_POST['dienthoai'];
  $diachi = $_POST['diachi'];
  $manhomkh = $_POST['manhomkh']; 
  $mathevipcu = $_POST['mathevipcu']; 
  $mathevipmoi = $_POST['mathevipmoi']; 
  $loaithevip = $_POST['loaithevip']; 
  $ghichu = $_POST['ghichu'];

  $trungmankh = 0; $trungmathevip = 0;
  if($makhcu != "")
  {
    if($makhmoi != $makhcu)
    {
      //
      //-------------sửa mã khách hàng: kiểm mã mới -------------//
      //
      $sql = "Select MaDoiTuong from tblDMKHNCC Where MaDoiTuong like '$makhmoi'";
      try
      {
          $rs=$conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          if($rs != false)
          {
            foreach($rs as $r)
            {
              $r['MaDoiTuong'];
              if($r['MaDoiTuong'] != null && $r['MaDoiTuong'] != "")
                $trungmakh = 1;
            }
          }
      }
      catch (Exception $e) { echo $e->getMessage(); }
    }
    //
    //
    if($mathevipmoi != $mathevipcu && $mathevipmoi != "")
    {
      //
      //-------------sửa mã thẻ vip: kiểm mã mới -------------//
      //
      $sql = "Select MaTheVip from tblKhachHang_TheVip Where MaTheVip like '$mathevipmoi' and MaKhachHang not like '$makhcu'";
      try
      {
          $rs=$conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
          if($rs != false)
          {
            foreach($rs as $r)
            {
              $r['MaTheVip'];
              if($r['MaTheVip'] != null && $r['MaTheVip'] != "")
                $trungmathevip = 1;
            }
          }
      }
      catch (Exception $e) { echo $e->getMessage(); }
    }
    //
    //
    if($trungmakh == 1 || $trungmathevip == 1)
    {
?> 
    <script> 
    alert('Trùng mã khách hàng hoặc thẻ vip, cần chọn mã khác !');
    setTimeout('window.location="KH_list.php"',0);
    </script>
<?php
    }

    $sql = "Update tblDMKHNCC set MaDoiTuong = '$makhmoi', TenDoiTuong = N'$tenkh', GhiChu = N'$ghichu',DienThoai ='$dienthoai',DiaChi = '$diachi',MaNhomKH =N'$manhomkh' Where MaDoiTuong like '$makhcu'";
    $conn->query($sql);

    $sql = "Update tblKhachHang_TheVip set MaKhachHang = '$makhmoi' Where MaKhachHang like '$makhcu'";
    $conn->query($sql);

    $sql = "Update tblLichSuPhieu set MaKhachHang = '$makhmoi', TenKhachHang = N'$tenkh' Where MaKhachHang like '$makhcu'";
    $conn->query($sql);

    if($mathevipcu != $mathevipmoi && $mathevipmoi != "" && $mathevipcu != "")
    {
      //--------sửa mã thẻ vip cho khách cũ ------------//
      $sql = "Update tblKhachHang_TheVip set MaTheVip = '$mathevipmoi' Where MaKhachHang like '$makhmoi' Or MaTheVip like N'$mathevipcu'";
      $conn->query($sql);

      $sql = "Update tblTheVip_GhiNoDV set MaTheVip = '$mathevipmoi' Where MaTheVip like '$mathevipcu'";
      $conn->query($sql);

      $sql = "Update tblTheVip_GhiNoTT set MaTheVip = '$mathevipmoi' Where MaTheVip like '$mathevipcu'";
      $conn->query($sql);

      $sql = "Update tblLichSuPhieu set MaTheVip = '$mathevipmoi' Where MaTheVip is not null and MaTheVip <> '' and (MaTheVip like N'$mathevipcu' Or MaKhachHang like '$makhmoi')";
      $conn->query($sql);
    }
//-------------------ket thuc xu ly khach hang cu --------------------------------//
}
else if($makhcu == "")
{
//
//--------------------day là khách mới, check mã có khách khác dùng chưa ---------//
//
    $trungmakh = 0;
    $sql = "Select MaDoiTuong from tblDMKHNCC Where MaDoiTuong like '$makhmoi'";
    try
    {
        $rs=$conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        if($rs != false)
        {
            foreach($rs as $r)
            {
              $r['MaDoiTuong'];
              if($r['MaDoiTuong'] != null && $r['MaDoiTuong'] != "")
                $trungmakh = 1;
            }
        }
    }
    catch (Exception $e) { echo $e->getMessage(); }
    
    if($trungmakh == 1)
    {
?> 
    <script> 
    alert('Trùng mã khách hàng, cần chọn mã khác !');
    setTimeout('window.location="KH_list.php"',0);
    </script>
<?php
  }
  else
  {
    //
    //--------------------dữ liệu khách mới ok -> thêm mới----------------------//
    //
    $sql = "Insert into tblDMKHNCC(MaDoiTuong, TenDoiTuong, LaKH, LaNCC, MaNhomKH, MaTrungTam, GhiChu, DienThoai,DiaChi) values('$makhmoi',N'$tenkh',1,0,'$manhomkh','01',N'$ghichu','$dienthoai',N'$diachi')";
    //echo "insert kh:".$sql;
    $conn->query($sql);

    if($mathevipmoi != "")
    {
        //---cấp thẻ cho khách mới ----//
        try
        {
            $sql = "Insert into tblKhachHang_TheVip(MaKhachHang, MaTheVip, LoaiTheVip, NgayApDung, NgungThe, IsGhiNoDV, IsGhiNoTT, MaNV, NgayBanHanh) values('$makhmoi','$mathevipmoi','$loaithevip',getdate(),0,0,0,'$manv',getdate())";
            $conn->query($sql);
        }
        catch (Exception $e) { echo $e->getMessage(); }
    }
  }
}//end if makhcu == "" -> đây là khách mới
?>
<script>
  setTimeout('window.location="KH_list.php"',0);
</script>
<?php    
}//end if POST["Makhcu"]
else
{
?>
<script>
  setTimeout('window.location="KH_list.php"',0);
</script>
<?php
}
?>