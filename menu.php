<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/all.min.css" rel="stylesheet">    
<style>
ul li .fas , ul li .far, ul li .fab
{
  color: #fff;
    margin-right: 6px;
}

ul.dropdown-container{
    margin-left: -26px;
}

</style>
<script>
$(document).ready( function() {

         $("li.custom-dropdown-toggle").on('click', function() {// cái này mà để theo event propagation sẽ ko toggle đc vì kẹt e.stopPropagation() ở duới
            
            $(this).find('ul').toggle();
        });

        // Get current page and set current in nav
        var path = location.href ;//console.log( 'path: ' + path);

        $(".navbar-default.sidebar .sidebar-nav ul > li").each(function() {//alert(11);
          let navItem = $(this);
          
          let href  = navItem.find("a").attr("href");//console.log('href: '+ href);

          if ( path == href ) {
            //navItem.addClass("active");
            navItem.parent().css({display:'block'});
            navItem.css({background:'green'});
            navItem.find("a").css({color:'#fff'});
          }

        });

         $("ul.dropdown-container ").on('click', function(e) {
              e.stopPropagation(); 
                
        });

  });
</script>
<!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand"><div style="font-size: 0.8em !important; display: inline;">Wellcome,</div> <?php echo $tenkh; ?></a>
            </div>
            <!-- /.navbar-header -->
            <div class="navbar-default sidebar" role="navigation">
               <div class="sidebar-nav navbar-collapse collapse" aria-expanded="false">
                    <ul class="nav" id="side-menu">
                        <li>
                            <div class="profile-image" style="text-align: center !important;">
                                <img src="images/personal.png" width="160px" height="180px" />
                            </div>
                        </li>
                        <li>
                            <a href="<?=( isset($_SERVER['HTTPS']) ? "https://" : "http://" )?><?=$_SERVER['SERVER_NAME']?><?=( ( $_SERVER['SERVER_NAME'] !== 'localhost' ) ? "/" : ":8081/WebECardUser_102022/" )?>home.php"><i class="fas fa-user"></i> Your account</span></a>
                        </li>
                        <li>
                            <a href="<?=( isset($_SERVER['HTTPS']) ? "https://" : "http://" )?><?=$_SERVER['SERVER_NAME']?><?=( ( $_SERVER['SERVER_NAME'] !== 'localhost' ) ? "/" : ":8081/WebECardUser_102022/" )?>account.php"><i class="fas fa-key"></i> Change password<!--<span class="fa arrow">--></span></a>
                        </li>
                         <li>
                            <a href="<?=( isset($_SERVER['HTTPS']) ? "https://" : "http://" )?><?=$_SERVER['SERVER_NAME']?><?=( ( $_SERVER['SERVER_NAME'] !== 'localhost' ) ? "/" : ":8081/WebECardUser_102022/" )?>logout.php"><i class="fas fa-sign-out-alt"></i> Logout<!--<span class="fa arrow">--></span></a>
                        </li>
                    </ul>
                </div>
               
            </div>
           
        </nav>