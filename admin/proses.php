<?php 
session_start();
include "../koneksi.php";

$action = (!isset($_GET['action']))?0:$_GET['action'];

switch ($action) {

    case 'cek-login':

        $username  = $_POST["username"];
        $password = $_POST["password"];

        $query = mysqli_query($con,"SELECT * FROM user WHERE username='$username' AND password='$password'");

        $num_query = mysqli_num_rows($query);
        if($num_query > 0)
        {
            $row =mysqli_fetch_array($query);

            $_SESSION["id"]  = $row["id_user"];
            $_SESSION["nama"]  = $row["nama"];
            $_SESSION["username"]  = $row["username"];

            echo json_encode(array('message'=>'success'));              
        }
        else
        {
            echo json_encode(array('message'=>'failed','result'=>'email password not found'));                  
        }

    break;

    case 'verifikasi-bayar':
        $id_transaksi = $_GET['id'];
        $query1 = "UPDATE transaksi SET status = 'SELESAI' WHERE id_transaksi = '$id_transaksi' ";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'hapus-pelanggan':
        $id_pelanggan = $_GET['id'];
        $query1 = "DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan' ";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'simpan-jenis-lapangan':
        $nama_jenis_lapangan = $_POST['nama_jenis_lapangan'];
        $deskripsi = $_POST['deskripsi'];
        $query1 = "INSERT INTO jenis_lapangan (nama_jenis_lapangan,deskripsi) VALUES ('$nama_jenis_lapangan','$deskripsi')";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'update-jenis-lapangan':
        $id_jenis_lapangan = $_POST['id_jenis_lapangan'];
        $nama_jenis_lapangan = $_POST['nama_jenis_lapangan'];
        $deskripsi = $_POST['deskripsi'];
        $query1 = "UPDATE jenis_lapangan SET nama_jenis_lapangan = '$nama_jenis_lapangan', deskripsi = '$deskripsi' WHERE id_jenis_lapangan = '$id_jenis_lapangan'";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'hapus-jenis-lapangan':
        $id_jenis_lapangan = $_GET['id'];

        $cek = mysqli_num_rows(mysqli_query($con,"SELECT * FROM transaksi_detail INNER JOIN lapangan ON transaksi_detail.id_lapangan = lapangan.id_lapangan INNER JOIN jenis_lapangan ON lapangan.id_jenis_lapangan = jenis_lapangan.id_jenis_lapangan WHERE jenis_lapangan.id_jenis_lapangan = '$id_jenis_lapangan' "));

        if($cek > 0)
        {
            echo json_encode(array('message'=>'failed'));
        }
        else
        {
            $query1 = "DELETE FROM jenis_lapangan WHERE id_jenis_lapangan = '$id_jenis_lapangan'";
            $exc_query1 = mysqli_query($con,$query1);
            echo json_encode(array('message'=>'success'));
        }
    break;

    case 'simpan-lapangan':
        $id_jenis_lapangan = $_POST['jenis_lapangan'];
        $nama_lapangan = $_POST['nama_lapangan'];
        $query1 = "INSERT INTO lapangan (nama_lapangan,id_jenis_lapangan) VALUES ('$nama_lapangan','$id_jenis_lapangan')";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'update-lapangan':
        $id_lapangan = $_POST['id_lapangan'];
        $nama_lapangan = $_POST['nama_lapangan'];
        $query1 = "UPDATE lapangan SET nama_lapangan = '$nama_lapangan' WHERE id_lapangan = '$id_lapangan'";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'hapus-lapangan':
        $id_lapangan = $_GET['id'];

        $cek = mysqli_num_rows(mysqli_query($con,"SELECT * FROM transaksi_detail INNER JOIN lapangan ON transaksi_detail.id_lapangan = lapangan.id_lapangan WHERE lapangan.id_lapangan = '$id_lapangan' "));

        if($cek > 0)
        {
            echo json_encode(array('message'=>'failed'));
        }
        else
        {
            $query1 = "DELETE FROM lapangan WHERE id_lapangan = '$id_lapangan'";
            $exc_query1 = mysqli_query($con,$query1);
            echo json_encode(array('message'=>'success'));
        }
    break;

    case 'simpan-harga':
        $id_lapangan = $_POST['lapangan'];
        $id_waktu = $_POST['waktu'];
        $id_hari = $_POST['hari'];
        $harga = $_POST['harga'];

        $query1 = "DELETE FROM harga WHERE id_lapangan = '$id_lapangan' AND id_waktu = '$id_waktu' AND id_hari = '$id_hari' ";
        $exc_query1 = mysqli_query($con,$query1);

        $query2 = "INSERT INTO harga (id_lapangan,id_waktu,id_hari,harga) VALUES ('$id_lapangan','$id_waktu','$id_hari','$harga')";
        $exc_query2 = mysqli_query($con,$query2);
        echo json_encode(array('message'=>'success'));
    break; 

    case 'simpan-user':
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query1 = "INSERT INTO user (nama,username,password) VALUES ('$nama','$username','$password')";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'update-user':
        $id_user = $_POST['id_user'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $query1 = "UPDATE user SET nama = '$nama', username = '$username', password = '$password' WHERE id_user = '$id_user' ";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'hapus-user':
        $id_user = $_GET['id'];

        $query1 = "DELETE FROM user WHERE id_user = '$id_user'";
        $exc_query1 = mysqli_query($con,$query1);
        echo json_encode(array('message'=>'success'));
    break;

    case 'logout':
        session_destroy();
        echo "<script>window.location='login.html'</script>";
    break;



    default:
        echo json_encode(array('message'=>'action not found'));
    break;
}

?>