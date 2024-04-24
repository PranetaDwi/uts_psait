<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<?php
 $nim = $_GET['nim'];
 $kode_mk = $_GET['kode_mk'];
 $curl= curl_init();
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 //Pastikan sesuai dengan alamat endpoint dari REST API di ubuntu
 curl_setopt($curl, CURLOPT_URL, 'http://127.0.0.1:8000/api/uts-sait/get-mahasiswa-update-view/?nim='.$nim.'&kode_mk='.$kode_mk.'');
 $res = curl_exec($curl);
 $json = json_decode($res, true);
//var_dump($json);
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Perbarui Data Mahasiswa</h2>
                    </div>
                    <p>Update Nilai Mahasiswa.</p>
                    <form action="updateNilaiMahasiswaDo.php" method="post">
                        <input type = "hidden" name="nim" value="<?php echo($json["data"][0]["nim"]); ?>">
                        <input type = "hidden" name="kode_mk" value="<?php echo($json["data"][0]["kode_mk"]); ?>">
                        <div class="form-group">
                            <label>Nama Mahasiswa</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo($json["data"][0]["nama"]); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nama Mata Kuliah</label>
                            <input type="text" name="nama_mk" class="form-control" value="<?php echo($json["data"][0]["nama_mk"]); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label>Nilai</label>
                            <input type="text" name="nilai" class="form-control" value="<?php echo($json["data"][0]["nilai"]); ?>">
                        </div>
                        <input type="submit" class="btn btn-info" name="submit" value="Submit">
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>