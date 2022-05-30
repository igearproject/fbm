<?php
class upload{
  function foto()
  {
    global $db;
  if(!empty($_POST["upload"] and !empty($_FILES['foto'])))
  {
  //ambil parameter-parameter file yang diupload:  
   //nama, nama temp, ukuran dan type  
   $file_name = $_FILES["foto"]["name"];  
   $file_tmp_name = $_FILES["foto"]["tmp_name"];  
   $file_size = $_FILES["foto"]["size"];  
   $file_type = $_FILES["foto"]["type"];  
   
   //definisikan variabel untuk menangani error saat upload  
   $err_upload=0;  
   
   //pada contoh berikut file akan dipload ke direktori image  
   $dir_upload = "upload/image/";  
   
   //buat nama untuk file hasil upload  
   $file_upload = $dir_upload . basename($file_name); 

   $errorupload="";
   $errorupload1="";
   //cek keberadaan file hasil upload di server  
   if(file_exists($file_upload))  
   {  
        $errorupload.="Maaf, File yang sama sudah ada pada server |";  
        $err_upload=1;  
   }  
   
   //buat batasan maksimal ukuran file yang boleh diupload (dalam byte)  
   $max_size_upload=1000000;   
   
   //cek apakah ukuran file yang diupload melebihi batas  
   if($file_size > $max_size_upload)  
   {  
        $errorupload.="Maaf, Ukuran file yang diupload melebihi ".$max_size_upload." byte |";  
        $err_upload=1;  
   }  
   
   //cek hanya type JPG, GIF dan PNG saja yang diijinkan  
   if(($file_type!="image/jpeg") && ($file_type!="image/gif") && ($file_type!="image/png"))  
   {  
        $errorupload.="Maaf, Hanya file JPG , GIF dan PNG saja yang diperbolehkan |";  
        $err_upload=1;  
   }  
   
   //tampilkan error jika terjadi kesalahan  
   if($err_upload)  
   {  
        $errorupload.="Ada Error, proses upload file batal . ";  
   }  
   //proses upload file jika semua benar  
   else  
   {  
        if(move_uploaded_file($file_tmp_name,$file_upload))  
        {  
             $db->Peringatan( "Proses upload berhasil<br/>",'success');  
        }  
        else  
        {  
             $errorupload1="Proses upload gagal =>";  
        }       
   }  
  }
  
  if(!empty($errorupload)){
    $db->Peringatan($errorupload1." ".$errorupload,'danger');
  }
}
}
?>