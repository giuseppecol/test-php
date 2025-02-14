<?php
class AuthController {
    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Validación de datos de entrada
            $data = json_decode(file_get_contents("php://input"));
            if (!isset($data->username) || !isset($data->password)) {
                echo json_encode(["message" => "Usuario o contraseña faltantes."]);
                return;
            }

            // Autenticación
            $user = new User((new Database())->getConnection());
            $user->username = $data->username;
            $user->password = $data->password;

            if ($user->authenticate()) {
                echo json_encode(["message" => "Autenticación exitosa."]);
            } else {
                echo json_encode(["message" => "Credenciales incorrectas."]);
            }
        }
    }
}
