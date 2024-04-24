<?php

if(isset($_POST['submit']))
{    
$nama = $_POST['nama'];
$mata_kuliah = $_POST['mata_kuliah'];
$nilai = $_POST['nilai'];

//Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
$url='http://127.0.0.1:8000/api/uts-sait/tambah-nilai';
$ch = curl_init($url);
// data yang akan dikirim ke REST api, dengan format json
$jsonData = array(
    'nama' =>  $nama,
    'mata_kuliah' =>  $mata_kuliah,
    'nilai' =>  $nilai
);

//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//pastikan mengirim dengan method POST
curl_setopt($ch, CURLOPT_POST, true);

//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 

//Execute the request
$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

//var_dump($result);
// tampilkan return statusnya, apakah sukses atau tidak
print("<br>");
print("message :  {$result["message"]} "); 
echo "<br>Data Berhasil Dikirim !";
echo "<br><a href=selectNilaiMahasiswaView.php> OK </a>";
}
?>