<?php
echo "
<section>
    <div class='container px-4 px-lg-5 my-3'>
        <div class='row gx-4 gx-lg-5 align-items-center'>
            <h1 class='display-5 fw-bolder'>iPhone — kultowy telefon Apple</h1>
            <p class='lead fw-normal'>Nie bez powodu iPhone jest najpopularniejszym smartfonem na świecie i flagowym urządzeniem firmy Apple. To telefon osobisty, który spełnia potrzeby najbardziej wymagających konsumentów. Zastosowane w nim rozwiązania technologiczne to zawsze najświeższe osiągnięcia techniczne wśród sprzętów mobilnych na świecie. </p>
        </div>
    </div>
</section>
<section class='py-5 bg-light'>
    <div class='container px-4 px-lg-5 mt-5'>
        <div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";
$katalog = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/projektkopia/WWW/images/iphone/';
$kat = @opendir($katalog) or die('Nie można otworzyć katalogu');
$i = 0;
while ($plik = readdir($kat)) {
    if ($i > 1) {
        $temp = explode(".", $plik);
        echo "
                <div class='col mb-5'>
                    <div class='card h-100'>
                        <a class='nav-link' href='?site=$temp[0]'>
                            <img class='card-img-top' src='images/iphone/$plik' alt='$plik' />
                            <div class='card-body p-4'>
                                <div class='text-center'>
                                    <h5 class='fw-bolder'>$temp[0]</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                ";
    }
    $i++;
}
echo "     
        </div>
    </div>
</section>";