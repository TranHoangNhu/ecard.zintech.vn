<!DOCTYPE HTML>
<html>
<head>
<title>Giải pháp quản lý ECARD</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="keywords" content="Phần mềm quản lý ecard ZinECard">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<!-- <link href="css/font-awesome.css" rel="stylesheet">  -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="./css/style_login.css" rel='stylesheet' type='text/css' />
<!--fonts-->
 <link href="//fonts.googleapis.com/css?family=Cabin:400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<!--//fonts--> 
</head>
<body class="img js-fullheight"
    style="background-image: url('images/nfc-background.jpg'); height: 100vh; text-align:center !important;"
    https:="" wallpapers.com="" images="" hd="">
    <section class="ftco-section">
        <div class="container" style="padding: 20px 10px; background-color: rgba(0,0,0,0.75); border-radius: 0 0 200px 200px">
            <div class="row flex-column align-items-center mx-auto">
				<img class="mb-2" src="images/logo-nfc-login.png" alt="ecard_logo" height="150px">
                <h2 class="heading-section" style="margin: 10px 0 !important;">XU HƯỚNG CARD CÔNG NGHỆ 4.0</h2>
                <div class="row justify-content-center w-100">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">

                        <form action="login_action.php" method="post" class="px-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Tên đăng nhập" name="username"
                                    required="">
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" name="password" class="form-control"
                                    placeholder="Mật khẩu" required="">
                                <span class="fa fa-fw field-icon toggle-password fa-eye"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Đăng nhập</button>
                            </div>
                            <div class="form-group text-center">
                                <div class="w-100">
                                    <label class="checkbox-wrap checkbox-primary d-flex justify-content-center" >Lưu mật khẩu
                                        <input type="checkbox" name="checkbox" checked="">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
	<div class="footer row">
		<p>CTY TNHH giải pháp công nghệ ZINTECH</p>
        <p><i class="fa fa-phone"></i>&nbsp;02839310042 - 085 862 6768</p>
        <p><i class="fa fa-globe"></i>&nbsp;www.zintech.vn</p>
        <p><i class="fa fa-envelope-o"></i>&nbsp;sales@zintech.vn</p>
     </div>
    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const password = document.querySelector('#password-field');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            if (!document.querySelector('.form-group span').classList.replace('fa-eye', 'fa-eye-slash')) {
                document.querySelector('.form-group span').classList.replace('fa-eye-slash', 'fa-eye')
            }
            else {
                document.querySelector('.form-group span').classList.replace('fa-eye', 'fa-eye-slash')

            }
        });
    </script>
</body>
</html>