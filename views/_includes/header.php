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
          <br>
        Lorem ipsum tellus vel sapien inceptos fusce ligula lorem, dolor inceptos nec laoreet auctor tortor praesent sit fringilla, dui quam ipsum donec neque sociosqu aenean. sollicitudin pellentesque sapien tempus felis, risus rutrum nibh nisi, risus proin pellentesque. ante arcu venenatis pulvinar egestas felis tellus ut arcu primis quam magna, interdum vestibulum himenaeos nulla vivamus fermentum duis varius sit ultrices ut, tristique primis pulvinar facilisis curae nunc aliquet fames etiam massa. accumsan at auctor congue sed urna ac vestibulum nam erat quisque sodales varius augue, hendrerit aliquet orci sapien sociosqu convallis pulvinar nam semper habitant augue. <br>
        <br>
        Lacus nam non molestie orci magna nibh magna erat, ac habitant mattis proin aenean laoreet purus phasellus, in tortor ultricies potenti lacus at porttitor. mi a egestas vel non eget purus, sem eu tellus eleifend ornare porta proin, dui posuere suspendisse erat turpis. et sem mattis elementum neque adipiscing inceptos, dui placerat euismod pulvinar interdum massa, etiam amet diam etiam ultricies. posuere vivamus suspendisse nec primis libero proin ipsum interdum justo, enim curabitur mauris faucibus in aptent justo sollicitudin, adipiscing accumsan aliquam auctor posuere mattis rutrum vivamus. aenean donec dictum dui gravida adipiscing ut velit inceptos rhoncus, quisque posuere aliquam venenatis ad ultrices tempor nisi, tellus dictumst turpis adipiscing nec suscipit convallis dolor. <br>
        <br>
        Congue ultrices lacinia vestibulum massa ut interdum etiam vehicula suscipit, hac semper nam lectus leo maecenas quisque fermentum consequat, dolor lacinia rhoncus sem quisque class viverra neque. libero rutrum ipsum scelerisque nam commodo volutpat fringilla inceptos, sit eleifend nisl blandit etiam arcu duis viverra torquent, nec rhoncus integer per inceptos turpis volutpat. vestibulum ante vulputate magna scelerisque ipsum primis egestas iaculis volutpat mattis sagittis vel maecenas, lorem at ullamcorper quisque habitasse etiam ultricies at ultricies eget rutrum. fermentum elementum fermentum pellentesque risus hendrerit, dictum luctus taciti ullamcorper at, hac inceptos fermentum aenean. <br>
        <br>  
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
        <a class="navbar-brand" href="<?=HOME_URI?>/home/">HOME</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" href="#myModal">Informações</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="modal" href="<?=HOME_URI?>/login/sair/">Sair</a>
            </li>
          </ul>
          <a class="navbar-brand" href="#"></a>  
        </div>  
        <img src="<?= HOME_URI ?>/views/_images/LogoEdelbra.png" width="155" height="40" class="float-right" >
      </nav> 
      

    <div id=bordasFRONT class="cabecalho" >
      <div class="container-fluid ">
        <img style="max-width: 200px; position: relative; 
        display: block; margin-left: auto; margin-right: auto;" src="<?=HOME_URI?>/views/_images/logofull.png"/>
      </div>
    </div>