<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>SCH - Sistema de chamados</title>
</head>
<body>
    <?php 
    include "pages/navbar.php";

    if (!isset($_SESSION['username']) OR empty($_SESSION)) {
        include "pages/login.php";
        return;
    }

    if ($_SERVER['REQUEST_URI'] === '/' ) {
        include "pages/inicio.php";
    } else {
        if (!file_exists(__DIR__ . "/pages{$_SERVER['REQUEST_URI']}.php")) {
            include '404.html';
            return;
        }

        include "pages{$_SERVER['REQUEST_URI']}.php";
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>