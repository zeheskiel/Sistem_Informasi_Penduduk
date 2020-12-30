<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Penduduk extends CI_Controller {

    //$global = array();

    function __construct() {
        parent::__construct();
        $this->load->Model('M_Penduduk');
        
    }

    public function index(){
        $cap = $this->buat_captcha();
        $data['cap_img'] = $cap['image'];
        $this->session->set_userdata('kode_captcha', $cap['word']);
        // var_dump($cap);
        // echo $this->session->userdata('kode_captcha');

        $this->load->view('V_Login',$data);
    }

    function login(){
        if(isset($_POST['email']) 
        && isset($_POST['password'])
        && isset($_POST['captcha'])){

            
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $captcha = $this->input->post('captcha');

            // echo $this->session->userdata('kode_captcha');
            // echo $captcha;

            if($this->session->userdata('kode_captcha') === $captcha){


                $password = md5($password);
           
            $data = $this->M_Penduduk->login($email,$password);

            


            if($data!=NULL){
               


                $this->session->set_userdata('user',$data[0]);

                echo "<script>
    
                    alert('Selamat datang !');
            
                </script>"; 
            
                if($data[0]['role']=="admin"){

                    $data = $this->M_Penduduk->showall();
                    if($data){
                        $hasil['showData'] = $data; 
                    }
                    else{
                        $hasil['showData'] = NULL;
                    }

                    $this->load->view('V_Data_A',$hasil);
                }
                else{
                    //sudah mendaftar atau belum
                    $cek = $this->M_Penduduk->cek($email);

                    // var_dump($cek);
                    
                    $this->session->set_userdata('terdaftar',$cek);

                    if($cek){
                        //kirim data
                        $show = $this->M_Penduduk->show($email);
                        $showData['showData'] = $show[0];

                        // var_dump($show);
                        $this->load->view('V_Data', $showData);
                    }
                    else{
                        $this->load->view('V_Data');
                    }

                    
                }
        }else{
            //echo "Username atau Password Salah!";
            echo "<script>
            
              alert('Email atau Password Salah!');
            
            </script>";
            $cap = $this->buat_captcha();
            $data['cap_img'] = $cap['image'];
            $this->session->set_userdata('kode_captcha', $cap['word']);
            $this->load->view('V_Login',$data);    
        
            


            }
        }else{
            echo "<script>
            
              alert('Kode Captcha Salah!');
            
            </script>";
            
            $cap = $this->buat_captcha();
            $data['cap_img'] = $cap['image'];
            $this->session->set_userdata('kode_captcha', $cap['word']);
            // var_dump($cap);
            $this->load->view('V_Login',$data);    
        }

            

            
    }else{

        $cap = $this->buat_captcha();
        $data['cap_img'] = $cap['image'];
        $this->session->set_userdata('kode_captcha', $cap['word']);
        // var_dump($cap);
        
        // $this->load->view('V_Login',$data);

        $this->load->view('V_Login',$data);  
    }
        
            
            

        
    }

    public function buat_captcha(){
        $vals = array(
            'img_path' => 'captcha/',
            'img_url' => base_url().'captcha/',
            'font_path' => FCPATH . 'captcha/font/1.ttf',
            'font_size' => 40,
            'img_width' => '200',
            'img_height' => 40,
            'expiration' => 7200
        );
        $cap = create_captcha($vals);
        return $cap;
    }


    function signup(){
        if(isset($_POST['email']) 
        && isset($_POST['password'])
        && isset($_POST['captcha'])){
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $captcha = $this->input->post('captcha');

            if($this->session->userdata('kode_captcha') === $captcha){

            $password = md5($password);

            $data = $this->M_Penduduk->signup($email,$password);

            if($data){
                echo "<script>
                
                alert('Email atau Password Berhasil Didaftarkan, Silahkan Melakukan LOGIN!');
              
              </script>";
                $cap = $this->buat_captcha();
                $data1['cap_img'] = $cap['image'];
                $this->session->set_userdata('kode_captcha', $cap['word']);
                // var_dump($cap);
                $this->load->view('V_Login',$data1);
            }
            else{
                echo "<script>
                
                alert('Email Sudah Terdaftar!');
              
              </script>";

                $cap = $this->buat_captcha();
                $data1['cap_img'] = $cap['image'];
                $this->session->set_userdata('kode_captcha', $cap['word']);
                // var_dump($cap);
                $this->load->view('V_Signup',$data1);
            }
        }else{
            echo "<script>
            
              alert('Kode Captcha Salah!');
            
            </script>";
            
            $cap = $this->buat_captcha();
            $data['cap_img'] = $cap['image'];
            $this->session->set_userdata('kode_captcha', $cap['word']);
            // var_dump($cap);
            $this->load->view('V_Signup',$data); 
        }
            


            }
            else{
                $cap = $this->buat_captcha();
                $data['cap_img'] = $cap['image'];
                $this->session->set_userdata('kode_captcha', $cap['word']);

                $this->load->view('V_Signup',$data);

            }
            

        
    }

    function logout(){
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('terdaftar');
        $this->session->unset_userdata('kode_captcha');

        $this->login();
    }

   


    function input(){
        if(isset($_POST['nik']) 
        && isset($_POST['nama'])
        && isset($_POST['kabupaten'])
        && isset($_POST['provinsi'])
        && isset($_POST['tmp_lahir'])
        && isset($_POST['tgl_lahir'])
        && isset($_POST['jk'])
        && isset($_POST['alamat'])
        && isset($_POST['agama'])
        && isset($_POST['status'])
        && isset($_POST['pekerjaan'])
        ){
            
            
            $nik = $this->input->post('nik');
            $nama = $this->input->post('nama');
            $kabupaten = $this->input->post('kabupaten');
            $provinsi = $this->input->post('provinsi');
            $tmp_lahir = $this->input->post('tmp_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $jk = $this->input->post('jk');
            $alamat = $this->input->post('alamat');
            $agama = $this->input->post('agama');
            $status = $this->input->post('status');
            $pekerjaan = $this->input->post('pekerjaan');

            $user = $this->session->userdata('user');
           
            // var_dump($cek);
            //echo $username;
            
            
            $t=time();
           
            $input = array(
				'nik'=>$nik,
                'nama'=>$nama,
                'kabupaten'=>$kabupaten,
                'provinsi'=>$provinsi,
                'tmp_lahir'=>$tmp_lahir,
                'tgl_lahir'=>$tgl_lahir,
                'jk'=>$jk,
                'alamat'=>$alamat,
                'agama'=>$agama,
                'status'=>$status,
                'pekerjaan'=>$pekerjaan,
                'date_created'=>date("Y-m-d",$t),
                'email'=>$user['email']
               
            );
            
           

            $data = $this->M_Penduduk->input($input);

            $hasil['showData'] = $input;
           

            if($data){
                echo "<script>
                
                alert('Data Berhasil Didaftarkan!');
              
              </script>";
              $this->session->set_userdata('terdaftar',true);
              $this->load->view('V_Data',$hasil);
            }
            else{
                echo "<script>
                
                alert('Data Dagal Didaftarkan!');
              
              </script>";

              $this->load->view('V_Data',$hasil);
            }

            


            }
            // else{
            //     $this->load->view('V_Data');

            // }
    }

    function update(){
        if(isset($_POST['nik']) 
        && isset($_POST['nama'])
        && isset($_POST['kabupaten'])
        && isset($_POST['provinsi'])
        && isset($_POST['tmp_lahir'])
        && isset($_POST['tgl_lahir'])
        && isset($_POST['jk'])
        && isset($_POST['alamat'])
        && isset($_POST['agama'])
        && isset($_POST['status'])
        && isset($_POST['pekerjaan'])
        ){
            
            
            $nik = $this->input->post('nik');
            $nama = $this->input->post('nama');
            $kabupaten = $this->input->post('kabupaten');
            $provinsi = $this->input->post('provinsi');
            $tmp_lahir = $this->input->post('tmp_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $jk = $this->input->post('jk');
            $alamat = $this->input->post('alamat');
            $agama = $this->input->post('agama');
            $status = $this->input->post('status');
            $pekerjaan = $this->input->post('pekerjaan');

            $user = $this->session->userdata('user');
            $cek = $this->session->userdata('terdaftar');
            //echo $username;
            
            
           
            $update = array(
				'nik'=>$nik,
                'nama'=>$nama,
                'kabupaten'=>$kabupaten,
                'provinsi'=>$provinsi,
                'tmp_lahir'=>$tmp_lahir,
                'tgl_lahir'=>$tgl_lahir,
                'jk'=>$jk,
                'alamat'=>$alamat,
                'agama'=>$agama,
                'status'=>$status,
                'pekerjaan'=>$pekerjaan
               
            );
            
            
            $email = array(
                'email' => $user['email']
            );
           
            // var_dump($email);

            $data = $this->M_Penduduk->update($update,$email);

            $hasil['showData'] = $update;
            $hasil['cek'] = $cek;

            if($data){
                echo "<script>
                
                alert('Data Berhasil Diperbarui!');
              
              </script>";
              $this->load->view('V_Data',$hasil);
            }
            else{
                echo "<script>
                
                alert('Data Dagal Diperbarui!');
              
              </script>";

              $this->load->view('V_Data',$hasil);
            }

            


            }
            // else{
            //     $this->load->view('V_Data');

            // }
    }

    function delete(){
        
        
        $user = $this->session->userdata('user');
        $email = array(
            'email' => $user['email']
        );
        $hsl = $this->M_Penduduk->delete($email);

        if($hsl){
            echo "<script>
            
            alert('Data Berhasil Dihapus!');
          
          </script>";
          $this->session->unset_userdata('terdaftar');
          $this->load->view('V_Data');
        }
        else{
            echo "<script>
            
            alert('Data Dagal Dihapus!');
          
          </script>";

          $this->load->view('V_Data');
        }
    }

    function cariData(){
        if(isset($_POST['cari'])){
            $cari = $this->input->post('cari');{
            $data = $this->M_Penduduk->cari($cari);
            $hasil['cari'] = $cari;

                if($data){
                    $hasil['showData'] = $data; 
                }
                else{
                    $hasil['showData'] = NULL;
                }

                $this->load->view('V_Data_A',$hasil);
            }
        }
       
    }

    function export(){
        if(isset($_GET['cari'])){
            $cari = $this->input->get('cari');
            $data = $this->M_Penduduk->cari($cari);
            
        }
        else{
            $data = $this->M_Penduduk->showall();
        }

        if($data){

            include_once APPPATH.'/third_party/PHP_XLSXWriter-master/xlsxwriter.class.php';
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE);

            $filename = "report-".date('d-m-Y-H-i-s').".xlsx";
            header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');

            $styles = array('widths'=>[3,20,30,20,20,20,20,20,50,20,20,20,20], 'font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'center', 'border'=>'left,right,top,bottom');
            $styles2 = array( ['font'=>'Arial','font-size'=>10,'font-style'=>'bold', 'fill'=>'#eee', 'halign'=>'left', 'border'=>'left,right,top,bottom']);

            $header = array(
                'No'=>'integer',
                'NIK'=>'string',
                'Nama'=>'string',
                'Kabupaten'=>'string',
                'Provinsi'=>'string',
                'Tempat Lahir'=>'string',
                'Tanggal Lahir'=>'string',
                'Jenis Kelamin'=>'string',
                'Alamat'=>'string',
                'Agama'=>'string',
                'Status'=>'string',
                'Pekerjaan'=>'string'
            );

            $writer = new XLSXWriter();
            //penulis
            $user = $this->session->userdata('user');
            $writer->setAuthor($user['email']);

            $writer->writeSheetHeader('Sheet1', $header, $styles);
            $no = 1;
            foreach($data as $row){
                $writer->writeSheetRow('Sheet1', [$no, $row['nik'], $row['nama'], $row['kabupaten'], $row['provinsi'], $row['tmp_lahir'], $row['tgl_lahir'], $row['jk'], $row['alamat'], $row['agama'], $row['status'], $row['pekerjaan']], $styles2);
                $no++;
            }
            $writer->writeToStdOut();
        }
        

    }



}

?>
