<?php
echo "
<section class='py-3'>
    <div class='container px-4 px-lg-5 my-5'>
        <div class='row gx-4 gx-lg-5 align-items-center'>
            <div class='col-md-12 mb-5'>
                <h2>Opis projektu:</h2>
                Strona Sklepu Apple napisana na potrzeby projektu z przedmiotu Programowanie Aplikacji Internetowych na 3 roku IIST IO 3.5.<br>Autor: Konrad Kalman<br>Prowadzący zajęcia: dr Mariusz Dzieńkowski
            </div>
            <div class='col-md-6'>
                <table>
                    <tr>
                        <td class='fw-bolder'>Politechnika Lubelska</td>
                    </tr>
                    <tr>
                        <td>ul. Nadbystrzycka 38 D</td>
                    </tr>
                    <tr>
                        <td>20 – 618 Lublin</td>
                    </tr>
                    <tr>
                        <td>E-mail: politechnika@pollub.pl</td>
                    </tr>
                    <tr>
                        <td>NIP: 712-010-46-51</td>
                    </tr>
                    <tr>
                        <td>Biuro Podawcze – 81 5384140</td>
                    </tr>
                    <tr>
                        <td>Skrytka ePUAP: /PolLub/SkrytkaESP</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<section class='py-3'>
    <div class='container col-lg-5 col-md-6 px-4 px-lg-5 my-3'>
        <div class='row gx-4 gx-lg-5 align-items-center'>
            <form class='form-text form-control form-floating' method='POST' action='index.php'>
                <table class='table table-responsive input-group justify-content-center'>
                    <tr>
                        <td>Imię: </td>
                        <td><input size='24' type='text' name='imie' placeholder='Jan' title='Podaj imie.' required> </td>
                    </tr>
                    <tr>
                        <td>Nazwisko: </td>
                        <td><input size='24' type='text' name='nazwisko' placeholder='Kowalski' title='Podaj nazwisko.' required> </td>
                    </tr>
                    <tr>
                        <td>Adres e-mail: </td>
                        <td><input size='24' type='email' name='email' placeholder='example@example.com' title='Podaj adres e-mail.' required></td>
                    </tr>
                </table>
                <div class='text-center'>
                    <h4>Wiadomość:</h4>
                    <textarea id='opis' cols='45' rows='5' name='tekst' placeholder='Wpisz swoją wiadomość.' title='Wpisz wiadomość.' required></textarea>
                    <p>
                        <input class='mt-2 btn btn-outline-dark' type='submit' value='Wyślij' name='wyslij_kontakt'>
                        <input class='mt-2 btn btn-outline-dark' type='reset' value='Anuluj'></p>
                </div>
            </form>
        </div>
    </div>
</section>";