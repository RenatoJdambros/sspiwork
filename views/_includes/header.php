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
   
    
    <nav class="navbar navbar-inverse" style="border-color: rgb(108,117,125); background-color: rgb(108,117,125);">
  <div class="container-fluid">
  <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
         </button>
        <a class="navbar-brand" href="<?=HOME_URI?>/home/"><img src="<?= HOME_URI ?>/views/_images/LogoEdelbra.png" width="155" height="40"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li>
            <a href="<?=HOME_URI?>/home/"> <i class="glyphicon glyphicon-home"></i> Home</a>
        </li>
        <li>
            <a data-toggle="modal" href="#myModal"> <i class="glyphicon glyphicon-info-sign"></i> Informações</a>
        </li>
        <?php if ($this->check_permissions('usuarios', 'visualizar', $this->userdata['user_permissions'])) { ?>
        <li>
            <a data-toggle="modal" href="<?=HOME_URI?>/usuarios/"> <i class="glyphicon glyphicon-user"></i> Usuários</a>
        </li>
        <?php } ?>
        <?php if ($this->check_permissions('configuracoes', 'visualizar', $this->userdata['user_permissions'])) { ?>
        <li>
            <a href="<?=HOME_URI?>/home/"> <i class="glyphicon glyphicon-console"></i> Configurações</a>
        </li>
        <?php } ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="<?=HOME_URI?>/login/sair/"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
    </ul>
  </div>
</nav> 

<div id=bordasFRONT class="cabecalho" style="margin-top: -21px; ">
      <div class="container-fluid ">
        <img style="max-width: 200px; position: relative; 
        display: block; margin-left: auto; margin-right: auto;" src="<?=HOME_URI?>/views/_images/logofull.png"/>
      </div>
    </div>