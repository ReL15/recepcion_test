<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookshelf</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro@4cac1a6/css/all.css" rel="stylesheet">

    <!-- Link CSS -->
    <link rel="stylesheet" href="public\css\main.css">
</head>

<body class="bg-primary">
    <main>
        <div class="container position-absolute top-50 start-50 translate-middle">
            <div class="card border-0" style="padding:3rem;">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item " role="presentation">
                            <button class="nav-link active bold" id="pills-login-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login"
                                aria-selected="true">Iniciar Sesion</button>
                        </li>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link bold" id="pills-register-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-register" type="button" role="tab" aria-controls="pills-register"
                                aria-selected="false">Registrarse</button>
                        </li>
                    </ul>
                    <div class="tab-content container form" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel"
                            aria-labelledby="pills-login-tab" tabindex="0">
                            <form action="/public/inc/user_session.php" method="post"
                                style="padding-top:4rem; padding-bottom: 4rem;">
                                <legend class="h3 text-center">Iniciar Sesion</legend>
                                <div class="form-group mb-3">
                                    <label class="label bold" for="username">Usuario</label>
                                    <input type="text" class="form-control text bold" id="username" name="username"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label bold" for="password">Contraseña</label>
                                    <input type="password" class="form-control text bold" id="password" name="password"
                                        placeholder="">
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Entrar</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-register" role="tabpanel"
                            aria-labelledby="pills-register-tab" tabindex="0">
                            <form action="" method="post" style="padding-top:4rem; padding-bottom: 4rem;">
                                <legend class="h3 text-center">Registrarse</legend>
                                <div class="form-group mb-3">
                                    <label class="label bold" for="name">Nombre completo</label>
                                    <input type="text" class="form-control text bold" id="name" name="name"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label bold" for="congregation">Congregacion</label>
                                    <select class="form-select text bold" id="congregation" name="congregation">
                                        <option selected>Seleccione su congregacion</option>
                                        <option value="El Puerto, La Union">El Puerto, La Union</option>
                                        <option value="La Palma, La Union">La Palma, La Union</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label bold" for="group">Grupo</label>
                                    <input type="text" class="form-control text bold" id="group" name="group"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label bold" for="phone">Telefono</label>
                                    <input type="text" class="form-control text bold" id="phone" name="phone"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label bold" for="username">Usuario</label>
                                    <input type="text" class="form-control text bold" id="username" name="username"
                                        placeholder="">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label bold" for="password">Contraseña</label>
                                    <input type="password" class="form-control text bold" id="password" name="password"
                                        placeholder="">
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-primary" type="submit">Registrarse</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>

</html>