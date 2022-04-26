<?php
class Site
{
    protected $content;
    protected $title = "Sklep Apple";
    protected $key_words = "apple, iphone, applewatch, sklep";
    protected $buttons = array(
        "Strona domowa" => "index",
        "iPhone" => "iphone",
        "Apple Watch" => "applewatch",
        "O nas" => "about"
    );

    public function set_content($new_content)
    {
        $this->content = $new_content;
    }

    public function set_style($url)
    {
        echo '<link rel="stylesheet" href="' . $url . '" type="text/css"/>';
    }

    public function set_script($url)
    {
        echo '<script src="' . $url . '"></script>';
    }

    public function show($userId)
    {
        $this->show_heading();
        $this->show_menu($userId);
        $this->show_content();
        $this->show_footer();
    }

    public function show_title()
    {
        echo "<title>$this->title</title>";
    }

    public function show_key_words()
    {
        echo "<meta name=\"keywords\" contents=\"$this->key_words\">";
    }

    public function show_menu($userId)
    {
        echo "
        <nav class='navbar navbar-expand-lg navbar-dark bg-primary'>
            <div class='container px-4 px-lg-5'>
                <button style='border: 0; background-color: transparent;' class='navbar-brand' id='title'>" . $this->title . "</button>
                <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'><span class='navbar-toggler-icon'></span></button>
                <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                    <ul class='navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4'>";
        foreach ($this->buttons as $name => $id) {
            echo "
                        <li class='nav-item'><button style='border: 0; background-color: transparent;' class='nav-link' id='" . $id . "'>" . $name . "</button></li>";
        }
        echo "
                    </ul>
                    <form class='d-flex' method='get'>";

        if ($userId >= 0) {
            echo "
                    <button class='btn btn-outline-light' onclick=\"document.location.href='?action=profile'\" type='button'>
                        Profil
                    </button>
                    &ensp;
                    <button class='btn btn-outline-light' onclick=\"document.location.href='?action=logout'\" type='button'>
                            Wyloguj
                    </button>
                    &ensp;";
        } else {
            echo "
                    <button class='btn btn-outline-light' id='login' type='button'>
                            Zaloguj
                    </button>
                    &ensp;";
        }

        echo "
                    <button class='btn btn-outline-light' id='cart' type='button'>
                        <i class='bi-cart-fill me-1'></i>
                        Koszyk
                    </button>
                    </form>
                </div>
            </div>
        </nav>";
    }

    public function show_heading()
    {
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Konrad Kalman">
    <link rel="icon" type="image/x-icon" href="assets/apple.ico">
    <?php
        $this->show_key_words();
        $this->show_title();
        $this->set_style('css/styles.css');
        $this->set_style('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css');
        $this->set_script('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js');
        echo "</head><body>";
    }

    public function show_content()
    {
        echo "<div id='main'>";
        echo $this->content;
        echo "</div>";
    }

    public function show_footer()
    {
        echo "
        <footer class='py-5 bg-dark'>
            <div class='container'>
                <p class='m-0 text-center text-white'>Copyright &copy; Konrad Kalman 2022</p>
            </div>
        </footer>";
        $this->set_script('https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js');
        $this->set_script('js/scripts.js');
        echo '</body></html>';
    }
}