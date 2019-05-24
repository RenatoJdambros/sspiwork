
<!DOCTYPE html>
<html lang="pt-br">

<head>	
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
  <!-- Animate.css -->
  <link href="<?=HOME_URI?>/views/_vendors/animate.css/animate.min.css" rel="stylesheet">
</head>

<body>
    <!--classe principal-->

    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
      
          <!-- Icon -->
          <div class="fadeIn first"><br>
          <img src="<?=HOME_URI?>/views/_images/logofull.png" alt="SSPI" style="max-width: 200px;  max-height:200px;  width: auto;
            height: auto;">
          </div>
          <br>
      
          <!-- Login Form -->
          <form action="<?=HOME_URI?>/login/" method="post" name="frm-login" id="frm-login">
              <input type="hidden" name="verify" value="on">
              <div>
                <input type="text" name="userdata[email]" class="form-control" placeholder="E-mail" required />
              </div>
              <div>
                <input type="password" name="userdata[password]" class="form-control" placeholder="Senha" required />
              </div>
            <p></p>
            <input type="submit" class="fadeIn fourth" value="Log In">
          </form>

          <?php
            if ($this->login_error) {
              echo $this->login_error;
            }
				  ?>
        </div>
      </div>
    
       
    
   
    <!--classe principal-->
   

<!-- jQuery (necessario para os plugins Javascript do Bootstrap) -->	
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>	
</html>