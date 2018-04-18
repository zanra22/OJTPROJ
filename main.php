

<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: register.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: main.php");
  }
?>
<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

	<script type="text/javascript" src="script.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">

	<title>ARnaz</title>
</head>
<body>
<?php if (isset($_SESSION['success'])) : ?>
<!-- Start of Navbar -->

	<nav class="navbar navbar-toggleable-md navbar-light bg-primary navbar-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <img align="left" class="logo" src="logo.png" >
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Components
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                   <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="		dropdown" href="#">Processor</a>
            			<ul class="dropdown-menu">
              			<a class="dropdown-item" href="#">Intel</a>
             			 <a class="dropdown-item" href="#">AMD</a>
           				 </ul>
          			</li>

          			<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="		dropdown" href="#">Motherboard</a>

            			<ul class="dropdown-menu">
              		
            				<a class="dropdown-item" href="">CPU Onboard</a>
            				<a class="dropdown-item" href="">LGA 2011-3</a>
            				<a class="dropdown-item" href="">LGA 1151</a>
            				<a class="dropdown-item" href="">LGA 1150</a>
            				<a class="dropdown-item" href="">LGA 775</a>
            				<a class="dropdown-item" href="">Socket AM3/AM3+</a>
            				<a class="dropdown-item" href="">CPU Onboard</a>
            				<a class="dropdown-item" href="#">Socket AM4</a>
            				<a class="dropdown-item" href="#">Socket FM2/FM2+</a>
            				<a class="dropdown-item" href="#">Socket TR4</a>
          		  		</ul>
          			</li>

          			<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="		dropdown" href="#">Chassis</a>

            			<ul class="dropdown-menu">
              		
            				<a class="dropdown-item" href="">Full Tower</a>
            					<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" 
            						data-toggle="dropdown" href="#">Mid Tower</a>
              						<ul class="dropdown-menu">
              							<li class="dropdown-item"><a href="#">Aerocool/Antec</a></li>
              							<li class="dropdown-item"><a href="#">Bitfenix/CoolerMaster</a></li>
              							<li class="dropdown-item"><a href="#">Corsair/Cougar</a></li>
              							<li class="dropdown-item"><a href="#">Deepcool/In Win</a></li>
              							<li class="dropdown-item"><a href="#">Fractal/Gamemax</a></li>
              							<li class="dropdown-item"><a href="#">NZXT/Silverstone</a></li>
              							<li class="dropdown-item"><a href="#">Omega/Powerlogic/Raidmax</a></li>
              							<li class="dropdown-item"><a href="#">Phanteks/Tecware</a></li>
              							<li class="dropdown-item"><a href="#">Thermaltake</a></li>
              							<li class="dropdown-item"><a href="#">Sharkoon/Xigmatek</a></li>
              						</ul>
              					</li>
            			<a class="dropdown-item" href="">Mini Tower</a>
            			<a class="dropdown-item" href="">Cube Case</a>
          		  		</ul>
          			</li>


          			<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="		dropdown" href="#">Graphics Card</a>

            			<ul class="dropdown-menu">
            					<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" 
            						data-toggle="dropdown" href="#">Nvidia</a>
              						<ul class="dropdown-menu">
              							<li class="dropdown-item"><a href="#">Asus/Galax</a></li>
              							<li class="dropdown-item"><a href="#">MSI/Gigabyte</a></li>
              							<li class="dropdown-item"><a href="#">Palit</a></li>
              							<li class="dropdown-item"><a href="#">EVGA/Quadro</a></li>
              							<li class="dropdown-item"><a href="#">Zotac</a></li>
              						</ul>
              					</li>

              					<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" 
            						data-toggle="dropdown" href="#">Radeon</a>
              						<ul class="dropdown-menu">
              							<li class="dropdown-item"><a href="#">Asus</a></li>
              							<li class="dropdown-item"><a href="#">Gigabyte</a></li>
              							<li class="dropdown-item"><a href="#">MSI/XFX</a></li>
              							<li class="dropdown-item"><a href="#">Sapphire</a></li>
              						</ul>
              					</li>
       
          		  		</ul>
          			</li>


          			<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="		dropdown" href="#">Memory</a>

            			<ul class="dropdown-menu">
            					<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" 
            						data-toggle="dropdown" href="#">LoDimm</a>
              						<ul class="dropdown-menu">
              							<li class="dropdown-item"><a href="#">DDR4 3XXX</a></li>
              							<li class="dropdown-item"><a href="#">DDR4 2XXX</a></li>
              							<li class="dropdown-item"><a href="#">DDR3 2XXX</a></li>
              							<li class="dropdown-item"><a href="#">DDR3 1866</a></li>
              							<li class="dropdown-item"><a href="#">DDR3 1600</a></li>
              							<li class="dropdown-item"><a href="#">DDR2 800</a></li>
              						</ul>
              					</li>

              					<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" 
            						data-toggle="dropdown" href="#">SoDimm</a>
              						<ul class="dropdown-menu">
              							<li class="dropdown-item"><a href="#">DDR4</a></li>
              							<li class="dropdown-item"><a href="#">DDR3</a></li>
              							<li class="dropdown-item"><a href="#">DDR2 800</a></li>
              						</ul>
              					</li>
       
          		  		</ul>
          			</li>


          			<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="		dropdown" href="#">Hard Drive</a>

            			<ul class="dropdown-menu">
            					<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" 
            						data-toggle="dropdown" href="#">Internal</a>
              						<ul class="dropdown-menu">
              							<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="dropdown" href="#">Desktop 3.5"</a>
              								<ul class="dropdown-menu">
              									<li class="dropdown-item"><a href="#">500GB-1TB</a></li>
              									<li class="dropdown-item"><a href="#">2TB-8TB</a></li>
              								</ul>
              							</li>
              							<li class="dropdown-item"><a href="#">Mobile 2.5"</a></li>
              						</ul>
              					</li>
            				<a class="dropdown-item" href="">External/Portable</a>
            				<a class="dropdown-item" href="">Solid State Drive</a>
          		  		</ul>
          			</li>


          			<li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="		dropdown" href="#">Power Supply</a>

            			<ul class="dropdown-menu">
              		
            				<a class="dropdown-item" href="">1000-1500 Watts</a>
            				<a class="dropdown-item" href="">700-900 Watts</a>
            				<a class="dropdown-item" href="">500-650 Watts</a>
            				<a class="dropdown-item" href="">300-450 Watts</a>
          		  		</ul>
          			</li>

          			<a class="dropdown-item" href="#">Sound Card</a>
          			<a class="dropdown-item" href="#">LAN Card</a>
          			<a class="dropdown-item" href="#">Optical Drive	</a>

          		<!-- <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" data-toggle="	dropdown" href="#">LGA 1151</a>
              			<ul class="dropdown-menu">
              			<li class="dropdown-item"><a href="#">TEST</a></li>
              			</ul>
              		
              		</li> -->


        </ul>
      </li>
    </ul>
  </div>
  				<!-- Search Box -->
 					 <div class="col-xs-3">
   					 	<div class="input-group">
    					  <input type="text" class="form-control" placeholder="Search for...">
     						 <span class="input-group-btn">
     					  		 <button class="btn btn-secondary" type="button">Go!</button>
    					 	 </span>
    					</div>
 					 </div>
 				 <!-- end of Search box --> 
         <div class="col-xs-3">
           <ul class="nav navbar-nav navbar-right">
          <button class="login" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
            <div id="id01" class="modal">
                <form class="modal-content animate" action="/main.php">
                  <?php include('errors.php'); ?>
                  <div class="imgcontainer">
                      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;
                      </span>
                      <img src="img_avatar2.png" alt="Avatar" class="avatar">
                  </div>
                  <div class="container">
                      <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required>
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>
                        <button type="submit" name="login_user">Login</button>
                        <label>
                          <input type="checkbox" checked="checked" name="remember"> Remember me
                        </label>
                  </div>
                  <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    <span class="psw">Forgot <a href="#">password?</a></span>
                  </div>
                  <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
              </form>
            </div>
            <script>
            // Get the modal
              var modal = document.getElementById('id01');
            // When the user clicks anywhere outside of the modal, close it
              window.onclick = function(event) 
              {
                  if (event.target == modal) 
                    {
                      modal.style.display = "none";
                    }
              }
            </script>
        </ul>
         </div>

         <!-- <div class="col-xs-3"> -->
                     <ul class="nav navbar-nav navbar-right">
                        <button onclick="document.getElementById('idLogin').style.display='block'" style="width:auto;" class="signupbtn";>Sign Up</button>
                        <div class="imgcontainer">
                        <div id="idLogin" class="modal-signup animate">
                            <span onclick="document.getElementById('idLogin').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <form class="modal-content-signup" action="/action_page.php">
                            <div class="container">
                            <h1>Sign Up</h1>
                            <p>Please fill in this form to create an account.</p>
                               <hr>
                                  <label for="email"><b>Email</b></label>
                                  <input type="text" placeholder="Enter Email" name="email" required>

                                  <label for="psw"><b>Password</b></label>
                                  <input type="password" placeholder="Enter Password" name="psw" required>

                                  <label for="psw-repeat"><b>Repeat Password</b></label>
                                  <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
      
                                  <label>
                                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                                  </label>

                        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                            <div class="clearfix">
                             <button type="button" onclick="document.getElementById('idLogin').style.display='none'" class="cancelbtn-signup">Cancel</button>
                             <button type="submit" class="signupbtn-signup">Sign Up</button>
                            </div>
                        </div>
                        </div>
                      </form>
                    <!-- </div> -->

    <script>
      // Get the modal
      var modal = document.getElementById('idLogin');

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
         }
        }
    </script>
  </ul>


</nav>
<!-- End of Navbar -->

		<!-- Carousel Item Here -->

		<div class="container-fluid">
    <div class="row">
      <div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <br />

          <div id="carousel1" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel1" data-slide-to="0" class="active"></li>
              <li data-target="#carousel1" data-slide-to="1"></li>
              <li data-target="#carousel1" data-slide-to="2"></li>
              <li data-target="#carousel1" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img src="crs1.png" alt="First Slide" class="responsiveImage" />
              </div>

              <div class="carousel-item">
                <img src="crs2.png" alt="Second Slide" class="responsiveImage"/>
              </div>

              <div class="carousel-item">
                <img src="crs1.png" alt="Third Slide" class="responsiveImage" />
              </div>

              <div class="carousel-item">
                <img src="crs2.png" alt="Fourth Slide" class="responsiveImage"/>
              </div>
            </div>

            <a class="left carousel-control" href="#carousel1" role="button" data-slide="prev">
              <span class="icon-prev" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>

            <a class="right carousel-control" href="#carousel1" role="button" data-slide="next">
              <span class="icon-next" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
        </div>
      </div>
    </div>
  </div>
	<!-- End of Carousel -->
<?php endif ?>
</body>
</html>