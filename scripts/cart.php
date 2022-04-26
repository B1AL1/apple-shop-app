<?php
if (isset($_COOKIE[session_name()])) {
    session_start();
}

$path = $_SERVER['DOCUMENT_ROOT'] . "/projektkopia/WWW/classes/";

include $path . 'UserManager.php';
include $path . 'DataBase.php';
include $_SERVER['DOCUMENT_ROOT'] . "/projektkopia/WWW/scripts/functions.php";

$db = new DataBase("localhost", "root", "", "klienci");
$um = new UserManager();
$userId = $um->getLoggedInUser($db, session_id());

echo "
<section class='py-5'>
    <div class='container px-4 px-lg-5 my-5'>
        <div class='row gx-4 gx-lg-5 align-items-center'>
            <h3>Koszyk na produkty</h3>";

if ($userId < 0) {
    echo "Zaloguj się aby dodawać produkty do koszyka!";
} else {
    if (getCartItems($db, $userId) == "") {
        echo "Brak przedmiotów w koszyku!";
    } else {
        echo getCartItems($db, $userId);
    }
}

echo "
        </div>
    </div>
</section>";