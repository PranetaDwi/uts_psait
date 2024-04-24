<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="mt-5 mb-3 clearfix">
                <h2 class="pull-left"> Data Nilai Mahasiswa</h2>
                <a href="insertNilaiMahasiswaView.php" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Nilai Mahasiswa</a>
            </div>
            <div class="scroll">
            <?php
            $curl= curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            //Pastikan sesuai dengan alamat endpoint dari REST API di UBUNTU, 
            curl_setopt($curl, CURLOPT_URL, 'http://127.0.0.1:8000/api/uts-sait/get-data-mahasiswa');
            $res = curl_exec($curl);
            $json = json_decode($res, true);

                    echo '<table class="table table-striped table-dark">';
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th>NIM</th>";
                                echo "<th>Nama</th>";
                                echo "<th>Kode MK</th>";
                                echo "<th>Mata Kuliah</th>";
                                echo "<th>Nilai</th>";
                                echo "<th>Action</th>";
                            echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        for ($i = 0; $i < count($json["data"]); $i++){
                            echo "<tr>";
                                echo "<td> {$json["data"][$i]["nim"]} </td>";
                                echo "<td> {$json["data"][$i]["nama"]} </td>";
                                echo "<td> {$json["data"][$i]["kode_mk"]} </td>";
                                echo "<td> {$json["data"][$i]["nama_mk"]} </td>";
                                echo "<td> {$json["data"][$i]["nilai"]} </td>";
                                echo "<td class='d-flex'>";
                                    echo '<a href="updateNilaiMahasiswaView.php?nim='. $json["data"][$i]["nim"] .'&kode_mk='.$json["data"][$i]["kode_mk"].'" data-toggle="tooltip"><button class="btn btn-warning mr-2">Update</button></a>';
                                    echo '<a href="deleteNilaiMahasiswaDo.php?nim='. $json["data"][$i]["nim"] .'&kode_mk='.$json["data"][$i]["kode_mk"].'" title="Delete Record" data-toggle="tooltip"><button class="btn btn-danger">Hapus</button></a>';
                                echo "</td>";
                            echo "</tr>";
                        }
                        
                        echo "</tbody>";                            
                    echo "</table>";

            curl_close($curl);
            ?>
        </div>
        </div>
    </div>        
</div>

    <p><p><p>
    
   
</body>
</html>