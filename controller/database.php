<?php 

class db{
	public $ipserver="127.0.0.1";
	public $dbnama="db_fbm";
	public $user="root";
	public $pass="";

	private function koneksi(){
		try{
			$koneksi= new PDO('mysql:host='.$this->ipserver.';dbname='.$this->dbnama.'',$this->user,$this->pass);
			$koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $koneksi;
		}
		catch(PDOException $error){
			print "Failed to Create Connection >>".$error->getMessage();
			die();
		}

		
	}

	public function MysqlOpen(){
		$con=$this->koneksi();
		if($con){
			return $con;
		}else{
			$this->Peringatan("Connection MySQL Gagal",'danger');
		}
		
	}
	
	public function ReadData($NamaTabel){
		$con=$this->MysqlOpen();
		$perintah=$con->query('select * from '.$NamaTabel);
		$perintah->setFetchMode(PDO::FETCH_ASSOC);
		while($data=$perintah->fetch()){
			$isi[]=$data;
		}
		return $isi;
	}
	public function CariData($NamaTabel,$Kolom,$Nilai){
		$con=$this->MysqlOpen();
		$sql="select * from ".$NamaTabel;
		if(!empty($Kolom) and !empty($Nilai)){
				$sql .= " where ".$Kolom." like '%".$Nilai."%'";
		}
		$perintah=$con->query($sql);
		$perintah->setFetchMode(PDO::FETCH_ASSOC);
		if($perintah->rowCount()>=1){
			
			while($data=$perintah->fetch()){
				$isi[]=$data;
			}
			return $isi;
		}
		else{
			return $isi='kosong';
		}
	}



	public function InputDataPetani($nmpetani, $tgl_lahir, $jenis_kelamin, $agama, $no_hp, $id_regional, $id_user, $foto){
		$con=$this->MysqlOpen();
		$sql="INSERT INTO `petani` ( `nmpetani`, `tgl_lahir`, `jenis_kelamin`, `agama`, `no_hp`, `id_regional`, `id_user`, `foto`) VALUES ('$nmpetani', '$tgl_lahir', '$jenis_kelamin', '$agama', '$no_hp', $id_regional, $id_user, '$foto');";
		$hasil=$con->query($sql);
		if($hasil){
			$this->Peringatan("Proses input Berhasil",'success');
		}
		else{
			$this->Peringatan("Proses input Gagal",'danger');
		}
	}

	public function EditDataPetani($nmpetani, $tgl_lahir, $jenis_kelamin, $agama, $no_hp, $id_regional, $idpetani,$id_user, $foto){
		$con=$this->MysqlOpen();
		$sql="UPDATE `petani` SET `nmpetani`='$nmpetani',`tgl_lahir`='$tgl_lahir',`jenis_kelamin`='$jenis_kelamin',`agama`='$agama',`no_hp`='$no_hp',`id_regional`=$id_regional,`id_user`=$id_user, `foto`='$foto' WHERE `idpetani`=$idpetani;";
		$hasil=$con->query($sql);
		if($hasil){
			$this->Peringatan("Proses Edit  Berhasil",'success');
		}
		else{
			$this->Peringatan("Proses Edit Gagal",'danger');
		}
	}

	public function Peringatan($text,$jenis){
		echo '<div class="alert alert-'.$jenis.'">'.$text.'</div><br/>';
	}

	function ViewDataUsaha(){
	$kdaba=$this->MysqlOpen();
		if(!empty($_SESSION['level']))	{
			if($_SESSION['level']=='admin'){
				$sql=" select * from usaha as a,lahan as b,petani as c where a.id_lahan=b.id_lahan and a.id_petani=c.idpetani";
			}
			else{

				$sql="select * from usaha as a,lahan as b,petani as c where a.id_lahan=b.id_lahan and a.id_petani=c.idpetani and c.id_user=".$_SESSION['id_user'];
			}
		}
		 $hasil=$kdaba->query($sql);
		 return $hasil;
	}
	function ViewDataPetaniUsaha(){
		global $db;
		$kdaba=$db->MysqlOpen();
		if(!empty($_SESSION['level']))	{
			if($_SESSION['level']=='admin'){
				$sql=" select * from petani";
			}
			else{

				$sql=" select * from petani as b where b.id_user=".$_SESSION['id_user'];
			}
		}
		 $hasil=$kdaba->query($sql);
		 return $hasil;
	}

	public function InputDataUsaha(){
		$db=$this->MysqlOpen();
		$petani=$db->query("select * from petani where id_user=".$_SESSION['id_user']."");
		foreach ($petani as $idpetani) {}

		  $sql  = "INSERT INTO `usaha`( `nm_usaha`, `jenis_usaha`, `tgl_mulai`, `tgl_selesai`, `id_petani`, `id_lahan`, `deksripsi`) VALUES ('".$_POST['nm_usaha']."','".$_POST['jenis_usaha']."','".$_POST['tgl_mulai']."','".$_POST['tgl_selesai']."',".$_POST['id_petani'].",".$_POST['id_lahan'].",'".$_POST['deksripsi']."')";
		  
		  $hasil=$db->query($sql); 
		  if($hasil){
				$this->Peringatan("Proses Input  Berhasil",'success');
			}
			else{
				$this->Peringatan("Proses Input Gagal",'danger');
			}
	}

	public function ViewDataUsahaOne($id_usaha){
		$kdaba=$this->MysqlOpen();
		$sql = " select * from usaha where id_usaha = ".$id_usaha; 
		$hasil2 = $kdaba->query($sql);
		while($data=$hasil2->fetch()){
				$isi[]=$data;
			}
		return $isi;
		
	}

	public function UpdateDataUsaha(){
		$kdaba=$this->MysqlOpen();
		$petani=$kdaba->query("select * from petani where id_user=".$_SESSION['id_user']."");
		foreach ($petani as $idpetani) {}
		$sql  = "UPDATE `usaha` SET `nm_usaha`='".$_POST['nm_usaha']."',`jenis_usaha`='".$_POST['jenis_usaha']."',`tgl_mulai`='".$_POST['tgl_mulai']."',`tgl_selesai`='".$_POST['tgl_selesai']."',`id_petani`=".$_POST['id_petani'].",`id_lahan`=".$_POST['id_lahan'].",`deksripsi`='".$_POST['deksripsi']."' WHERE `id_usaha`=".$_POST['id_usaha']."";			  
		$hasil=$kdaba->query( $sql); 
		  if($hasil){
				$this->Peringatan("Proses Edit  Berhasil",'success');
			}
			else{
				$this->Peringatan("Proses Edit Gagal",'danger');
			}
	}

	public function DeleteDataUsaha(){
		$kdaba=$this->MysqlOpen();
		$sql  = " delete from `usaha` where id_usaha = ".$_POST["id_usaha"];
		try{
			$hasil=$kdaba ->query($sql); 
  			if($hasil){
				$this->Peringatan("Proses Edit  Berhasil",'success');
			}
			else{
				$this->Peringatan("Proses Edit Gagal",'danger');
			}
		}		  
  		catch(PDOException $e){
  			$this->Peringatan('Data Usaha Tidak Dapat Dihapus','danger');
  		}			  
  		
	}

	public function ViewUsahaUser(){
		$kdaba=$this->MysqlOpen();
		if(!empty($_SESSION['level']))	{
			if($_SESSION['level']=='admin'){
				$sql=" select * from usaha as a,lahan as b,petani as c where a.id_petani=c.idpetani and a.id_lahan=b.id_lahan";
			}
			else{

				$sql="select * from usaha as a,petani as c where a.id_petani=c.idpetani and c.id_user=".$_SESSION['id_user'];
			}
		}
		 $hasil=$kdaba->query($sql);
		 return $hasil;
	}


}

?>