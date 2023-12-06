<?php
$host = "172.17.0.2";
$username = "root";
$password = "salupa";
$dbname = "webgis_jayapura";

function getDbConnection() {
    global $host, $username, $password, $dbname;
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function executeQuery($query, $params = [], $isSelect = true) {
    $conn = getDbConnection();
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    if (!empty($params)) {
        $types = str_repeat('s', count($params)); // Assuming all params are strings
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();

    if ($isSelect) {
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $conn->close();
        return $data;
    } else {
        $conn->commit();
        $stmt->close();
        $conn->close();
    }
}

// Membuka dan membaca file JSON
$data = json_decode(file_get_contents("kecamatan.geo.json"), true);

// Mengakses 'geometry' dan 'properties' dari setiap fitur
foreach ($data["features"] as $feature) {
    $geometry = json_encode($feature["geometry"]); // Convert geometry to JSON string
    $properties = $feature["properties"];

    // Mengakses kode_kec, nama dalam 'properties'
    $kode_kec = $properties["kode_kec"];
    $nama = $properties["nama"];

    // Membuat query INSERT
    $query = "INSERT INTO kecamatan (id, nama_kecamatan, peta_kecamatan, created_at) VALUES (?, ?, ST_GeomFromGeoJSON(?), NOW())";

    // Parameter untuk query
    $params = [$kode_kec, $nama, $geometry];

    // Jalankan query INSERT
    executeQuery($query, $params, false);
}
?>
