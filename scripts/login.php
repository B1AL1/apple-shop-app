<?php
$path = $_SERVER['DOCUMENT_ROOT'] . "/projektkopia/WWW/classes/";

include $path . 'User.php';
include $path . 'DataBase.php';
include $path . 'UserManager.php';

$db = new DataBase("localhost", "root", "", "klienci");

$um = new UserManager();

echo "
<section>
    <div class='container px-4 px-lg-5 my-3'>
        <div class='row gx-4 gx-lg-5 align-items-center'>
            <h1 class='display-5 fw-bolder text-center'>Logowanie</h1>
            <p class='lead fw-normal'>";
$um->loginForm();
echo "  
            </p>
        </div>
    </div>
</section>";