<?php
if (isset($_SESSION['login'])){ ?>

            <!-- header si login -->
    <header>
    <a href="index.php"><img src="img/logo.png" alt="logo" class="logo"></a>
    <nav>
        <ul class="nav_bar">
            <li><a href="index.php">Home</a></li>    
            <li><a href="livre-or.php">Le Livre d'Or</a></li>    
            <li><button class="btn_comm" name="deconnect"><a href="include/decconect.php">Se Déconnecter</a></button></li>    
            <li><button class="btn_comm"><a href="include/update.php">Modifier Vous Information !</a></button></li> 
            <li><button class="btn_comm" name="delete"><a href="include/delete.php">Supprimez votre compte !</a></button></li>    
   
        </ul>    
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
            <div class="line4"></div>
        </div>
    </nav>
    </header>
<?php } else { ?>

        <!-- header si pas login -->
    <header>
    <a href="index.php"><img src="img/logo.png" alt="logo" class="logo"></a>
    <nav>
        <ul class="nav_bar">
            <li><a href="index.php">Home</a></li>    
            <li><a href="connexion.php">Se Connecter</a></li>    
            <li><a href="inscription.php">Inscription</a></li>    
            <li><a href="livre-or.php">Le Livre d'Or</a></li>    
        </ul>    
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
            <div class="line4"></div>
        </div>
    </nav>
</header>

<?php }?>