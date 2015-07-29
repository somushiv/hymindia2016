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
            <?php
            if (isset($page_title)) {
                echo $page_title;
            } else {
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
                <?php if (!empty($loginuser)){ ?>     
                    <nav class="collapse navbar-collapse bs-navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                        <?php if ($loginuser=='Admin'){?>
                            <li><a href="/admindashboard" ><span class="glyphicon glyphicon-home" /></a></li>  
                         <?php }else {?>  
                         	<li><a href="/dashboard" ><span class="glyphicon glyphicon-home" /></a></li>  
                         <?php }?>
                            <li><a href="/hymindia/logout" >Logout</a></li>                            
                        </ul>
                    </nav>
              <?php }else{ ?>
              
                    <nav class="collapse navbar-collapse bs-navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?php echo base_url(); ?>" ><span class="glyphicon glyphicon-home" /></a></li>
                        </ul>
                    </nav>
                <?php } ?>

            </div>
        </header>

        <div class="main" id="content">
            <div class="container">
                <?php echo $content; ?>
            </div>
        </div>
        <div class="footer2">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="simplenav">
                                <a href="#">Home</a> | 
                                <a href="#">About</a> |
                                <a href="#">Contact</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6 widget">
                        <div class="widget-body">
                            <p class="text-right">
                                Copyright &copy; <?php echo date('Y'); ?>, HYM-India. 
                            </p>
                        </div>
                    </div>
                </div> <!-- /row of widgets -->
            </div>
        </div>
        <!-- Bootstrap core JavaScript
    ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/js/jquery-1.11.0.min.js"></script>

        <script src="/js/bootstrap.min.js"></script>


        <?= $_scripts_loc ?>

    </body>
</html>