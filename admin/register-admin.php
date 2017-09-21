<?php
include_once("../admin/database.php");
include ("functions.php");
include ("session.php");
?>
<head>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='style.css' rel="stylesheet" />
    <link href='responsive.css' rel="stylesheet" />
    <script src="../jquery-3.2.0.min.js"></script>
</head>

<!--Headerbaseline-->
<header id="masthead" class="site-header" role="banner" style="background-color: #05284E">
    <div class="container">
        <div class="four columns">
            <div id="ankerstuy" class="logo">
                <a href="https://www.ankerstuy.nl/" title="Anker Stuy" rel="home">
                    <img src="https://www.ankerstuy.nl/wp-content/themes/ankerstuy/images/ankerstuy-logo.png" width="221" alt="AnkerStuy Verven">
                </a>
            </div>
        </div>
    </div>
</header>
<div class="ankers-lijn"></div>

<body>
    <div class="container main">
        <div class="col-md-6 center">
    <?php
    $error = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $gebruikersnaam = mysqli_real_escape_string($connection,$_POST['gebruikersnaam']);
        $wachtwoord = mysqli_real_escape_string($connection,$_POST['wachtwoord']);
        $naam = mysqli_real_escape_string($connection,$_POST['naam']);

        $sql = "SELECT * FROM gebruikers WHERE gebruikersnaam = '$gebruikersnaam';";
        $result = mysqli_query($connection,$sql);

        $passEncrypted = encryptPass($wachtwoord);

        if($result->num_rows < 1) { // check of de email al in de database bekend is.
            ?>

            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Succesvol een admin aangemaakt</h3>
                </div>
                <table class="table table-hover" id="dev-table">
            <?php
            $sql = "INSERT INTO gebruikers (gebruikersnaam, wachtwoord,naam) VALUES ('$gebruikersnaam', '$passEncrypted','$naam');";
            mysqli_query($connection, $sql);
            echo "U heeft succesvol een nieuw account aagemaakt!";
            ?>
                    </table>
            </div>
            <?php
        }else{
            $error = "De gebruikersnaam die je gekozen hebt bestaat al.";
        }
    }

    ?>
    <html>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Admin Toevoegen</h3>
                </div>

                <form action = "" method = "post">
                    <table class="table table-hover" id="dev-table">

                        <tbody>
                        <!-- input regitreren Naam-->
                        <tr>
                            <td>Naam  :</td>
                            <td><input type = "text" name = "naam" required></td>
                        </tr>
                        <!-- input registreren Gebruikersnaam -->
                        <tr>
                            <td>Gebruikersnaam  :</td>
                            <td><input type = "text" name = "gebruikersnaam" required ></td>
                        </tr>
                        <!-- input registreren Passwoord -->
                        <tr>
                            <td>Passwoord :</td>
                            <td><input type = "password" name = "wachtwoord" required></td>
                        </tr>

                        <tr>
                            <td><li><a href="home.php">Ga terug</a> </li></td>
                            <td><input class="submit" type = "submit" value = " Registreer! "/></td>

                        </tr>
                        <tr>
                            <td><div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div></td>
                            <td></td>
                        </tr>
                        </tbody>

                    </table>
                </form>
            </div>
        </div>
        </div>
    </html>
</body>

<!--Footer-->
<footer class="site-footer" role="contentinfo">
    <div class="ankers-lijn"></div>
    <div class="container">
        <div class="row margin"></div>
    </div>
    <div class="foot">
        <div class="container">
            <div class="eight columns">
                <p class="copyright">&copy; 1898 - 2017 AnkerStuy Verven&nbsp; |</p>
            </div>
            <div class="eight columns">
                <p class="rights">Alle rechten voorbehouden</p>
            </div>
        </div>
    </div>
    <script>
        $(".container.main").css("min-height",window.innerHeight-372);
    </script>
</footer>
