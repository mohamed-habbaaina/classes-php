<?php
require_once 'include/class/User-pdo.php';
$user = new Userpdo();

if ($user->isConnected() === true): ?>

            <!-- header if Connected -->
    <header>
    <a href="index.php"><img src="img/logo.png" alt="logo" class="logo"></a>
    <nav>
        <ul class="nav_bar">
            <li><a href="index.php">Home</a></li>    
            <li><button class="btn" name="deconnect"><a href="include/decconect.php">Se Déconnecter</a></button></li>    
            <li><button class="btn"><a href="update.php">Modifier Vous Information !</a></button></li> 
            <li><button class="btn" name="delete"><a href="include/delete.php">Supprimez votre compte !</a></button></li>    
   
        </ul>    
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
            <div class="line4"></div>
        </div>
    </nav>
    </header>
<?php else: ?>

        <!-- header if don't Connected -->
    <header>
    <a href="index.php"><img src="" alt="logo" class="logo"></a>
    <nav>
        <ul class="nav_bar">
            <li><a href="index.php">Home</a></li>    
            <li><a href="connexion.php">Se Connecter</a></li>    
            <li><a href="inscription.php">Inscription</a></li>    
        </ul>    
        <div class="burger">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </nav>
</header>

<?php endif; ?>