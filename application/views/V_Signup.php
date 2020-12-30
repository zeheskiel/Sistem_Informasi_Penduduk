<link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url().'assets/css/login.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url().'assets/js/bootstrap.min.css'?>"  type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"  type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/js/login.js'?>"  type="text/javascript"></script>
  <!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown" style="background-color: rgba(0, 142, 214, 0.2);">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
    <h3> <b style="color:#008ED6;">SISTEM INFORMASI PENDUDUK </b></h3><br/>
      <h4> <b style="color:#E07416;"> SIGN UP </b></h4>
      <!-- <img src="<?php echo base_url().'assets/images/carikodepos.png'?>" style="padding: 10px;" id="icon" alt="User Icon" /> -->
    </div>

    <!-- Login Form -->
    <form method="POST" action="<?php echo base_url();?>penduduk/signup">
      <input type="text" id="login" class="fadeIn second" name="email" placeholder="email">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
</br></br>
      <input type="checkbox" onclick="myFunction()" style="position: absolute; left: 45px; ">  <p style="position: absolute; left: 65px; ">Show Password</p>
      

      </br></br>
      <span style="margin-left:0px;">Captcha : 
        <?php echo $cap_img;?>
      </span> 
    </br>
      <input type="text" id="captcha" class="fadeIn second" name="captcha" placeholder="Masukkan Kode Diatas...">
    </br>
    </br>

      
      <input type="submit" class="fadeIn fourth" style="background-color: blue;"  value="Sign Up">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="<?php echo base_url();?>index.php/penduduk/login">Login</a>
    </div>

  </div>
</div>

