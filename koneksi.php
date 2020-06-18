<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_planet_sportcenter_bekasi";

// Koneksi dan memilih database di server
$con=mysqli_connect($server,$username,$password,$database) or die("Koneksi gagal");
//mysqli_select_db($database) or die("Database tidak bisa dibuka");

function dump($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function dd($data){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}

function profil($param='nama_profil'){
    $con=mysqli_connect("localhost","root","","db_planet_sportcenter_bekasi") or die("Koneksi gagal");

    $query = "SELECT $param  FROM profil";
    $exc_query = mysqli_query($con,$query);
    $value = mysqli_fetch_array($exc_query);

    $result = $value[$param]; 

    return $result;
}
?>
