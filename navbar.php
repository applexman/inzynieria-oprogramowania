<nav class="navbar navbar-light navbar-expand-md sticky-top navbar-shrink py-3" id="mainNav">
    <div class="container"><a class="navbar-brand d-flex align-items-center" href="index.php"><span class="bs-icon-sm bs-icon-circle bs-icon-primary shadow d-flex justify-content-center align-items-center me-2 bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-box2-heart">
                    <path d="M8 7.982C9.664 6.309 13.825 9.236 8 13 2.175 9.236 6.336 6.31 8 7.982Z" />
                    <img class="rounded ms-5" width="100vw" src="assets/img/logo/logo4.png"/>
                    <path d="M3.75 0a1 1 0 0 0-.8.4L.1 4.2a.5.5 0 0 0-.1.3V15a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4.5a.5.5 0 0 0-.1-.3L13.05.4a1 1 0 0 0-.8-.4h-8.5Zm0 1H7.5v3h-6l2.25-3ZM8.5 4V1h3.75l2.25 3h-6ZM15 5v10H1V5h14Z" />
                </svg></span><span></span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Strona główna</a></li>
                <li class="nav-item"><a class="nav-link" href="products_page.php">Produkty</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">O nas</a></li>
            </ul>

            <?php

            if (isset($_SESSION['permissions']) && $_SESSION['permissions'] == 1) {
                echo '<a class="btn btn-outline-warning shadow me-2 btn-sm" role="button" href="admin_page.php">Admin 🦸‍♂️</a>';
            }
            if (isset($_SESSION['permissions']) && $_SESSION['permissions'] == 2) {
                echo '<a class="btn btn-outline-warning shadow me-2 btn-sm" role="button" href="employee_page.php">Pracownik 🦸‍♂️</a>';
            }
            if (isset($_SESSION['logged_flag']) && $_SESSION['logged_flag'] == true) {
                echo '<a class="btn btn-outline-warning shadow me-2 btn-sm" role="button" href="customer_page.php">Twoje konto</a>';
                echo '<a class="btn btn-danger shadow me-2 btn-sm" role="button" href="logout_script.php">Wyloguj 🚩</a>';
                echo '<a class="btn btn-outline-primary shadow ms-2 btn-sm" role="button" href="cart_page.php">Koszyk 🛒</a>';
            } else {
                echo '<a class="btn btn-primary shadow me-2 btn-sm" role="button" href="login_page.php">Zaloguj się</a>';
            }

            ?>
        </div>
    </div>
</nav>
<?php include 'cookie.php' ?>