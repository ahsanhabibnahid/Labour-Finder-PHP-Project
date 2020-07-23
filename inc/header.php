<?php
    include 'lib/Session.php';
    Session::init();
    include 'lib/Database.php';
	include 'helpers/Format.php';

	spl_autoload_register(function($class){
		include_once 'classes/'.$class.'.php';
	});
	$db = new Database();
	$fm = new Format();
	$work = new Worker();
	$ct = new Cart();
	$cat = new Category();
	$cmr = new Customer();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Labour Finder</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/fontawesome.all.min.css" rel="stylesheet" type="text/css" media="all"/>

<script src="js/jquerymain.js"></script>
<script src="js/fontawesome.all.min.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body> 
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<h1 >
					<a href="index.php" style="color: #C51214" class="text-decoration-none">Lab<i class="fas fa-search"></i>ur</a>
				</h1>
			</div>
			  <div class="header_top_right">

			  	

			    <div class="search_box">
				    <form action="search.php" method="POST">
				    	<input type="text" name="searchValue" >
				    	<input type="submit" name="search" value="Search">
				    </form>
			    </div>

			    <div class="shopping_cart">
					<div class="cart">
						<i style="color: #fff" class="fas fa-shopping-cart"></i>
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
									<?php
										$getData = $ct->checkCartTable();
										if ($getData) {
											$sum = Session::get("sum");
											$qty = Session::get("qty");
											echo "৳".$sum." - ".$qty;
										}
										else {
											echo "Empty";
										}
										
									?>
								</span>
							</a>
						</div>
			    </div>
			<?php
				if (isset($_GET['cid'])){
					$delData = $ct->delCustomerCart();
					Session::destroy();
				}
			?>
		   <div class="login" style="float: right; margin-top: -45px;">
			   	<?php
	    			$login = Session::get("cuslogin");
	    			if ($login==false) {
	    		?>
	        			<a  href="login.php" class="text-decoration-none">Login</a>

	    		<?php	} else {
				?>

			   		<a href="?cid=<?php Session::get('cmrID') ?>">Logout</a>

			   	<?php
			   		}
			   	?>
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>



</style>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="category.php">Category</a>
	  	<ul>
	  		<?php
				$getCat = $cat->getAllCat();
				if ($getCat) {
					while ($result = $getCat->fetch_assoc()) {
			?>
	  		<li><a href="workerbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
	  	
	  		<?php
				} }	
			?>
	  	</ul>
	  </li>
<?php
	$chkCart = $ct->checkCartTable();
	if ($chkCart) {
?>	
	<li><a href="cart.php">Cart</a></li>	
	<li><a href="payment.php">Payment</a></li>	
<?php	
	}
?>
<?php
	$cmrId = Session::get("cmrId");
	$chkOrder = $ct->checkOrder($cmrId);
	if ($chkOrder) {
?>	
	<li><a href="orderdetails.php">Order</a></li>
<?php	
	}
?>	  
<?php
	$login = Session::get("cuslogin");
	if ($login==true) { 
?>
		 <li><a href="profile.php">Profile</a></li>
<?php	}
?>
	 

	  <li><a href="contact.php">Contact</a></li>
	  <div class="clear"></div>
	</ul>
</div>