<?php
include ("session.php");
?>
<head>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='style.css' rel="stylesheet" />
    <script src="../jquery-3.2.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.welkoms').fadeTo(8000,0);
           });
        console.log("asa");
    </script>
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
        <div class="twelve"">
            <a href="logout.php" class="logout"><strong>Logout</strong></a>
        </div>
    </div>
</header>
<div class="ankers-lijn"></div>

    <div class="container mm">
        <div class="welkoms">
        <h5>Welkom u bent succesvol ingelogd.</h5> <br>
        </div>
            <div class="container">

                    <div class="col-md-6 center">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Admin Menu</h3>
                            </div>
                            <table class="table table-hover" id="dev-table">
                                <thead>
                                <tr>
                                    <th>Toevoegen</th>
                                    <th>Wijzigen </th>
                                    <th>Verwijderen</th>
                                    <th>Voorbeeld</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="add_color.php">Voeg een nieuwe kleur toe aan de database</a></td>
                                    <td><a href="pre-edit.php">Wijzig de waarden van een meting</a></td>
                                    <td><a href="pre-deleteColor.php">Verwijder een kleur van een verfsoort</a></td>
                                    <td><a href="../grafiek/testindex.php">Grafieken en Tabellen</a></td>
                                </tr>
                                <tr>
                                    <td><a href="pre-add.php">Voeg een bestaande kleur toe aan een verfsoort</a></td>
                                    <td></td>
                                    <td><a href="pre-deleteColorName.php">Verwijder een kleur uit de database</a> </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><a href="register-admin.php">Voeg een admin toe.</a></td>
                                    <td></td>
                                    <td><a href="admin-delete.php">Verwijder een admin</a></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    </div>

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
        $(".container.mm").css("min-height",window.innerHeight-276);
    </script>
</footer>
