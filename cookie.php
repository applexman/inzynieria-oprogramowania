<?php

$cookieName = 'mol_ksiazkowy';
$cookieValue = 'accepted';

if (isset($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] === $cookieValue) {
    
    $showCookieMessage = false;
} else {
    
    $showCookieMessage = true;

    if (isset($_POST['cookie-accept'])) {
        
        setcookie($cookieName, $cookieValue, time() + (86400 * 7), '/');
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}
if ($showCookieMessage) {
    echo '
    <div class="cookie-message bg-dark text-white py-3 fixed-bottom mb-0">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                Ta strona wykorzystuje pliki cookie. Korzystając z niej, zgadzasz się na naszą Politykę prywatności.
            </div>
            <div class="col-auto">
                <form method="post" style="display: inline;">
                    <button class="btn btn-primary btn-sm" type="submit" name="cookie-accept">Akceptuj</button>
                </form>
            </div>
        </div>
    </div>
</div>
    }';
}
?>