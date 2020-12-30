<?php

if($this->session->userdata('user')){

  $user = $this->session->userdata('user');
  //echo $username;

  if($user['role']!="admin"){


?>
<html>
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url().'assets/js/bootstrap.min.css'?>"  type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"  type="text/javascript"></script>
    <title>Sistem Informasi Penduduk</title>



  </head>
<style>
#imaginary_container{
    margin-top:5%; /* Don't copy this */
    margin-left: 20%;
}
.stylish-input-group .input-group-addon{
    background: white !important;
}
.stylish-input-group .form-control{
	border-right:0;
	box-shadow:0 0 0;
	border-color:#ccc;
}
.stylish-input-group button{
    border:0;
    background:transparent;
}

th{
  text-align:center;
}
</style>

  <body class="tengah">

    
    <div id="header" style="background-color:#0060A2;color:#ffffff;">

        <a href="penduduk" style="color:#E1E1E1;text-decoration:none"><span class="glyphicon glyphicon-folder-open"></span> Sistem Informasi Penduduk</a>
      <p style="position: absolute; right: 45px; top:25px; font-size:15px;" > <a onclick="return confirm('Apakah Anda Yakin Ingin Keluar?');" href="<?php echo base_url();?>penduduk/logout" style="color:white;"> LOGOUT </a></p>
    </div>

    <div class="container">
      <?php 
      $cek = $this->session->userdata('terdaftar');
      //echo $username;
    
      if($cek){
        echo "<h2>Data Anda Telah Terdaftar</h2><i>*Gunakan form dibawwah jika ingin melakukan perbaikan atau penghapusan data</i></br>";
        $url = base_url()."penduduk/update";
        $btn = "Update";
        $btn2 = "Delete";
      }
      else{
        echo "<h2>Mendaftarkan Data</h2>";
        $url = base_url()."penduduk/input";
        $btn = "Submit";
        $btn2 = "Reset";
      }
      



      ?>
  
  <?php 
  // var_dump($showData) ;
  // echo $showData['nik'];
  // var_dump($url);
  ?>
  <form class="form-horizontal" action="<?php echo $url;?>" method="POST">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email" >NIK </label>
      <div class="col-sm-6">
        <input required type="text" maxlength="11" minlength="11" class="form-control" id="nik" placeholder="Masukkan NIK" value="<?php if($cek){echo $showData['nik'];} ?>" name="nik">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Nama </label>
      <div class="col-sm-6">          
        <input required type="text" minlength="3" class="form-control" id="nama" placeholder="Masukkan Nama" value="<?php if($cek){echo $showData['nama'];} ?>" name="nama">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Kabupaten </label>
      <div class="col-sm-6">          
        <input required type="text" minlength="3" minlength="3" class="form-control" id="kabupaten" placeholder="Masukkan Kabuoaten" value="<?php if($cek){echo $showData['kabupaten'];}?>" name="kabupaten">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Provinsi </label>
      <div class="col-sm-6">          
        <input required type="text" minlength="3" class="form-control" id="provinsi" placeholder="Masukkan Provinsi" value="<?php if($cek){echo $showData['provinsi'];}?>" name="provinsi">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Tempat Lahir </label>
      <div class="col-sm-6">          
        <input required type="text" minlength="3" class="form-control" id="tmp_lahir" placeholder="Masukkan Tempat Lahir password" value="<?php if($cek){echo $showData['tmp_lahir'];} ?>" name="tmp_lahir">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Tanggal Lahir </label>
      <div class="col-sm-6">          
        <input required type="date" class="form-control" id="tgl_lahir" placeholder="Enter password" value="<?php if($cek){echo $showData['tgl_lahir'];} ?>" name="tgl_lahir">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Jenis Kelamin </label>
      <div class="col-sm-6">
          <select required class="form-control" id="exampleFormControlSelect1" name="jk">
            <option value="laki-laki" <?php if($cek){if($showData['jk']=="laki-laki") echo "selected";} ?> >Laki-laki</option>
            <option value="perempuan" <?php if($cek){if($showData['jk']=="perempuan") echo "selected";} ?> >Perempuan</option>
          
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Alamat </label>
      <div class="col-sm-6">          
      <textarea required class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"><?php if($cek){echo $showData['alamat'];}?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Agama </label>
      <div class="col-sm-6">          
      <select required class="form-control" id="exampleFormControlSelect1" name="agama">
            <option value="islam" <?php if($cek){if($showData['agama']=="islam") echo "selected";} ?> >Islam</option>
            <option value="kristen" <?php if($cek){if($showData['agama']=="kristen") echo "selected";} ?> >Kristen</option>
            <option value="katolik" <?php if($cek){if($showData['agama']=="katolik") echo "selected";} ?> >Katolik</option>
            <option value="budha" <?php if($cek){if($showData['agama']=="budha") echo "selected";} ?> >Budha</option>
            <option value="hindu" <?php if($cek){if($showData['agama']=="hindu") echo "selected";} ?> >Hindu</option>
            <option value="konghucu" <?php if($cek){if($showData['agama']=="konghucu") echo "selected";} ?> >Konghucu</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Status </label>
      <div class="col-sm-6">          
      <select required class="form-control" id="exampleFormControlSelect1" name="status">
            <option value="belum_kawin" <?php if($cek){if($showData['status']=="belum_kawin") echo "selected";} ?> >Belum Kawin</option>
            <option value="kawin" <?php if($cek){if($showData['status']=="kawin") echo "selected";} ?> >Kawin</option>
            <option value="cerai_hidup" <?php if($cek){if($showData['status']=="cerai_hidup") echo "selected";} ?> >Cerai Hidup</option>
            <option value="cerai_mati" <?php if($cek){if($showData['status']=="cerai_mati") echo "selected";} ?> >Cerai Mati</option>
            
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Pekerjaan </label>
      <div class="col-sm-6">          
        <input required type="text" minlength="3" class="form-control" id="pwd" placeholder="Masukkan Pekerjaan" value="<?php if($cek){echo $showData['pekerjaan'];}?>" name="pekerjaan">
      </div>
    </div>



   

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary"><?php echo $btn;?></button>
        <?php
          if($cek){
            $urldelete = base_url()."penduduk/delete";
            ECHO "<a href=\"$urldelete\" class='btn btn-danger' OnClick=\"return confirm('Apakah Anda yakin menghapus data Anda?');\"> $btn2 </a>";
            // echo "<a class='btn btn-danger' href='' onclick='return confirm('Apakah Anda yakin menghapus data Anda?');'>$btn2</a>";
          }else{
            echo " <button type='$btn2'  class='btn btn-danger'> $btn2</button>";
          }
          
        ?>
        
        <!-- <button type="<?php echo $btn2;?>"  class="btn btn-danger"><?php echo $btn2;?></button> -->
      </div>
    </div>
  </form>
</div>


    
          


    <div id="footer" style="background-color:#0060A2;color:#ffffff;">

      Copyrights © 2020 Sistem Informasi Penduduk
    </div>

  </body>
</html>


<?php
}
else{
  $baseurl = base_url().'penduduk/logout';

  // echo $baseurl;
  echo "<script>
  window.location.href='$baseurl';
  </script>";
}

}
else{
  $baseurl = base_url().'penduduk/login';

  // echo $baseurl;
  echo "<script>
  window.location.href='$baseurl';
  </script>";
  
  
}

?>
