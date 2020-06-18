<?php 
session_start();
include "koneksi.php";

$action = (!isset($_GET['action']))?0:$_GET['action'];

switch ($action) {

    case 'cek-login':

        $email  = $_POST["email"];
        $password = $_POST["password"];

        $query_cek_email = mysqli_query($con,"SELECT * FROM pelanggan WHERE email='$email' ");
        $num_query_cek_email = mysqli_num_rows($query_cek_email);       

        if($num_query_cek_email > 0)
        {
            $query = mysqli_query($con,"SELECT * FROM pelanggan WHERE email='$email' AND password='$password'");

            $num_query = mysqli_num_rows($query);
            if($num_query > 0)
            {
                $row =mysqli_fetch_array($query);
                $_SESSION["id"]  = $row["id_pelanggan"];
                $_SESSION["nama"]  = $row["nama_pelanggan"];

                echo json_encode(array('message'=>'success'));              
            }
            else
            {
                echo json_encode(array('message'=>'failed','result'=>'email password not found'));                  
            }
        }
        else
        {
            echo json_encode(array('message'=>'failed','result'=>'email not found'));                   
        }

    break;

    case 'tambah-keranjang':
        $id_session = session_id();
        $id_harga  = $_POST['id_harga'];
        $arr_tgl = explode("/",$_POST['tanggal']);
        $tanggal  = $arr_tgl[2]."-".$arr_tgl[1]."-".$arr_tgl[0];
        $tgl_transaksi = date('Y-m-d');

        $query = "INSERT INTO keranjang (id_session,id_harga,tanggal,tgl_transaksi) VALUES ('$id_session','$id_harga','$tanggal','$tgl_transaksi')";
        $exc_query = mysqli_query($con,$query);
        if($exc_query)
        {
            $message = "success";
        }
        else
        {
            $message = "failed";   
        }

        echo json_encode(array('message'=>$message));
    break;

    case 'hapus-keranjang':
        $id_keranjang  = $_GET['id'];

        $query = "DELETE FROM keranjang WHERE id_keranjang = '$id_keranjang' "; 
        $exc_query = mysqli_query($con,$query);
        if($exc_query)
        {
            $message = "success";
        }
        else
        {
            $message = "failed";   
        }

        echo json_encode(array('message'=>$message));
    break;

    case 'simpan-transaksi':

        $id_session = session_id();
        $id_pelanggan = $_SESSION['id'];
        $tgl_transaksi = date('Y-m-d');
        $tahun = date('Y');
        $bulan = date('m');

        $cari_kode  = mysqli_query($con,"SELECT MAX(id_transaksi) AS id FROM transaksi WHERE YEAR(tgl_transaksi) = '$tahun' AND MONTH(tgl_transaksi) = '$bulan' ") or die(mysqli_error());

        if(mysqli_num_rows($cari_kode) < 0)
        {
          $id = $tahun.$bulan."0001";
        }
        elseif (mysqli_num_rows($cari_kode) > 0)
        {
          $value = mysqli_fetch_array($cari_kode);
          $kode     = substr($value["id"],6); 
          $tambah   = intval($kode) + 1;
          if($tambah < 10)
          {
            $id = $tahun.$bulan."000".$tambah;
          }else
          {
            $id = $tahun.$bulan."00".$tambah;
          }
        }

        $query1 = "INSERT INTO transaksi (  
                                            id_transaksi,
                                            id_pelanggan,
                                            status,
                                            tgl_transaksi
                                         ) VALUES (
                                                    '$id',
                                                    '$id_pelanggan',
                                                    'MENUNGGU PEMBAYARAN',
                                                    '$tgl_transaksi'
                                                  ) ";
        $exc_query1 = mysqli_query($con,$query1);

        $query2 = "SELECT * FROM keranjang WHERE id_session = '$id_session' ";
        $exc_query2 = mysqli_query($con,$query2);
        while ($value2 = mysqli_fetch_array($exc_query2)) {
            
            $query3 = " SELECT * FROM harga WHERE id_harga = '$value2[id_harga]' ";
            $exc_query3 = mysqli_query($con,$query3);
            $value3 = mysqli_fetch_array($exc_query3);
            // dump($value3);
            $query4 = "INSERT INTO transaksi_detail (
                                                        id_transaksi,
                                                        tanggal,
                                                        id_hari,
                                                        id_waktu,
                                                        id_lapangan,
                                                        harga
                                                    ) VALUES ( 
                                                                '$id',
                                                                '$value2[tanggal]',
                                                                '$value3[id_hari]',
                                                                '$value3[id_waktu]',
                                                                '$value3[id_lapangan]',
                                                                '$value3[harga]'
                                                              ) "; 
            $exc_query4 = mysqli_query($con,$query4);
        }

        $query5 = "DELETE FROM keranjang WHERE id_session = '$id_session' ";
        $exc_query5 = mysqli_query($con,$query5);

        echo json_encode(array('message'=>'success','result'=>$id));
    break;

    case 'simpan-daftar':

        $nama_pelanggan = $_POST['nama_pelanggan'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query_cek_email = mysqli_query($con,"SELECT * FROM pelanggan WHERE email='$email' ");
        $num_query_cek_email = mysqli_num_rows($query_cek_email);       

        if($num_query_cek_email > 0)
        {
            echo json_encode(array('message'=>'failed','result'=>'email sudah terdaftar'));
        }
        else
        {
            $query1 = "INSERT INTO pelanggan (  
                                                nama_pelanggan,
                                                no_telp,
                                                email,
                                                password
                                             ) VALUES (
                                                        '$nama_pelanggan',
                                                        '$no_telp',
                                                        '$email',
                                                        '$password'
                                                      ) ";
            $exc_query1 = mysqli_query($con,$query1);

            echo json_encode(array('message'=>'success'));
        }

    break;

    case 'simpan-profil':

        $id_pelanggan = $_POST['id_pelanggan'];
        $nama_pelanggan = $_POST['nama_pelanggan'];
        $no_telp = $_POST['no_telp'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query1 = "UPDATE pelanggan SET
                                        nama_pelanggan = '$nama_pelanggan',
                                        no_telp = '$no_telp',
                                        email = '$email',
                                        password = '$password'
                                    WHERE id_pelanggan = '$id_pelanggan' ";
        $exc_query1 = mysqli_query($con,$query1);

        echo json_encode(array('message'=>'success'));

    break;

    case 'batal-transaksi':

        $id_transaksi = $_GET['id'];

        $query1 = "UPDATE transaksi SET status = 'BATAL' WHERE id_transaksi = '$id_transaksi' ";
        $exc_query1 = mysqli_query($con,$query1);

        echo json_encode(array('message'=>'success'));

    break;

    case 'simpan-konfirmasi-bayar':
       
        $id_transaksi = $_POST['no_transaksi'];
        $bank = $_POST['bank'];
        $no_rekening = $_POST['no_rekening'];
        $jumlah_transfer = $_POST['jumlah_transfer'];
        
        $filename = '';
        if(!empty($_FILES['file']['name']))
        {
            $nama3                   = $_FILES['file']['name'];
            $x3                      = explode('.', $nama3);
            $ekstensi3               = strtolower(end($x3));
            $file_tmp3               = $_FILES['file']['tmp_name'];    
            $filename = $id_transaksi.".".$ekstensi3;
            move_uploaded_file($file_tmp3, './images/'.$filename);
        }

        $query1 = "INSERT INTO bayar (
                                        id_transaksi,
                                        bank,
                                        no_rekening,
                                        jumlah_transfer,
                                        file
                                      ) VALUES (
                                                    '$id_transaksi',
                                                    '$bank',
                                                    '$no_rekening',
                                                    '$jumlah_transfer',
                                                    '$filename'
                                                )";
        $exc_query1 = mysqli_query($con,$query1);
        $id_bayar = mysqli_insert_id($con);
        $query2 = "UPDATE transaksi SET status = 'DIPROSES', id_bayar = '$id_bayar'  WHERE id_transaksi = '$id_transaksi' ";
        $exc_query2 = mysqli_query($con,$query2);

        echo json_encode(array('message'=>'success'));

    break;
    case 'logout':

        session_id();
        session_regenerate_id();
        session_id();
        session_destroy();
        echo json_encode(array('message'=>'success'));
    break;



    default:
        echo json_encode(array('message'=>'action not found'));
    break;
}

?>