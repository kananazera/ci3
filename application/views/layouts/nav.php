<nav class="fixed-top sticky-top navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img id="logo-nav" class="img-fluid" src="assets/img/logo-dark.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">translate.home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products">translate.products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories">translate.categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about">translate.about</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact">translate.contact</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link position-relative me-3" href="#"><i class="bi bi-cart"></i> translate.cart')
                        <span class="position-absolute top-0 badge rounded-pill bg-danger">0</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-globe2"></i> az
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href=""><i
                                        class="bi bi-globe"></i> az</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-person"></i> user
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="">translate.profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="logout">
                                <button type="submit" class="dropdown-item">translate.logout</button>
                            </form>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="bi bi-person"></i> translate.authorization
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="login">translate.login</a></li>
                        <li><a class="dropdown-item" href="register">translate.register</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
