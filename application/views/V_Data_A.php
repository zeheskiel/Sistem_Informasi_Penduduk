<?php

if($this->session->userdata('user')){

  $user = $this->session->userdata('user');
  //echo $username;

  if($user['role']=="admin"){


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

    
    <div id="header" style="background-color:#0060A2;color:#ffffff;height:9%;">

        <a href="penduduk" style="color:#E1E1E1;text-decoration:none"><span class="glyphicon glyphicon-folder-open"></span> Sistem Informasi Penduduk (ADMIN)</a>
      <p style="position: absolute; right: 45px; top:25px; font-size:15px;" > <a onclick="return confirm('Apakah Anda Yakin Ingin Keluar?');" href="<?php echo base_url();?>index.php/penduduk/logout" style="color:white;"> LOGOUT </a></p>
    </div>

    <div class="container" style="height:85%;">

    <br/>
      <div class="row" >
        
        <form method="POST" action="<?php echo base_url();?>penduduk/cariData" >
        <div class="col-sm-3" border:1px solid black;>
          <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="cari" value="<?php if(isset($cari)){echo $cari;} ?>">
         
        </div>

       
        <div  class="col-sm-7" >
        <input type="submit" class="btn btn-primary"   value="Cari">
        </div>
        
        <div style="padding-right:0px;" class="col" >
      <a class="btn btn-success" href="<?php echo base_url(); ?>penduduk/export?cari=<?php if(isset($cari)){echo $cari;} ?>" >Export Excel</a>
      </div>

      </div>
      
      
        
      </form>
      <br/>
    
  

    <?php 
          if($showData){
            // var_dump($showData);
          
          
        
        ?>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>NIK</th>
        <th>Nama</th>
        <th>Kabupaten</th>
        <th>Provinsi</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Agama</th>
        <th>Status</th>
        <th>Pekerjaan</th>
      </tr>
    </thead>

    <tbody>
      
        <?php 
        $count = 1;
          foreach($showData as $user){
            echo "<tr>";
            echo "<td>".$user['nik']."</td>";
            echo "<td>".$user['nama']."</td>";
            echo "<td>".$user['kabupaten']."</td>";
            echo "<td>".$user['provinsi']."</td>";
            echo "<td>".$user['tmp_lahir']."</td>";
            echo "<td>".$user['tgl_lahir']."</td>";
            echo "<td>".$user['jk']."</td>";
            echo "<td>".$user['alamat']."</td>";
            echo "<td>".$user['agama']."</td>";
            echo "<td>".$user['status']."</td>";
            echo "<td>".$user['pekerjaan']."</td>";
            echo "</tr>";
            if($count==50){
              break;
            }
            $count++;
            
          }
        
        ?>
        
      

      
    </tbody>

  </table>

  <?php 
          }
    else{
            echo "<h4><i>Data Tidak Ada</i></h4>";
    }
  
  ?>

</div>
  </div>


    
          


    <div id="footer" style="background-color:#0060A2;color:#ffffff;height:6%;">

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
