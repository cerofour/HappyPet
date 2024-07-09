<?php
header("Content-Type: application/json");
require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

switch ($method) {
    case 'GET':
        if (isset($request[0]) && $request[0] == 'citas') {
            if (isset($request[1])) {
                $stmt = $pdo->prepare("SELECT * FROM citas WHERE id = ?");
                $stmt->execute([$request[1]]);
                echo json_encode($stmt->fetch());
            } else {
                $stmt = $pdo->query("SELECT * FROM citas");
                echo json_encode($stmt->fetchAll());
            }
        }
        break;
    case 'POST':
        if (isset($request[0]) && $request[0] == 'citas') {
            $stmt = $pdo->prepare("INSERT INTO citas (nombreMascota, tipoMascota, fecha, hora, motivo) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$input['nombreMascota'], $input['tipoMascota'], $input['fecha'], $input['hora'], $input['motivo']]);
            echo json_encode(['id' => $pdo->lastInsertId()]);
        }
        break;
    case 'PUT':
        if (isset($request[0]) && $request[0] == 'citas' && isset($request[1])) {
            $stmt = $pdo->prepare("UPDATE citas SET nombreMascota = ?, tipoMascota = ?, fecha = ?, hora = ?, motivo = ? WHERE id = ?");
            $stmt->execute([$input['nombreMascota'], $input['tipoMascota'], $input['fecha'], $input['hora'], $input['motivo'], $request[1]]);
            echo json_encode(['success' => true]);
        }
        break;
    case 'DELETE':
        if (isset($request[0]) && $request[0] == 'citas' && isset($request[1])) {
            $stmt = $pdo->prepare("DELETE FROM citas WHERE id = ?");
            $stmt->execute([$request[1]]);
            echo json_encode(['success' => true]);
        }
        break;
}