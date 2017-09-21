<?php include ("database.php");?>
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
    <?php
    $verwijder_kleur_id = intval($_GET['id']);


    if (is_int($verwijder_kleur_id)) {
    ?>
    <div class="container main">
        <div class="col-md-6 center">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Succesvol admin verwijderd</h3>
                </div>
                <table class="table table-hover" id="dev-table"><br>
                    <?php
        $query = "DELETE FROM kleuren WHERE kleur_id = ". $verwijder_kleur_id ;
        $result = mysqli_query($connection, $query);
        echo "  De kleur is succesvol verwijderd!"."<br>";
    }
    ?>
                    <br>
                    <li><a href="home.php">Ga terug naar admin-paneel</a></li>
                </table>
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

