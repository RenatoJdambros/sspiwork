<?php
    if (!defined('ABSPATH')) exit; 
    if ($this->logged_in) {
        echo '<script type="text/javascript">window.location.href = "' . HOME_URI . '/home/";</script>';
    }
?>

<!DOCTYPE html>

<html lang="pt-br">
    <head>	
        <meta charset="utf-8">	
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $this->title; ?></title>	
        <!-- Bootstrap -->
        <link href="<?= HOME_URI ?>/views/_vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?= HOME_URI ?>/views/_vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="<?= HOME_URI ?>/views/_vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="<?= HOME_URI ?>/views/_vendors/animate.css/animate.min.css" rel="stylesheet">

    </head>

    <body style="background-color: gray;">

    <div class="container-fluid " style="max-width: 360px; max-height: 300px; width: auto;">    
        
    <div id="loginbox"> 
        
        <div class="row ">                
            
        
        <div class="panel panel-default"  style="margin-top: 70px;">
            <div class="panel-heading">
                <div class="panel-title text-center"><!-- Icon -->
                
                    <img src="<?= HOME_URI ?>/views/_images/logofull.png" alt="SSPI" style="max-width: 200px;  
                    max-height:200px; width: auto; height: auto; margin-left:1em;">
                </div>
            </div>     

            <div class="panel-body" >

                    <!-- Login Form -->
                    <form action="<?= HOME_URI ?>/login/" method="post" name="frm-login" id="frm-login">
                    <input type="hidden" name="verify" value="on"> 

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control" name="userdata[usuario]" 
                        placeholder="Usuário" required />                                        
                    </div>

                    <br>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="userdata[password]" 
                        placeholder="senha" required />
                    </div> 

                    <br>

                    <div class="form-group">

                        <!-- Button -->
                        <div align="center" >
                            <button type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-log-in"></i> Entrar </button>                          
                        </div>
                    </div>

                </form>     

            </div>                     
         
    

<div style="margin-top: -10px;" class="panel-footer">
   
  </div>
  </div>
  </div>
  </div> 


                 


                </form> <!-- end form -->

                <!-- Error Login -->
                <?php if ($this->login_error) { ?>
                    <div align="center" style="color: white;">
                        <?= $this->login_error; ?>
                    </div>
                <?php } ?>

            </div> <!-- end formContent -->
        
    </body>
</html>
