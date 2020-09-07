<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="theme-color" content="#00a499" />
	
	<title>PHP Test</title>
	<style type="text/css">
	label[class~="error"]{
	    color:red;
	}
	</style>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo base_url('assets/css/sweetalert.css')?>" rel="stylesheet" rel="stylesheet" type="text/css" media="all">
    <script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.validate.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/additional-methods.min.js')?>"></script>
    <script src="<?php echo base_url('assets/js/sweetalert.js')?>"></script>
    <script src="<?php echo base_url('assets/js/app.js')?>"></script>
    <link href="<?php echo base_url('assets/css/custom.css')?>" rel="stylesheet" rel="stylesheet" type="text/css" media="all">
    <link href="<?php echo base_url('assets/css/responsive.css')?>" rel="stylesheet" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/mystyle.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/zebra_datepicker.min.css');?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datatables.min.css');?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datatables.css');?>" type="text/css">
    <script src="<?php echo base_url('assets/css/zebra_datepicker.min.js');?>"></script>
    <!--for Datatable-->
    <script src="<?php echo base_url('assets/js/datatables.js');?>"></script>
    <script src="<?php echo base_url('assets/js/datatables.min.js');?>"></script>
</head>
<body>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <span class="pull-left"><a class="logo" href="#"><br><br></a>
        </span>
        <button type = "button" class = "navbar-toggle" 
        data-toggle = "collapse" data-target = "#myNavbar">
        <span class = "sr-only">Toggle navigation</span>
        <span class = "icon-bar"></span>
        <span class = "icon-bar"></span>
        <span class = "icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
     <div class="toplogo navbar-right">
    </div>

    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){

      if($_SESSION['role_id']==1){ ?>
        <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="<?php echo site_url('admin/dashboard');?>">Dashboard</a>
          </li>
          <li class="active">
            <a href="<?php echo site_url('logout');?>">logout</a>
          </li>
        </ul> 

        <?php } } else {?>
      <ul class="nav navbar-nav navbar-right">
          <li class="active">
            <a href="<?php echo site_url('/');?>">Login</a>
          </li>
        </ul>
    <?php } ?>
    </div>
  </div>
</nav>