<?php if ( ! defined('ABSPATH')) exit; ?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $this->title; ?></title>

	<!-- Bootstrap -->
    <link href="<?=HOME_URI?>/views/_vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=HOME_URI?>/views/_vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=HOME_URI?>/views/_vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=HOME_URI?>/views/_vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="<?=HOME_URI?>/views/_vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?=HOME_URI?>/views/_vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?=HOME_URI?>/views/_vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?=HOME_URI?>/views/_css/style.css" rel="stylesheet">
    <!-- Datatabkes css -->
    <link href="<?=HOME_URI?>/views/_vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="<?=HOME_URI?>/views/_vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?=HOME_URI?>/views/_vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?=HOME_URI?>/views/_vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=HOME_URI?>/views/_vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?=HOME_URI?>/views/_vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?=HOME_URI?>/views/_vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?=HOME_URI?>/views/_vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?=HOME_URI?>/views/_vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"> 
    <link href="<?=HOME_URI?>/views/_css/style.css" rel="stylesheet"> 

    <!-- Dropzone.js -->
    <link href="<?=HOME_URI?>/views/_vendors/dropzone/dist/dropzone.css" rel="stylesheet"> 
    
    <link href="<?=HOME_URI?>/views/_vendors/filestyle/src/jquery-filestyle.css" rel="stylesheet" />

    <link href="<?=HOME_URI?>/views/_vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">

    <link href="<?=HOME_URI?>/views/_vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Informações</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p>Hello world.</p>
          <p>RNC rncrncrnc.</p>
          <p>SACP sacpsacpsacp.</p>
      </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
    
  </head>

<body>  
   
    
    <nav class="navbar navbar-expand-sm navbar-dark justify-content-center" style="background-color: rgb(108,117,125);">
      <a class="navbar-brand" href="<?=HOME_URI?>/home/"><img src="<?= HOME_URI ?>/views/_images/LogoEdelbra.png" width="155" height="40"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" href="<?=HOME_URI?>/home/"><i class="fa fa-home"> Home</i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" href="#myModal"><i class="fa fa-info-circle"> Informações</i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" href="<?=HOME_URI?>/usuarios/"><i class="fa fa-user"> Usuários</i></a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=HOME_URI?>/login/sair/" ><i class="fa fa-sign-out"> Sair</i></a>
          </li>
        </ul>
      </div>
    </nav> 
      
    <div id=bordasFRONT class="cabecalho" >
      <div class="container-fluid ">
        <img style="max-width: 200px; position: relative; 
        display: block; margin-left: auto; margin-right: auto;" src="<?=HOME_URI?>/views/_images/logofull.png"/>
      </div>
    </div>