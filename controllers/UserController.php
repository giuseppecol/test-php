<?php
class UserController {
    public static function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents("php://input"));
            $user = new User((new Database())->getConnection());
            $user->username = $data->username;
            $user->password = password_hash($data->password, PASSWORD_BCRYPT);

            if ($user->create()) {
                echo json_encode(["message" => "Usuario creado exitosamente."]);
            } else {
                echo json_encode(["message" => "Error al crear el usuario."]);
            }
        }
    }

    public static function read() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = new User((new Database())->getConnection());
            $stmt = $user->read();
            $users = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
            echo json_encode($users);
        }
    }

    public static function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $data = json_decode(file_get_contents("php://input"));
            $user = new User((new Database())->getConnection());
            $user->id = $data->id;
            $user->username = $data->username;
            $user->password = password_hash($data->password, PASSWORD_BCRYPT);

            if ($user->update()) {
                echo json_encode(["message" => "Usuario actualizado."]);
            } else {
                echo json_encode(["message" => "Error al actualizar."]);
            }
        }
    }

    public static function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $data = json_decode(file_get_contents("php://input"));
            $user = new User((new Database())->getConnection());
            $user->id = $data->id;

            if ($user->delete()) {
                echo json_encode(["message" => "Usuario eliminado."]);
            } else {
                echo json_encode(["message" => "Error al eliminar."]);
            }
        }
    }
}
