<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - API REST en PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ1Q3W8pI7PjM5WeZy6Pno5pR1FtdrzlFb10OJJfX0wCkJfF3H8wq9rXcC3B" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container my-5">
        <header class="text-center mb-4">
            <h1 class="display-4 text-primary">Gestión de Usuarios</h1>
            <p class="lead text-muted">Interfaz para gestionar usuarios mediante API REST en PHP</p>
        </header>

        <!-- Formulario para Crear Usuario -->
        <section class="card shadow-sm p-4 mb-5">
            <h2 class="h4 text-center mb-3">Crear Nuevo Usuario</h2>
            <form id="createUserForm">
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" placeholder="Usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Crear Usuario</button>
            </form>
        </section>

        <!-- Formulario para Actualizar Usuario -->
        <section id="updateUserForm" class="card shadow-sm p-4 mb-5" style="display:none;">
            <h2 class="h4 text-center mb-3">Actualizar Usuario</h2>
            <form id="updateUserFormFields">
                <input type="hidden" id="updateUserId">
                <div class="mb-3">
                    <label for="updateUsername" class="form-label">Nuevo Usuario</label>
                    <input type="text" class="form-control" id="updateUsername" required>
                </div>
                <div class="mb-3">
                    <label for="updatePassword" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="updatePassword" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Actualizar Usuario</button>
                <button type="button" id="cancelUpdate" class="btn btn-secondary w-100 mt-2">Cancelar</button>
            </form>
        </section>

        <!-- Lista de usuarios -->
        <section class="user-cards">
            <h2 class="h4 text-center mb-4">Usuarios Registrados</h2>
            <div id="users" class="row row-cols-1 row-cols-md-3 g-4"></div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Llamar a la API para obtener usuarios
            function fetchUsers() {
                $.get('api.php?action=read', function(response) {
                    const users = JSON.parse(response);
                    $('#users').empty();
                    users.forEach(user => {
                        $('#users').append(`
                            <div class="col">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h5 class="card-title">${user.username}</h5>
                                        <button class="btn btn-warning w-100 mb-2" onclick="editUser(${user.id}, '${user.username}')">Editar</button>
                                        <button class="btn btn-danger w-100" onclick="deleteUser(${user.id})">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                });
            }

            // Crear usuario
            $('#createUserForm').submit(function(e) {
                e.preventDefault();
                const username = $('#username').val();
                const password = $('#password').val();
                $.post('api.php?action=create', JSON.stringify({ username, password }), function(response) {
                    alert(response);
                    fetchUsers();
                });
            });

            // Editar usuario
            window.editUser = function(id, username) {
                $('#updateUserForm').show();
                $('#createUserForm').hide();
                $('#updateUserId').val(id);
                $('#updateUsername').val(username);
            };

            // Cancelar actualización
            $('#cancelUpdate').click(function() {
                $('#updateUserForm').hide();
                $('#createUserForm').show();
            });

            // Actualizar usuario
            $('#updateUserFormFields').submit(function(e) {
                e.preventDefault();
                const id = $('#updateUserId').val();
                const username = $('#updateUsername').val();
                const password = $('#updatePassword').val();
                $.ajax({
                    url: 'api.php?action=update',
                    type: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify({ id, username, password }),
                    success: function(response) {
                        alert(response);
                        fetchUsers();
                        $('#updateUserForm').hide();
                        $('#createUserForm').show();
                    }
                });
            });

            // Eliminar usuario
            window.deleteUser = function(id) {
                $.ajax({
                    url: 'api.php?action=delete',
                    type: 'DELETE',
                    contentType: 'application/json',
                    data: JSON.stringify({ id }),
                    success: function(response) {
                        alert(response);
                        fetchUsers();
                    }
                });
            }

            fetchUsers(); // Inicialmente obtener usuarios
        });
    </script>
</body>
</html>
