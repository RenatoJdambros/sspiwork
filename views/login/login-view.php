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

    <body>
        <!--classe principal-->
        <div class="container wrapper fadeInDown">
            <div id="formContent">

                <!-- Icon -->
                <div class="fadeIn first" style="margin: 2.5em 0 1em 0;">
                    <img src="<?= HOME_URI ?>/views/_images/logofull.png" alt="SSPI" style="max-width: 200px;  
                    max-height:200px; width: auto; height: auto; margin-left:1em;">
                </div>

                <!-- Login Form -->
                <form action="<?= HOME_URI ?>/login/" method="post" name="frm-login" id="frm-login">
                    <input type="hidden" name="verify" value="on">


                    <div class="form-group col-md-6">
                        <input type="text" name="userdata[usuario]" class="form-control" 
                        placeholder="Usuário" required />
                    </div>

                    <div class="form-group col-md-6">
                        <input type="password" name="userdata[password]" class="form-control" 
                        placeholder="Senha" required />
                    </div>


                    <button type="submit" class="btn btn-primary" style="margin-left:1em;">Entrar</button>
                </form> <!-- end form -->

                <!-- Error Login -->
                <?php if ($this->login_error) { ?>
                    <div style="margin-left:1em;">
                        <?= $this->login_error; ?>
                    </div>
                <?php } ?>

            </div> <!-- end formContent -->
        </div> <!-- end container -->
    </body>
</html>
