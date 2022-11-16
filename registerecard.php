<!DOCTYPE HTML>
<html>
<head>
<title>Đăng ký eCard điện tử</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Giải pháp quản lý eCard điện tử">
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
			<img src="images\logo_mobifone.jpg" width="194px" height="93px" style="padding-top:30px !important;" />
		</div>
	</div>
	<h1 class="wthree">ĐĂNG KÝ ECARD ĐIỆN TỬ</h1>
	<div class="login-section">
			<div class="login-form">			
					<div class="row">	
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="text" style="font-size: 16px !important;height: 32px !important; width: 80% !important;" name="tenkh" id="tenkh" placeholder="Name" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="mail" style="font-size: 16px !important;height: 32px !important;width: 80% !important;" name="email" id="email" placeholder="Email" required/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="text" style="font-size: 16px !important;height: 32px !important;" name="phone" id="phone" placeholder="Phone" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="text" style="font-size: 16px !important;height: 32px !important;" name="address" id="address" placeholder="Address" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="text" style="font-size: 16px !important;width: 60px; height: 32px !important;" name="company" id="company" placeholder="Company" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="text" style="font-size: 16px !important;height: 32px !important;" name="department" id="department" placeholder="Department" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="w3ls-icon">
								<input type="text" style="font-size: 16px !important;height: 32px !important;" name="position" id="position" placeholder="Position" />
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="signin-rit">
							<div class="clear"> </div>
							</div>
							<button type="button" onclick="register()" id="btnRegister" style="background-color:#5fb565;color: white;height: 40px;width: 120px;">Gửi đăng ký</button>
						</div>
						<div class="col-md-4"></div>
					</div>
			</div>
	<!-- //login -->   
<script>
    function register() {
            
        var tenkh = $("#tenkh").val();
        var email = $("#email").val();
        var phone = $("#phone").val();
        var company = $("#company").val();
        var department = $("#department").val();
        var position = $("#position").val();

        //alert("cam on quy khach: " + tenkh + ",mail: " + mail + ",phone: " + phone + ",company:" + company + ",department:" + department + ",position:" + position; //ok
                    
 		$.ajax({
      		url:"registerecard_update.php",
      		method:"POST",
      		data:{'tenkh':tenkh,'phone':phone,'email':email,'company':company,'department':department,'position':position},
      		dataType:"text",
      		success:function(output)
      		{
          		console.log('first ajax: ' + output);
      		},
      		complete: function() { 
          		console.log("complete");
      		}
      	});//ajax*/

        alert("Cảm ơn quý khách đã đăng ký !!!");
    }
</script>   
		<div class="clear"></div>	
	</div>
	<!-- end #login secion -->
	<div class="row" style="padding-top: 20px !important;"></div>
    <div class="footer">
		<p class="title" style="padding-top: 20px !important;"><h2>Developed by ZINTECH COMPANY</h2></p>
        <p>Phone: 085 862 6768 - 078 622 8768</p>
        <p>Email:sales@zintech.vn</p>
        <p>Website:www.zintech.vn</p>
    </div>
		<!--//login-->
</body>
</html>