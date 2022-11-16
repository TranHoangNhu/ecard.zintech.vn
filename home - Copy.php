<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');
require('functions/lichsuphieu.php');
require_once('helper/custom-functions.php');

@session_start();   

$tenkh = $_SESSION['TenKH'];

?>
<!DOCTYPE HTML>
<html>
<head>
<title>ZinECard-Giải pháp quản lý ECard điện tử</title> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Phần mềm quản lý ECard điện tử" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<!-- Custom CSS -->
<link href="css/style1.css" rel='stylesheet' type='text/css' />

<!-- Font-awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet"> 

<link href="css/search-form-home.css" rel='stylesheet' type='text/css' />
<link href="css/custom.css" rel="stylesheet">

<!-- jQuery -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!---//webfonts--->  
<!-- Bootstrap Core JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style> 
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
@media (min-width:1280px){
  .col-md-12 .grid  {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr !important;
    box-sizing: border-box;
    
    grid-row-gap: 7px;
  }
}

@media (min-width:1080px) and (max-width: 1280px) {
  .col-md-12 .grid  {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr !important;
    box-sizing: border-box;
    
    grid-row-gap: 7px;
  }
}

@media (min-width:900px) and (max-width: 1080px) {
  .col-md-12 .grid  {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr !important;
    box-sizing: border-box;
    
    grid-row-gap: 7px;
  }
}

@media (min-width:600px) and (max-width: 900px) {
  .col-md-12 .grid  {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr !important;
    box-sizing: border-box;
    
    grid-row-gap: 7px;
  }
}

@media (max-width:600px){
  .col-md-12 .grid  {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr !important;
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
    width: 20%;
    padding: 15px 0;
    cursor: pointer;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    position: relative;
}
aside.floating section.inside > a {
    font-size: 1em;
}
</style>
</head>
<body>
<div id="wrapper">
<?php 
    include 'menu.php'; 
?>
  <div id="page-wrapper">
      <div class="col-md-12">
	       <div class="xs" style="text-align: center !important;">
	           <div class="row">
		            <div class="col-md-12">
                    <?php include 'profile.php'; ?>
		            </div>
		            <!-- /#col-md-12 -->
	           </div>
	       </div>   
	       <!-- /div class="xs" -->
  	</div>
	<!-- /div class="col-md-12"-->
  </div>
  <!-- /div #id="page-wrapper"-->
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
// var dropdown = document.getElementsByClassName("dropdown-btn");
// var i;

// for (i = 0; i < dropdown.length; i++) {
//   dropdown[i].addEventListener("click", function() {
//   	this.classList.toggle("active");
//   	var dropdownContent = this.nextElementSibling;
//   	if (dropdownContent.style.display === "block") {
//   		dropdownContent.style.display = "none";
//   	} else {
//   		dropdownContent.style.display = "block";
//   	}
//   });
// }
</script>
<script>
$('.navbar-toggle').on('click', function() {
  $('.sidebar-nav').toggleClass('block');  
   
});
</script>
</body>
</html>
