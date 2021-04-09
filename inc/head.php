<?php

session_start();

if ($_POST && isset($_POST['loginname'])) {
    $_SESSION['nom'] = $_POST['loginname'];
}
if (isset($_GET['add_to_cart']) && isset($_SESSION['nom']) && !isset($_COOKIE['id_cookie'][$_GET['add_to_cart']])) {
    setcookie("id_cookie[" . $_GET['add_to_cart'] . "]", 1, time() + 24 * 3600);
    header('Location: /');
}
if (isset($_GET['add_to_cart']) && isset($_COOKIE['id_cookie'][$_GET['add_to_cart']])) {
    $num = $_COOKIE['id_cookie'][$_GET['add_to_cart']] + 1;
    setcookie('id_cookie[' . $_GET['add_to_cart'] . ']', $num, time() + 24 * 3600);
    $url = str_replace("?add_to_cart=" . $_GET['add_to_cart'],"",$_SERVER['REQUEST_URI']);
    header('Location:'. $url);
}
if (isset($_GET['remove_from_cart']) && isset($_COOKIE['id_cookie'][$_GET['remove_from_cart']])) {
    $num = $_COOKIE['id_cookie'][$_GET['remove_from_cart']] - 1;
    setcookie('id_cookie[' . $_GET['remove_from_cart'] . ']', $num, time() + 24 * 3600);
    if ($num == 0){
        setcookie('id_cookie[' . $_GET['remove_from_cart'] . ']', $num, time() - 3600);
    }
    $url = str_replace("?remove_from_cart=" . $_GET['remove_from_cart'],"",$_SERVER['REQUEST_URI']);
    header('Location:'. $url);
}
if (isset($_GET['delete_cookie'])) {
    setcookie("id_cookie[" . $_GET['delete_cookie'] . "]", 1, time() - 3600);
    $url = str_replace("?delete_cookie=" . $_GET['delete_cookie'],"",$_SERVER['REQUEST_URI']);
    header('Location:'. $url);
}
if (isset($_GET['session']) && $_GET['session'] =="destroy") {
    session_destroy();
    foreach ($_COOKIE['id_cookie'] as $key => $value ) {
        setcookie( "id_cookie[" . $key . "]", $value, time() - 3600);
    }
    $url = str_replace("?session=" . $_GET['session'],"",$_SERVER['REQUEST_URI']);
    header('Location:'. $url);
}
if (strpos($_SERVER['REQUEST_URI'],'login') && isset($_SESSION['nom'])){
    header('Location: /index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Cookie Factory</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/styles.css"/>
</head>
<body>
<header>
    <!-- MENU ENTETE -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img class="pull-left" src="assets/img/cookie_funny_clipart.png" alt="The Cookies Factory logo">
                    <h1>The Cookies Factory</h1>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Chocolates chips</a></li>
                    <li><a href="#">Nuts</a></li>
                    <li><a href="#">Gluten full</a></li>
                    <li>
                        <a href="/cart.php" class="btn btn-warning navbar-btn">
                            <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>
                            Cart
                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container-fluid text-right">

        <?php if (isset($_SESSION['nom'])) { ?>

            <strong>Hello <?= $_SESSION['nom'] ?>!</strong>
            <br/><a href="?session=destroy" class="btn btn-primary">Log out</a>

        <?php } else { ?>

            <strong>Hello Wilder !</strong>

        <?php } ?>

        <?php if (!strpos($_SERVER['REQUEST_URI'],'login') && !isset($_SESSION['nom'])) { ?>

            <br/><a href="/login.php" class="btn btn-primary">Sign in</a>

        <?php } ?>

    </div>
</header>