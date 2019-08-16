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

    <!-- lightbox -->
    <link href="<?=HOME_URI?>/views/_vendors/bootstrap-lightbox/bootstrap-lightbox.min.css" rel="stylesheet">


 <!--Bootstrap fileInput -->
    <link href="<?=HOME_URI?>/views/_vendors/Bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Informações</h4>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <p>Hello world.</p>
          <p>RNC rncrncrnc.</p>
          <p>SACP sacpsacpsacp.</p>
      </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
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
        <a class="navbar-brand" href="<?=HOME_URI?>/home/"><img style="margin-top: -10px;" src="<?= HOME_URI ?>/views/_images/LogoEdelbra.png" width="155" height="40"></a>
    </div>
    <span class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li>
            <a href="<?=HOME_URI?>/home/"> <i class="fa fa-home"></i> Home</a>
        </li>
        <li>
            <a data-toggle="modal" href="#myModal"> <i class="fa fa-info-circle"></i> Informações</a>
        </li>
    </ul>
    <?php if ($this->userdata['tipo_usuario'] == 1) { ?>
      <div class="nav navbar-nav navbar-right" style="margin-top:1%;">

        <span style="color: white;"><?= $this->userdata['nome'] ?></span>

        <button data-toggle="dropdown" class="btn btn-default btn-xs dropdown-toggle" type="button"><span class="caret"></span> </button>

        <ul class="dropdown-menu dropdown-menu-right">


          <li>
              <a data-toggle="modal" href="<?=HOME_URI?>/usuarios/">
                <i class="fa fa-user"></i>
                Usuários
              </a>
          </li>

          <li>
              <a data-toggle="modal" href="<?=HOME_URI?>/setores/">
                <i class="fa fa-users"></i>
                Setores
              </a>
          </li>

          <!-- <li>
              <a href="<?=HOME_URI?>/home/">
                <i class="fa fa-cog"></i>
                Configurações
              </a>
          </li> -->

          <li>
            <a href="<?=HOME_URI?>/login/sair/">
              <i class="fa fa-times-circle"></i>
              Sair
            </a>
          </li>

        </ul>

      </div>
    <?php } else { ?>
      <div class="nav navbar-nav navbar-right">
        <li><p style="margin-top: 14px;">
          <span style="color: white;"><?= $this->userdata['nome'] ?></span>
          </p>
        </li>
        <li>
            <a href="<?=HOME_URI?>/login/sair/">
              <span class="fa fa-times-circle"></span>
              Sair
          </a>
        </li>
      </div>
    <?php } ?>
  </div>
</nav>

<div id=bordasFRONT class="cabecalho" style="margin-top: -21px; ">
      <div class="container-fluid ">
        <img style="max-width: 200px; position: relative;
        display: block; margin-left: auto; margin-right: auto;" src="<?=HOME_URI?>/views/_images/logofull.png"/>
      </div>
    </div>
