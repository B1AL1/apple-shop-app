<?php

$db = new DataBase("localhost", "root", "", "klienci");

$um = new UserManager();

$ul = $um->getUser($db, session_id());
$temp = explode(" ", $ul);
echo "
<section>
    <div class='container px-4 px-lg-5 my-3'>
        <div class='row gx-4 gx-lg-5 align-items-center'>
            <h1 class='display-5 fw-bolder text-center'>Profil</h1>
            <p class='lead fw-normal'>"; ?>

<table class='table table-responsive input-group justify-content-center'>
    <?php
    if ($temp[3] == 2) {
        echo "
        <tr>
            <form method='post' action='index.php'>
                <input class='btn btn-outline-dark' type='submit' value='Wyloguj niekatywnych użytkowników' name='logoutUsers'>
            </form>
        </tr>
        <tr>
            <td>Status: </td>
            <td>Administrator</td>
        </tr>
        <tr>
            <td>Nazwa użytkownika: </td>
            <td>$temp[0]</td>
        </tr>
        <tr>
            <td>Imię i Nazwisko: </td>
            <td>$temp[1]</td>
        </tr>
        <tr>
            <td>E-mail: </td>
            <td>$temp[2]</td>
        </tr>";
    } else {
        echo "
        <tr>
            <td>Status: </td>
            <td>Użytkownik</td>
        </tr>
        <tr>
            <td>Nazwa użytkownika: </td>
            <td>$temp[0]</td>
        </tr>
        <tr>
            <td>Imię i Nazwisko: </td>
            <td>$temp[1] $temp[2]</td>
        </tr>
        <tr>
            <td>E-mail: </td>
            <td>$temp[3]</td>
        </tr>";
    }
    ?></td>

</table>
<form class='form-text form-control form-floating' method='post' action='index.php'>
    <table class='table table-responsive input-group justify-content-center'>
        <tr>
            <td>Aktualne hasło: </td>
            <td><input size='24' type='password' name="passwd" placeholder='Password' title='Podaj hasło.' required>
            </td>
        </tr>
        <tr>
            <td>Nowe hasło: </td>
            <td><input size='24' type='password' name="newPasswd" placeholder='New password' title='Podaj hasło.'
                    required>
            </td>
        </tr>
    </table>
    <div class='text-center'>
        <p>
            <input class='mt-2 btn btn-outline-dark' type="submit" value="Zmień hasło" name="changePasswd">
        </p>
    </div>
</form>
<?php
echo "  
            </p>
        </div>
    </div>
</section>";