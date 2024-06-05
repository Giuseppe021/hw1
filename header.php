<header> 
    <nav>
        <div class="container">
            <div id="links1" class="elementNav elementNav1">
                <div class="spaceElementNav1">
                    <span>Chiamaci: 0922 25873</span>    
                </div>
                <div class="nav-user-info">
                    <?php
                        if (!$userid = checkAuth()) {
                            echo "<div class='login'>
                                    <a href='login.php'>
                                        <i class='material-icons'>&#xe7ff;</i>
                                        <span>Accedi</span>
                                    </a>
                                </div>";
                        } else {
                            echo "<div class='login'>
                                    <a href='logout.php'>
                                        <span>Logout</span>
                                    </a>
                                </div>";
                        }
                    ?>
                    <div class="div-carrello">
                        <div class="content-carrello">
                            <a href="carrello.php">
                                <i class="material-icons">&#xe854;</i>
                                <span>Carrello</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav>
        <div class="container">
            <div id="links2" class="elementNav elementNav2">
                <div class="logo">    
                    <a class="spaceElementNav2" href="home.php">
                        <img src="https://clickatenea.it/shop/img/click-atenea-store-logo-1502028592.jpg">
                    </a>
                </div>
                <div class="spaceElementNav2" id="linknav2">
                    <a href="">HOME</a>
                    <a href="">CELLULARI</a>
                    <a href="">TABLET</a>
                    <a href="">ACCESSORI</a>
                    <a href="">RICONDIZIONATI</a>
                    <a href="repair_status.php">STATO RIPARAZIONE</a>
                </div>
                <div class="search-container">
                    <form action="https://clickatenea.it/shop/2-home" method="get">
                        <input type="text" placeholder="Cerca nel catalogo..." name="s" class="search-input">
                        <button type="submit" class="search-icon">
                            <a><i class="material-icons">&#xe8b6;</i></a>
                        </button>
                    </form>
                </div>
            </div>
            <div id="nav-mobile">
                <div id="menu-mobile">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <div id="logo-mobile">
                    <a href="https://clickatenea.it/shop">
                        <img src="https://clickatenea.it/shop/img/click-atenea-store-logo-1502028592.jpg">
                    </a>
                </div>
                <div id="user-info">
                    <a href="">Accedi</a>
                    <a href="">Carrello</a>
                </div>
            </div>
        </div>    
    </nav>
</header>
