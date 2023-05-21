<?php

require_once 'connection.php';

if (function_exists($_GET['function'])) {
  $_GET['function']();
}

// GET REGISTRASI BY REG. NUMBER
function get_by_reg_num()
{
  global $connection;

  $reg = $_GET["reg"];
  $query =
    "SELECT kode_registrasi AS kode, u.id_user AS id_user, u.nama AS user, d.id_dokter AS id_dokter, d.nama AS dokter FROM registrasi r INNER JOIN user u ON r.id_user=u.id_user INNER JOIN dokter d ON r.id_dokter=d.id_dokter WHERE r.kode_registrasi = $reg";
  $result = mysqli_query($connection, $query);

  if ($result) {
    $data = mysqli_fetch_object($result);

    if (isset($data)) {
      $response = [
        'status' => 1,
        'message' => 'Success',
        'data' => $data
      ];
    } else {
      $response = [
        'status' => 0,
        'message' => 'Data Kosong',
        'data' => []
      ];
    }
  } else {
    $response = [
      'status' => 0,
      'message' => 'Failed',
    ];
  }
  header('Content-Type: application/json');
  echo json_encode($response);
}

// GET LAST NOMOR ANTRIAN
function get_last_antrian()
{
  global $connection;

  $id_dokter = $_GET["id_dokter"];
  $query = "SELECT MAX(nomor_antrian) AS nomor FROM antrian WHERE id_dokter = $id_dokter";

  $result = mysqli_query($connection, $query);

  if ($result) {
    $data = mysqli_fetch_object($result);

    if (isset($data)) {
      $response = [
        'status' => 1,
        'message' => 'Success',
        'data' => $data
      ];
    } else {
      $response = [
        'status' => 0,
        'message' => 'Data Kosong',
        'data' => []
      ];
    }
  } else {
    $response = [
      'status' => 0,
      'message' => 'Failed',
    ];
  }
  header('Content-Type: application/json');
  echo json_encode($response);
}

// ADD TABLE ANTRIAN
function add_antrian()
{
  global $connection;


  $check = [
    'id_user' => '',
    'id_dokter' => '',
    'nomor' => '',
  ];
  $req_body = json_decode(file_get_contents('php://input'), true);
  $check_match = count(array_intersect_key($req_body, $check));

  if ($check_match == count($check)) {
    $id_user = $req_body['id_user'];
    $id_dokter = $req_body['id_dokter'];
    $nomor = $req_body['nomor'];

    $query = "INSERT INTO antrian(id_user, id_dokter, nomor_antrian) VALUES ($id_user, $id_dokter, $nomor)";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $response = [
        'status' => 1,
        'message' => 'Insert Success',
      ];
    } else {
      $response = [
        'status' => 0,
        'message' => 'Error: ' . mysqli_error($connection)
      ];
    }
  } else {
    $response = [
      'status' => 0,
      'message' => 'Wrong Parameter'
    ];
  }
  header('Content-Type: application/json');
  echo json_encode($response);
}

// DELETE REGISTRASI BY REG NUM
function delete_registrasi()
{
  global $connection;

  $reg = $_GET['reg'];
  $query = "DELETE FROM registrasi WHERE kode_registrasi = $reg";

  if (mysqli_query($connection, $query)) {
    $response = [
      'status' => 1,
      'message' => 'Berhasil Meghapus'
    ];
  } else {
    $response = [
      'status' => 0,
      'message' => mysqli_error($connection)
    ];
  }
  header('Content-Type: application/json');
  echo json_encode($response);
}
