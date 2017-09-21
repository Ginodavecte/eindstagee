<?php include ("database.php");?>
<?php include ("functions.php");?>
<?php include ("session.php"); ?>
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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Kleur toevoegen aan database</h3>
                </div>
                <table class="table table-hover">
                    <form action="add_color.php" method="post">
                    <thead>
                    <tr>
                        <th>Opties</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Voeg een kleur toe : </td>
                        <td><input type="text" name="nieuwe_kleur" required></td>
                    </tr>
                    <tr>
                        <td>Dit zijn de bestaande kleuren die nu in de database staan</td>
                        <td>

    <?php
    $query = "SELECT * FROM kleuren ORDER BY kleur_id";
    $res = mysqli_query($connection,$query);
    $selected_venue_id = "";

    echo "<select name = 'add_kleur'>";
    ?><option selected disabled >Kleur</option>

    <?php
    while (($row = mysqli_fetch_array($res)) != null)
    {
        echo "<option value = '{$row['kleur_id']}'";
        if ($selected_venue_id == $row['kleur_id'])
            echo "selected = 'selected'";
        echo ">{$row['kleur_naam']}</option>";
    }
    echo "</select>";
    ?></td></tr>
                    <tr>
                        <td><li> <a href="home.php">Ga terug</a></li></td>
                        <td><input class="submit" type="submit" name="submitNieuwe_kleur" value="Voeg Toe!"></td>
                    </tr>
                    </tbody>
                        </form>
                </table>
            </div>

    <?php
        if(isset($_POST['submitNieuwe_kleur'])){
            $nieuwe_kleur = mysqli_real_escape_string($connection, ucfirst(strtolower($_POST['nieuwe_kleur'])));
            $query = mysqli_query($connection,"SELECT * FROM kleuren WHERE kleur_naam = '".$nieuwe_kleur."'");

                if(mysqli_num_rows($query) > 0 ){
    ?><div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Kleur toevoegen mislukt  </h3>
        </div>
        <table class="table">
                <tr>
                    <td> <?php echo "De kleur : ".$nieuwe_kleur." staat al in de database."; ?> </td>
                </tr>
        </table>
                </div>
                <?php
            }else {

                $query = "INSERT INTO `kleuren` (`kleur_id`, `kleur_naam`) VALUES (NULL, '$nieuwe_kleur');";
                $result = mysqli_query($connection, $query);
                ?>
                    <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Succesvol kleur toegevoegd aan database</h3>
                    </div>
                <?php
                echo "<strong>" ."U heeft succesvol de kleur '".$nieuwe_kleur."' toegevoegd."."</strong><br><br>";
                echo "Wilt u de aangemaakte kleur toevoegen aan een verfsoort ?". "<br>";
                ?>

                <form action="pre-add.php" method="post">
                <input class="button_1" type="submit" name="submitDoorverwijs" value="Klik dan hier!">
                </form><br>
                        <?php
                        echo "<strong>" ."Heeft u een typefout gemaakt in de net aangemaakte kleur '".$nieuwe_kleur."'</strong><br><br>";
                        echo "Klik dan hier onder op de knop om de net aangemaakte of andere kleur te verwijderen uit de database.";
                        ?><br>
                        <form action="pre-deleteColorName.php" method="post">
                            <input class="button_1" type="submit" name="submitVerwijsDeleteKleur" value="Verwijder kleur">
                        </form>
                        <br>

                <?php
                    if(isset($_POST['submitDoorverwijs'])){
                        redirect_to("pre-add.php");

                }
                    if(isset($_POST['submitVerwijsDeleteKleur'])){
                        redirect_to("pre-deleteColorName");
                    }//sluiting van de if hier gelijk boven

            }//sluiting van de else statement
        }//sluit accolade van 1e if  de isset vraag

    ?>
                </div>
        </div>
    </div>
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