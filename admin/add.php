<?php include("database.php") ;?>
<?php include("functions.php");?>
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
                    <h3 class="panel-title">Succesvol kleur gekoppelt aan verfsoort</h3>
                </div>

            <?php

    if (isset($_POST['submitAdd'])) {
        if (empty($_POST['add_verf']) || empty($_POST['add_kleur'])) {
            redirect_to("pre-add.php");

        } else {
            $add_verf = mysqli_real_escape_string($connection, $_POST['add_verf']);
            $add_kleur = intval(mysqli_real_escape_string($connection, $_POST['add_kleur']));

            $query = "SELECT kleur_id FROM $add_verf WHERE kleur_id = $add_kleur";
            $result = mysqli_query($connection, $query);
            $subjects = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (!empty($subjects)) {
                //$error = "De kleur die u heeft geselecteerd is al gekoppeld aan " . $add_verf . ".";//Geeft de melding niet weer
                redirect_to("pre-add.php");
            } else {

                $query = "INSERT INTO $add_verf (`id`, `kleur_id`, `meting1`, `meting2`
                        , `meting3`, `meting4`, `meting5`, `meting6`, `meting7`, `meting8`
                        , `meting9`, `meting10`, `meting11`, `meting12`, `meting13`, `meting14`
                        , `meting15`, `meting16`, `meting17`, `meting18`, `meting19`, `meting20`
                        , `meting21`, `meting22`, `meting23`, `meting24`, `meting25`, `meting26`
                        , `meting27`, `meting28`, `meting29`, `meting30`)
                      VALUES (NULL, $add_kleur, '', '', '', '', '', '', '', '', '', '', ''
                        , '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                        , '', '', '', '', '');";
                $result = mysqli_query($connection, $query);
                ?>
                <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>De kleur is succesvol toegevoegd aan <?php echo "$add_verf"?></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Voer nog een meting in of ga terug naar het admin paneel.</td>
                        </tr>
                            <td><li><a class="button_1" href="pre-add.php">Voeg toe</a></li></td>
                            <td><li><a class="submit" href="home.php">Ga terug</a></li></td>
                        </tr>
                        </tbody>
                </table>


                <?php
                if(isset($_POST['submitVerwijsMetingInvoeren'])){
                    redirect_to("pre-edit.php");
                }
                if(isset($_POST['submitTerugHome'])){
                    redirect_to("home.php");
                }
            }
        }
    }

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