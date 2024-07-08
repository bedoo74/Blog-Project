<?php
session_start()
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register · Bootstrap</title>
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bd-placeholder-img { font-size: 1.125rem; text-anchor: middle; user-select: none; }
        @media (min-width: 768px) { .bd-placeholder-img-lg { font-size: 3.5rem; } }
        .btn-bd-primary { --bd-violet-bg: #712cf9; --bd-violet-rgb: 112.520718, 44.062154, 249.437846; --bs-btn-font-weight: 600; --bs-btn-color: var(--bs-white); --bs-btn-bg: var(--bd-violet-bg); --bs-btn-border-color: var(--bd-violet-bg); }
        .form-signin { max-width: 330px; padding: 15px; }
        .form-signin .checkbox { font-weight: 400; }
        .form-signin .form-floating:focus-within { z-index: 2; }
        .form-signin input[type="email"] { margin-bottom: -1px; border-bottom-right-radius: 0; border-bottom-left-radius: 0; }
        .form-signin input[type="password"] { margin-bottom: 10px; border-top-left-radius: 0; border-top-right-radius: 0; }
        .form-signin h3 { text-align: center; }
        .alert-warning a { color: #856404; text-decoration: underline; }
    </style>
    <link href="assets/sign-in.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <?php
        function displayError($fieldName) {
            if (!empty($_SESSION["errors"][$fieldName])) {
                echo "<small style='color:red;'>".$_SESSION["errors"][$fieldName]."</small>";
            }
        }
        ?>

        <form action="handel_register.php" method="POST">
            <img class="mb-4 mx-auto d-block" src="assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h3 class="h6 mb-3 fw-normal">Welcome! Sign up now and join us</h3>

            <?php if (!empty($_GET["msg"]) && $_GET["msg"] == 'ar'): ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Alert:</strong> You are already registered. Please <a href="index.php">Login!</a>
                </div>
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Your Name" autocomplete="off">
                <label for="floatingInput">Name</label>
                <?php displayError("name"); ?>
            </div>

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
                <?php displayError("email"); ?>
            </div>

            <div class="form-floating mb-3">
                <input type="tel" name="phone" class="form-control" id="floatingInput" placeholder="Phone Number">
                <label for="floatingInput">Phone</label>
                <?php displayError("phone"); ?>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="pw" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                <?php displayError("pw"); ?>
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="pc" class="form-control" id="floatingPassword" placeholder="Password Confirmation">
                <label for="floatingPassword">Password Confirmation</label>
                <?php displayError("pc"); ?>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Remember me</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 2017–2024</p>
        </form>
    </main>

    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $_SESSION["errors"] = null; ?>
