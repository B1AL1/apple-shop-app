<?php

function walidacja_kontakt()
{
    $args =
        [
            'imie' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
            'nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
            'email' => FILTER_VALIDATE_EMAIL,
            'tekst' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ];

    $dane = filter_input_array(INPUT_POST, $args);

    $errors = "";
    foreach ($dane as $key => $val) {
        if ($val === false or $val === NULL) {
            $errors .= $key . " ";
        }
    }
    if ($errors === "") {
        echo "
        <script type='text/javascript'>
            alert('Wiadomość wysłana!');
        </script>";
    } else {
        echo "
        <script type='text/javascript'>
            alert('Błędne dane: " . $errors . "');
        </script>";
    }
}

function changePassword($userId, $db)
{
    $args =
        [
            'passwd' => FILTER_SANITIZE_ADD_SLASHES,
            'newPasswd' => FILTER_SANITIZE_STRING
        ];
    $dane = filter_input_array(INPUT_POST, $args);
    $newPasswd = password_hash($dane["newPasswd"], PASSWORD_DEFAULT);
    $passwd = $dane["passwd"];

    $sql = "SELECT * FROM users WHERE id='$userId'";
    if ($result = $db->mysqli->query($sql)) {
        $ile = $result->num_rows;
        if ($ile == 1) {
            $row = $result->fetch_object();
            $hash = $row->passwd;
            if (password_verify($passwd, $hash)) {
                $sql = "UPDATE users SET passwd='$newPasswd' WHERE id='$userId'";
                if ($db->mysqli->query($sql)) {
                    echo "
                        <script type='text/javascript'>
                            alert('Hasło zmienione.');
                        </script>";
                } else {
                    echo "
                        <script type='text/javascript'>
                            alert('Błędne hasło.');
                        </script>";
                }
            }
            $result->close();
        }
    }
}

function addToCart($userId, $productName, $price, $db)
{
    $sql = "SELECT * FROM cart WHERE (userId='$userId' AND productName='$productName')";
    if ($result = $db->getMysqli()->query($sql)) {
        $ile = $result->num_rows;
        $row = $result->fetch_object();
        if ($ile > 0) {
            $amount = $row->amount + 1;
            $sql = "UPDATE cart SET amount='$amount' WHERE (userId='$userId' AND productName='$productName')";
        } else {
            $sql = "INSERT INTO cart (userId, productName, productPrice, amount) VALUES ($userId,'$productName', $price , 1)";
        }
        $db->insert($sql);
    }
    $result->close();
}

function getCartItems($db, $userId)
{
    $pola = ['productName', 'productPrice', 'amount'];
    $tresc = "
        <table class='table'><thead>
        <tr>
            <td>Nazwa</td>
            <td>Cena</td>
            <td>Ilość</td>
        </tr>";

    if ($result = $db->getMysqli()->query("SELECT * FROM cart WHERE userId='$userId'")) {

        if (!$result->num_rows) {
            $tresc = "";
            $j = 0;
        } else {
            $ile = count($pola);
            $tresc .= "<tbody>";
            while ($row = $result->fetch_object()) {
                $tresc .= "<tr>";
                $j = $row->productName;
                for ($i = 0; $i < $ile; $i++) {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "
                <td>
                    <form method='post' action='index.php'>
                        <input type='hidden' name='productName' value='$j' />
                        <input class='btn btn-outline-dark' type='submit' value='Usuń' name='deleteFromCart'>
                    </form>
                </td></tr>";
            }
            $result->close();
            $tresc .= "</tbody></table>";
        }
    }
    return $tresc;
}

function deleteFromCart($userId, $productName, $db)
{
    $sql = "DELETE FROM cart WHERE (userId='$userId' AND productName='$productName')";
    $db->getMysqli()->query($sql);
}

function logoutUsers($db)
{
    $sql = "DELETE FROM logged_in_users WHERE lastUpdate < (CURDATE() - INTERVAL -1 HOUR)";
    $db->getMysqli()->query($sql);
}