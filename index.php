<?php
if (isset($_COOKIE[session_name()])) {
    session_start();
}

include 'classes/Site.php';
include 'classes/UserManager.php';
include 'classes/User.php';
include 'classes/RegistrationForm.php';
include 'classes/DataBase.php';
include 'scripts/functions.php';
$site_akt = new Site();

$um = new UserManager();

$db = new DataBase("localhost", "root", "", "klienci");

if (filter_input(INPUT_GET, "action") == "logout") {
    $um->logout($db);
    header("Location:index.php");
}

if (filter_input(INPUT_POST, "wyslij_kontakt")) {
    walidacja_kontakt();
}

$userId = $um->getLoggedInUser($db, session_id());

if (filter_input(INPUT_POST, "changePasswd")) {
    changePassword($userId, $db);
}

if (filter_input(INPUT_POST, "logoutUsers")) {
    logoutUsers($db);
    echo "
        <script type='text/javascript'>
            alert('Wylogowano nieaktywynych użytkowników!');
        </script>";
}

if (filter_input(INPUT_GET, "action")) {
    if ($userId > 0) {
        $temp = filter_input(INPUT_GET, "action");
        switch ($temp) {
            case 'addip11':
                addToCart($userId, "iPhone 11", 2599, $db);
                break;
            case 'addip12':
                addToCart($userId, "iPhone 12", 3599, $db);
                break;
            case 'addip12mini':
                addToCart($userId, "iPhone 12 mini", 3149, $db);
                break;
            case 'addip13':
                addToCart($userId, "iPhone 13", 4199, $db);
                break;
            case 'addip13mini':
                addToCart($userId, "iPhone 13 mini", 3599, $db);
                break;
            case 'addip13pro':
                addToCart($userId, "iPhone 13 pro", 5199, $db);
                break;
            case 'addip13promax':
                addToCart($userId, "iPhone 13 pro max", 5699, $db);
                break;
            case 'addipse':
                addToCart($userId, "iPhone SE", 2199, $db);
                break;
            case 'addwatch6':
                addToCart($userId, "Apple Watch 6", 1899, $db);
                break;
            case 'addwatch7':
                addToCart($userId, "Apple Watch 7", 1899, $db);
                break;
            case 'addwatch7nike':
                addToCart($userId, "Apple Watch 7 Nike", 1999, $db);
                break;
            case 'addwatchse':
                addToCart($userId, "Apple Watch SE", 1299, $db);
                break;
        }
    } else {
        echo "
            <script type='text/javascript'>
                alert('Zaloguj się, aby dodawać przedmioty do koszyka!');
            </script>";
    }
}

if (filter_input(INPUT_GET, 'site')) {
    $site = filter_input(INPUT_GET, 'site');
    switch ($site) {
        case 'iPhone_11':
            $site = 'iPhone_11';
            break;
        case 'iPhone_12':
            $site = 'iPhone_12';
            break;
        case 'iPhone_12_mini':
            $site = 'iPhone_12_mini';
            break;
        case 'iPhone_13':
            $site = 'iPhone_13';
            break;
        case 'iPhone_13_mini':
            $site = 'iPhone_13_mini';
            break;
        case 'iPhone_13_pro':
            $site = 'iPhone_13_pro';
            break;
        case 'iPhone_13_pro_max':
            $site = 'iPhone_13_pro_max';
            break;
        case 'iPhone_SE':
            $site = 'iPhone_SE';
            break;
        case 'Watch_6':
            $site = 'Watch_6';
            break;
        case 'Watch_7':
            $site = 'Watch_7';
            break;
        case 'Watch_7_nike':
            $site = 'Watch_7_nike';
            break;
        case 'Watch_SE':
            $site = 'Watch_SE';
            break;
        case 'register':
            if ($userId < 0) {
                $site = 'register';
            } else {
                header("Location:index.php");
            }
            break;
        default:
            $site = 'main';
    }
} else {
    $site = "main";
}

$file = "scripts/" . $site . ".php";

if (filter_input(INPUT_POST, 'register', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    if (file_exists($file)) {
        $site_akt->show_heading();
        $site_akt->show_menu($userId);
        echo "<div id='main'>";
        include 'scripts/register.php';
        echo "</div>";
        $site_akt->show_footer();
    }
    $user = $rf->checkUser();
    if ($user === NULL) {
        echo "
                <script type='text/javascript'>
                    alert('Niepoprawne dane rejestracji.');
                </script>";
    } else {
        echo "
                <script type='text/javascript'>
                    alert('Poprawne dane rejestracji.');
                </script>";
        $user->saveDB($db);
    }
}

if (filter_input(INPUT_POST, "login")) {
    $userId = $um->login($db);
    if ($userId > 0) {
        if ($file == "scripts/main.php") {
            if (file_exists($file)) {
                $site_akt->show_heading();
                $site_akt->show_menu($userId);
                echo "<div id='main'>";
                include 'scripts/main.php';
                echo "</div>";
                $site_akt->show_footer();
            }
        } else {
            if (file_exists($file)) {
                include $file;
                $site_akt->set_content($content);
                $site_akt->show($userId);
            }
        }
    } else {
        if (file_exists($file)) {
            $site_akt->show_heading();
            $site_akt->show_menu($userId);
            echo "<div id='main'>";
            echo "</div>";
            $site_akt->show_footer();
        }
        echo "
        <script type='text/javascript'>
            $.ajax({
                url: \"scripts/login.php\",
                success: function(result) {
                    $(\"#main\").html(result);
                }
            });
            alert('Błędna nazwa użytkownika lub hasło!');
        </script>";
    }
} else if (filter_input(INPUT_POST, 'registerUser', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    if (file_exists($file)) {
        $site_akt->show_heading();
        $site_akt->show_menu($userId);
        echo "<div id='main'>";
        include 'scripts/register.php';
        echo "</div>";
        $site_akt->show_footer();
    }
    $user = $rf->checkUser();
    if ($user === NULL) {
        echo "
                <script type='text/javascript'>
                    alert('Niepoprawne dane rejestracji.');
                </script>";
    } else {
        echo "
                <script type='text/javascript'>
                    alert('Poprawne dane rejestracji.');
                </script>";
        $user->saveDB($db);
    }
} else if (filter_input(INPUT_GET, "action") == "profile") {
    if ($userId < 0) {
        header("Location:index.php");
    } else {
        if (file_exists($file)) {
            $site_akt->show_heading();
            $site_akt->show_menu($userId);
            echo "<div id='main'>";
            include 'scripts/profile.php';
            echo "</div>";
            $site_akt->show_footer();
        }
    }
} else if (filter_input(INPUT_POST, "deleteFromCart")) {
    $productName = filter_input(INPUT_POST, "productName");
    deleteFromCart($userId, $productName, $db);

    if (file_exists($file)) {
        $site_akt->show_heading();
        $site_akt->show_menu($userId);
        echo "<div id='main'>";
        echo "</div>";
        $site_akt->show_footer();
    }
    echo "
        <script type='text/javascript'>
            $.ajax({
                url: \"scripts/cart.php\",
                success: function(result) {
                    $(\"#main\").html(result);
                }
            });
        </script>";
} else {
    if ($file == "scripts/main.php") {
        if (file_exists($file)) {
            $site_akt->show_heading();
            $site_akt->show_menu($userId);
            echo "<div id='main'>";
            include 'scripts/main.php';
            echo "</div>";
            $site_akt->show_footer();
        }
    } else {
        if (filter_input(INPUT_GET, "site") == "register") {
            if (file_exists($file)) {
                $site_akt->show_heading();
                $site_akt->show_menu($userId);
                echo "<div id='main'>";
                include 'scripts/register.php';
                echo "</div>";
                $site_akt->show_footer();
            }
        } else {
            if (file_exists($file)) {
                include $file;
                $site_akt->set_content($content);
                $site_akt->show($userId);
            }
        }
    }
}