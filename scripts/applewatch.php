<?php
echo "
<section>
    <div class='container px-4 px-lg-5 my-3'>
        <div class='row gx-4 gx-lg-5 align-items-center'>
            <h1 class='display-5 fw-bolder'>Apple Watch — akcesorium klasy premium</h1>
            <p class='lead fw-normal'>Smartwatch od Apple to wysoce zaawansowane akcesorium, które świetnie sprawdza się w organizacji dnia i jest cennym towarzyszem osób aktywnych. Wykonany z wysokiej jakości materiałów, innowacyjnych komponentów, z wysoką dbałością o design, stanowi praktyczny gadżet dla tych, którzy cenią nowatorskie rozwiązania. Dzięki niemu całe centrum zarządzania Twoim czasem zmieścisz na nadgarstku. Niewątpliwie jest to produkt, który z powodzeniem wpisuje się w ideę technologii przyszłości. Jednak możesz go mieć już teraz!</p>
            <h4 class='fw-bolder mt-3'>Smartwatch Apple — dlaczego warto go mieć?</h4>
            <p class='lead'>Co potrafi ultranowoczesny zegarek Apple? Oto twój partner w codziennym życiu. Przypomina Ci o ważnych sprawach, monitoruje Twoje zaangażowanie w aktywność fizyczną i wspomaga osobisty trening. Dzięki wizualnej projekcji danych na temat Twojego codziennego ruchu wiesz dokładnie, ile wysiłku kosztował Cię każdy dzień. Wyznaczone cele, nagrody i spersonalizowane porady zapewniają odpowiednie dawki motywacji. Co więcej, rankingi aktywności znajomych to dobry sposób na codzienną, sportową rywalizację.</p>   
       </div>
    </div>
</section>
<section class='py-5 bg-light'>
<div class='container px-4 px-lg-5 mt-5'>
    <div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>";
$katalog = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT') . '/projektkopia/WWW/images/watch/';
$kat = @opendir($katalog) or die('Nie można otworzyć katalogu');
$i = 0;
while ($plik = readdir($kat)) {
    if ($i > 1) {
        $temp = explode(".", $plik);
        echo "
            <div class='col mb-5'>
                <div class='card h-100'>
                    <a class='nav-link' href='?site=$temp[0]'>
                        <img class='card-img-top' src='images/watch/$plik' alt='$plik' />
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