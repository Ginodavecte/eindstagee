<?php
include_once("database.php");
session_start();
$error = "";
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
        <div class="col-md-6 center"


    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // username and password sent from form
        $wachtwoord = "";
        $gebruikersnaam = mysqli_real_escape_string($connection, $_POST['gebruikersnaam']);
        if(!empty($_POST['password']))
            $wachtwoord = mysqli_real_escape_string($connection, $_POST['password']);


        $sql = "SELECT wachtwoord FROM gebruikers WHERE gebruikersnaam = '$gebruikersnaam' LIMIT 1";
        $result = mysqli_query($connection,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        //$active = $row['active'];

        // If result matched $myusername and $mypassword, table row must be 1 row

        // Hashing the password with its hash as the salt returns the same hash
        if(empty($row['wachtwoord'])){
            $wachtwoord2 = "";
        }else{
            $wachtwoord2 = $row['wachtwoord'];
        }
        if ( hash_equals($wachtwoord2 , crypt($wachtwoord, $wachtwoord2)) ) {
            $_SESSION['login_user'] = $gebruikersnaam;

            header("location: home.php");
        }else {
            $error = "Your Login Name or Password is invalid";
        }
    }

    ?>
    <html>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Log-in als admin</h3>
        </div>
                    <form action="" method="post">

                        <table class="table table-hover" id="dev-table">
                            <tr>
                                <td>
                                    Gebruiker :
                                </td>
                                <td>
                                    <input type="text" name="gebruikersnaam" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Password :
                                </td>
                                <td>
                                    <input type="password" name="password" required>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-hover" id="login-table">
                            <tr>
                                <td><li> <a href="../Ankerstuy/main.html">Ga terug</a></li></td>
                                <td><input class="login" type="submit" value=" Login! "/></td>
                            </tr>
                        </table>
                    </form>

                    <div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
                </div>
            </div>
        </div>
    <!--wut-->
    </div>
    </div>
    </div>
    </div>
    </body>
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