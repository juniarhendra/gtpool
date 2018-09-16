<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en" ><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" ><!--<![endif]-->

<head>  	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="<?php echo GSASSETS_LOGIN;?>images/favicon.png" type="image/png">

	<title><?php echo $title; ?></title>

	<link href="<?php echo GSASSETS_LOGIN;?>css/login_loader.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="js/html5shiv.js"></script>
	  <script src="js/respond.min.js"></script>
	<![endif]-->

	<script type="text/javascript" charset="utf-8">
	  var base_url   = '<?php echo base_url(); ?>';
	  var index_page = '<?php echo index_page(); ?>/';
	</script>

  </head>
    <body class="fade-in">
    	<!-- start Login box -->
    	<div class="container" id="login-block">
    		<div class="row">
			    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
			       <div class="page-icon-shadow animated bounceInDown" > </div>
			       <div class="login-box clearfix animated flipInY">
			       		<div class="page-icon animated bounceInDown">
			       			 <img  src="<?php echo GSASSETS_LOGIN;?>images/user-icon.png" alt="Key icon" />
			       		</div>
			        	<div class="login-logo">
			        		<img src="<?php echo GSASSETS_LOGIN;?>images/login-logo.png" alt="Company Logo" />
			        		<br/>
			        		<span class="app_name">
			        			<?php echo $app_footer; ?>
			        		</span>
			        	</div>
			        	<hr />
			        	<div class="login-form">
			        		<!-- Start Error box -->
			        		<div class="alert alert-danger <?php echo $error_msg_dsp;?>">
								  <button type="button" class="close" data-dismiss="alert"> &times;</button>
								  Error!
								  <br/>
								  <?php if (!empty($error_msg)){
								  	echo $error_msg;
								  }?>
							</div> <!-- End Error box -->
			        		<form action="<?php echo site_url('auth/login'); ?>" method="post">
						   		 <input type="text" name="username" placeholder="User name" class="input-field uname" required/> 
						   		 <input type="password" name="password" placeholder="Password" class="input-field passwd" required/>
						   		 <input type="hidden" name="login" value="submit" class="login_btn" />
						   		 <button type="submit" name="login_" class="btn btn-login">Login</button>
							</form>
			        	</div>

			       </div>

			    </div>
			</div>
    	</div>
     
      	<!-- End Login box -->
     	<footer class="container">
     		<p id="footer-text"><small>Copyright &copy; 2018 <a href="http://galihsamedia.com"><?php echo $app_footer; ?></a></small></p>
     	</footer>

        <script src="<?php echo GSASSETS_LOGIN;?>js/login_loader.js"></script>

    </body>

</html>
