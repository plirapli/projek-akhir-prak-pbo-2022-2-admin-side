<?php

require_once 'connection.php';

if (function_exists($_GET['function'])) {
  $_GET['function']();
}

// // GET ORDER
// function get_order()
// {
//   global $connection;

//   $query = "SELECT pesanan.*, user.nama FROM pesanan LEFT JOIN user ON pesanan.id_user = user.id_user";
//   $result = mysqli_query($connection, $query);

//   if ($query) {
//     while ($row = mysqli_fetch_object($result)) {
//       $data[] = $row;
//     }

//     if (isset($data)) {
//       $response = [
//         'status' => 1,
//         'message' => 'Success',
//         'data' => $data
//       ];
//     } else {
//       $response = [
//         'status' => 1,
//         'message' => 'Data Kosong',
//         'data' => []
//       ];
//     }
//   } else {
//     $response = [
//       'status' => 0,
//       'message' => 'Error: ' . mysqli_error($connection),
//     ];
//   }

//   header('Content-Type: application/json');
//   echo json_encode($response);
// }

// GET ORDER BY ID
function get_by_reg_num()
{
  global $connection;

  $reg = $_GET["reg"];
  $query =
    "SELECT kode_registrasi AS kode, u.nama AS user, d.nama AS dokter FROM registrasi r INNER JOIN user u ON r.id_user=u.id_user INNER JOIN dokter d ON r.id_dokter=d.id_dokter WHERE r.kode_registrasi = $reg";
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

// // POST ORDER
// function add_order()
// {
//   global $connection;

//   $req_body = json_decode(file_get_contents('php://input'), true);
//   $id_user = $req_body["id_user"];

//   $query = "INSERT INTO pesanan 
//             VALUE ( '', $id_user, current_timestamp())";
//   $result = mysqli_query($connection, $query);
//   $id = mysqli_query($connection, "SELECT LAST_INSERT_ID() AS id_order");

//   $data = mysqli_fetch_object($id);

//   if ($result) {
//     $response = [
//       'status' => 1,
//       'message' => 'Insert Success',
//       'data' => $data,
//     ];
//   } else {
//     $response = [
//       'status' => 0,
//       'message' => 'Error: ' . mysqli_error($connection)
//     ];
//   }

//   header('Content-Type: application/json');
//   echo json_encode($response);
// }

// // GET TRANSACTION BY ID
// function get_transaction_id()
// {
//   global $connection;

//   $id_order = $_GET["id_order"];
//   $query = "SELECT * FROM transaksi t WHERE t.id_pesanan = $id_order";
//   $result = mysqli_query($connection, $query);

//   if ($query) {
//     while ($row = mysqli_fetch_object($result)) {
//       $data[] = $row;
//     }

//     if (isset($data)) {
//       $response = [
//         'status' => 1,
//         'message' => 'Success',
//         'data' => $data
//       ];
//     } else {
//       $response = [
//         'status' => 1,
//         'message' => 'Data Kosong',
//         'data' => []
//       ];
//     }
//   } else {
//     $response = [
//       'status' => 0,
//       'message' => 'Error: ' . mysqli_error($connection),
//     ];
//   }

//   header('Content-Type: application/json');
//   echo json_encode($response);
// }

// // ADD TO TRANSACTION
// function add_transaction()
// {
//   global $connection;

//   $check = [
//     'id_order' => '',
//     'menu' => '',
//     'qty' => '',
//     'harga' => '',
//   ];
//   $req_body = json_decode(file_get_contents('php://input'), true);
//   $check_match = count(array_intersect_key($req_body, $check));

//   if ($check_match == count($check)) {
//     $id_order = $req_body['id_order'];
//     $menu = $req_body['menu'];
//     $qty = $req_body['qty'];
//     $harga = $req_body['harga'];

//     $command = "INSERT INTO transaksi 
//                 VALUE ( '', '$id_order', '$menu', '$qty', $harga )";
//     $query = mysqli_query($connection, $command);

//     if ($query) {
//       $response = [
//         'status' => 1,
//         'message' => 'Insert Success',
//       ];
//     } else {
//       $response = [
//         'status' => 0,
//         'message' => 'Error: ' . mysqli_error($connection)
//       ];
//     }
//   } else {
//     $response = [
//       'status' => 0,
//       'message' => 'Wrong Parameter'
//     ];
//   }
//   header('Content-Type: application/json');
//   echo json_encode($response);
// }
