<?php include("../pChart2.1.4/class/pData.class.php");?>
<?php include("../pChart2.1.4/class/pDraw.class.php");?>
<?php include("../pChart2.1.4/class/pImage.class.php");?>

<head>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='../admin/style.css' rel="stylesheet" />
    <link href='../admin/responsive.css' rel="stylesheet" />
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
    <div class="container main">
        <div class="col-md-6">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">Kies uw verfsoort</h3>
            </div>
            <table class="table">
                <form action="testtabel.php" method="post">
                <tbody>
                <tr>
                    <td>Selecteer een verfsoort</td>
                    <td> <select name="selecteer_verf">
                            <option selected disabled>Waarborg Hoogglans</option>
                            <option value="glans20_hoogglans">Glans 20º</option>
                            <option value="glans60_hoogglans">Glans 60º</option>
                            <option value="kleurverschil_hoogglans">Kleurverschil</option>
                            <option value="vergeling_hoogglans">Vergeling</option>
                            <option value="vuilaanhechting_hoogglans">Vuilaanhechting</option>
                            <option value="krijten_hoogglans">Krijten</option>
                            <option value="barsten_hoogglans">Barsten</option>

                            <option disabled>Systeemverf Gloss</option>
                            <option value="glans20_gloss">Glans 20º</option>
                            <option value="glans60_gloss">Glans 60º</option>
                            <option value="kleurverschil_gloss">Kleurverschil</option>
                            <option value="vergeling_gloss">Vergeling</option>
                            <option value="vuilaanhechting_gloss">Vuilaanhechting</option>
                            <option value="krijten_gloss">Krijten</option>
                            <option value="barsten_gloss">Barsten</option>

                            <option disabled>Waarborg PU Aflak WS</option>
                            <option value="glans20_aflak">Glans 20º</option>
                            <option value="glans60_aflak">Glans 60º</option>
                            <option value="kleurverschil_aflak">Kleurverschil</option>
                            <option value="vergeling_aflak">Vergeling</option>
                            <option value="vuilaanhechting_aflak">Vuilaanhechting</option>
                            <option value="krijten_aflak">Krijten</option>
                            <option value="barsten_aflak">Barsten</option>

                            <option disabled>Waarborg PU Satin</option>
                            <option value="glans20_satin">Glans 20º</option>
                            <option value="glans60_satin">Glans 60º</option>
                            <option value="kleurverschil_satin">Kleurverschil</option>
                            <option value="vergeling_satin">Vergeling</option>
                            <option value="vuilaanhechting_satin">Vuilaanhechting</option>
                            <option value="krijten_satin">Krijten</option>
                            <option value="barsten_satin">Barsten</option>

                            <option disabled>Waarborg Systeemverf Semi-Gloss</option>
                            <option value="glans20_semigloss">Glans 20º</option>
                            <option value="glans60_semigloss">Glans 60º</option>
                            <option value="kleurverschil_semigloss">Kleurverschil</option>
                            <option value="vergeling_semigloss">Vergeling</option>
                            <option value="vuilaanhechting_semigloss">Vuilaanhechting</option>
                            <option value="krijten_semigloss">Krijten</option>
                            <option value="barsten_semigloss">Barsten</option>
                        </select></td>
                </tr>
                <tr>
                    <td><li><a href="../admin/home.php">Ga terug</a></li> </td>
                    <td><input class="submit" type="submit" name="submitResultaat" id="Grafiek" value="Grafiek">
                    <input class="submit" type="submit" name="submitResultaat" id="Tabel" value="Tabel"  ></td>
                </tr>
                </tbody>
                </form>
        </table>

        </div>
        </div>
    </div>
<?php ?>

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

