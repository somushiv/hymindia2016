<?php
date_default_timezone_set('America/Mexico_City');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html   lang="en">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<head>
   <title>
   		<?php if (isset($page_title)){
   				echo $page_title;
   			}else{
   				echo "HYM-India Event";	
   			} 
   			?>
   	</title>
   	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
	<link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!--  <link href="/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" /> -->
	
	

    <link href="/css/custom.css" rel="stylesheet">
   <?= $_scripts ?>   
   <?= $_styles ?>
   
</head>
<body class="pagebackground">
  <header class="navbar navbar-static-top bs-docs-nav hym-header" id="top" role="banner">
  <div class="container ">
    <div class="navbar-header logo-header">
     
      <img src="/images/hym_inida_logo.png" alt="HYM India 2016" title="HYM India 2016" />
    </div>
    <?php 
       
        if (!empty($loginuser)){
    ?>     
    <nav class="collapse navbar-collapse bs-navbar-collapse">
      
      <ul class="nav navbar-nav navbar-right">
        
        <li><a href="/hymindia/logout" >Logout</a></li>
      </ul>
    </nav>
    <?php 
        }
    ?>
  </div>
</header>

<div class="main" id="content">
      <div class="container">
      	 <?php echo $content; ?>
      </div>
</div>
<div class="footer hym-header">
	Copyright HYM-India 2015-2016
</div>
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="/js/jquery-1.11.0.min.js"></script>

<script src="/js/bootstrap.min.js"></script>


<?= $_scripts_loc  ?>

</body>
</html>