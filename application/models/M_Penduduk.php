<?php

class M_Penduduk extends CI_Model{

	public $table = 'tbl_kodepos';

  function show($email){

    $sem = $this->db->query("SELECT *FROM data where email='$email' ");
    $data =$sem->result_array();

    return $data;

	}

	function showall(){

		$sem = $this->db->query("SELECT * FROM `data` ORDER BY date_created ASC ");
		$data =$sem->result_array();
	
		return $data;
	
	}

	function cari($cari){

		$sem = $this->db->query("SELECT *FROM data where nik LIKE '%$cari%' OR nama LIKE '%$cari%' OR jk LIKE '%$cari%'");
		$data =$sem->result_array();
	
		return $data;
	
		}
	  

	public function login($email,$password){
		$sem = $this->db->query("SELECT *FROM users where email='$email' AND password='$password' ");
		$data =$sem->result_array();

		return $data;
    }
    
    public function cek($email){
		$sem = $this->db->query("SELECT *FROM data where email='$email'");
		$data =$sem->result_array();

		if($data!=NULL){
			$hsl=true;

		}else{
			$hsl=false;
        }
        
        return $hsl;
	}

	public function signup($email,$password){

		$sem = $this->db->query("SELECT *FROM users where email='$email'");
		$data =$sem->result_array();

		//print_r($data);

		if($data==NULL){
			$input = array(
				'email'=>$email,
				'password'=>$password
			);
		
			$this->db->insert('users',$input);
			$hsl=true;

		}else{
			$hsl=false;
		}
		

		return $hsl;
    }
    
    public function input($input){
        $nik = $input['nik'];
        $sem = $this->db->query("SELECT *FROM data where nik='$nik' ");
		$data =$sem->result_array();

		//print_r($data);

		if($data==NULL){
			
		
			$this->db->insert('data',$input);
			$hsl=true;

		}else{
			$hsl=false;
		}
		

		return $hsl;
	}
	
	public function update($update,$email){

		
		$hsl = $this->db->update('data',$update,$email);
		

		//print_r($data);

		if($hsl){		
		
			return true;
			

		}else{
			return false;
		}
		

		
	}
	
	public function delete($email){

		$hsl = $this->db->delete('data',$email);
		

		//print_r($data);

		if($hsl){		
		
			return true;
			

		}else{
			return false;
		}
	}
}
