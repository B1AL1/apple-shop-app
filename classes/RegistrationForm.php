<?php
class RegistrationForm
{
    protected $user;
    function __construct()
    {
?>
<form class='form-text form-control form-floating' action="index.php" method="post">
    <table class='table table-responsive input-group justify-content-center'>
        <tr>
            <td>Nazwa użytkownika: </td>
            <td><input size='24' type='text' name="userName" placeholder='Nazwa użytkownika'
                    title='Podaj nazwę użytkowanika.' required> </td>
        </tr>
        <tr>
            <td>Imię i nazwisko: </td>
            <td><input size='24' type='text' name="fullName" placeholder='Imię i nazwisko'
                    title='Podaj imię i nazwisko.' required> </td>
        </tr>
        <tr>
            <td>Hasło: </td>
            <td><input size='24' type='password' name="passwd" placeholder='Password' title='Podaj hasło.' required>
            </td>
        </tr>
        <tr>
            <td>E-mail: </td>
            <td><input size='24' type='email' name="email" placeholder='E-mail' title='Podaj Email.' required> </td>
        </tr>
    </table>
    <div class='text-center'>
        <p>
            <input class='mt-2 btn btn-outline-dark' type="submit" value="Zarejestruj" name="registerUser">
        </p>
    </div>
</form>
</p>
<?php
    }

    function checkUser()
    {
        $args =
            [
                'userName' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
                'fullName' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z][a-ząęłńśćźżó]{2,25}[ ][A-Z][a-ząęłńśćźżó]{2,25}$/']],
                'email' => FILTER_VALIDATE_EMAIL,
                'passwd' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^.{8,}$/']]
            ];

        $dane = filter_input_array(INPUT_POST, $args);

        $errors = "";
        foreach ($dane as $key => $val) {
            if ($val === false or $val === NULL) {
                $errors .= $key . " ";
            }
        }

        if ($errors === "") {
            $this->user = new User($dane['userName'], $dane['fullName'], $dane['email'], $dane['passwd']);
        } else {
            $this->user = NULL;
        }

        return $this->user;
    }
}
?>