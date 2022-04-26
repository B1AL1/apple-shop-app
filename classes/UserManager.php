<?php
class UserManager
{
    public function loginForm()
    {
?>
<p>
<form class='form-text form-control form-floating' method='post' action='index.php'>
    <table class='table table-responsive input-group justify-content-center'>
        <tr>
            <td>Nazwa użytkownika: </td>
            <td><input size='24' type='text' name="userName" placeholder='Nazwa użytkownika'
                    title='Podaj nazwę użytkowanika.' required> </td>
        </tr>
        <tr>
            <td>Hasło: </td>
            <td><input size='24' type='password' name="passwd" placeholder='Password' title='Podaj hasło.' required>
            </td>
        </tr>
    </table>
    <div class='text-center'>
        <p>
            <input class='mt-2 btn btn-outline-dark' type="submit" value="Zaloguj" name="login">
            <button class='mt-2 btn btn-outline-dark' type='button'
                onclick="document.location.href='?site=register'">Rejestracja</button>
        </p>
    </div>
</form>
</p>
<?php
    }

    public function login($db)
    {
        $args =
            [
                'userName' => FILTER_SANITIZE_ADD_SLASHES,
                'passwd' => FILTER_SANITIZE_ADD_SLASHES
            ];
        $dane = filter_input_array(INPUT_POST, $args);
        $login = $dane["userName"];
        $passwd = $dane["passwd"];
        $userId = $db->selectUser($login, $passwd, "users");
        if ($userId >= 0) {
            if (!(isset($_COOKIE[session_name()]))) {
                session_start();
            }
            $db->delete("DELETE FROM LOGGED_IN_USERS WHERE userId='$userId'");
            $date = new DateTime("NOW");
            $db->insert('INSERT INTO LOGGED_IN_USERS (sessionId, userId, lastUpdate) VALUES ("' . session_id() . '","' . $userId . '","' . $date->format('Y-m-d H:i:s') . '")');
        }
        return $userId;
    }

    public function logout($db)
    {
        $sessionId = session_id();
        $db->delete("DELETE FROM LOGGED_IN_USERS WHERE sessionId='$sessionId'");
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }
        session_unset();
        $_SESSION = [];
        if (isset($_COOKIE[session_name()])) {
            session_destroy();
        }
    }

    public function getUser($db, $sessionId)
    {
        if ($result = $db->getMysqli()->query("SELECT * FROM LOGGED_IN_USERS WHERE sessionId='$sessionId'")) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object();
                $id = $row->userId;
            }
            $result->close();
        }
        return $userLogged = $db->select("SELECT * FROM USERS WHERE id=" . $id . "", ["userName", "fullName", "email", "status"]);
    }

    public function getLoggedInUser($db, $sessionId)
    {
        $id = -1;
        if ($result = $db->getMysqli()->query("SELECT * FROM LOGGED_IN_USERS WHERE sessionId='$sessionId'")) {
            $ile = $result->num_rows;
            if ($ile == 1) {
                $row = $result->fetch_object();
                $id = $row->userId;
            }
            $result->close();
        }
        return $id;
    }
}
?>