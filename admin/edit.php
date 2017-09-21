<?php include("database.php");
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}
?>
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

    <div class="container main">
        <div class="col-md-6 center">
            <div class="panel panel-primary">
<body>
        <?php

        if(isset($_POST['submitKiezen'])) {
            if(empty($_POST['selecteer_verf']) || empty($_POST['selecteer_kleur']) ){
                redirect_to("pre-edit.php");
            }else{
                $geselecteerde_verf = mysqli_real_escape_string($connection,$_POST['selecteer_verf']);
                $geselecteerde_kleur = mysqli_real_escape_string($connection,$_POST['selecteer_kleur']);


        //$test_id = 1;
                $query = "SELECT `meting1`, `meting2`, `meting3`, `meting4`, `meting5`, `meting6`, `meting7`
                  , `meting8`, `meting9`, `meting10`, `meting11`, `meting12`, `meting13`, `meting14`
                  , `meting15`, `meting16`, `meting17`, `meting18`, `meting19`, `meting20`, `meting21`
                  , `meting22`, `meting23`, `meting24`, `meting25`, `meting26`, `meting27`, `meting28`
                  , `meting29`, `meting30`
                  FROM $geselecteerde_verf WHERE kleur_id= $geselecteerde_kleur";
                $result = mysqli_query($connection, $query);


                $subjects = mysqli_fetch_assoc($result);
                $i = 0;
                ?>
                <div class="panel-heading">
                    <h3 class="panel-title">Wijzig de waarden van de meting <?php echo $geselecteerde_verf;?></h3>
                </div>
                <form action="edit.php" method="post">
                    <table class="table table-hover" id="dev-table">
                        <caption>Wijzig metingen vanaf 1-1-2016</caption>
                        <thead>
                            <th>Meting</th>
                            <th>Huidige waarde</th>
                            <th>Nieuwe waarde</th>
                        </thead>


                        <?php
                        foreach ($subjects as $subject) {
                            ?>
                            <tr>
                                <td><?php
                                    $i++;
                                    echo $i . "e meting";


                                    ?>

                                </td>
                                <td>

                                    <?php echo $subject; ?>
                                </td>
                                <?php
                                if(strpos($geselecteerde_verf,'glans20') !== false || strpos($geselecteerde_verf,'glans60') !== false){
                                    ?>
                                    <td><input type="number" name="meting<?php echo $i; ?>" value="<?php echo $subject; ?>" step="0.01" min="0" max="100"></td>
                                <?php
                                    }
                                ?>
                                <?php
                                if(strpos($geselecteerde_verf,'kleurverschil') !== false || strpos($geselecteerde_verf,'vuilaanhechting') !== false
                                    || strpos($geselecteerde_verf,'barsten') !== false || strpos($geselecteerde_verf,'krijten') !== false){
                                    ?>
                                    <td><input type="number" name="meting<?php echo $i; ?>" value="<?php echo $subject; ?>" step="0.01" min="0" max="5"></td>
                                    <?php
                                }
                                ?>
                                <?php
                                if(strpos($geselecteerde_verf,'vergeling') !== false){
                                    ?>
                                    <td><input type="number" name="meting<?php echo $i; ?>" value="<?php echo $subject; ?>" step="0.01" min="-127" max="127"></td>
                                    <?php
                                }
                                ?>

                            </tr>
                        <?php } ?>
                        <tr>
                            <td><li><a href="home.php">Ga Terug</a> </li></td>
                            <td><td><input type="submit" name="submitMeting" value="Wijziging Bevestigen"></td></td>
                        </tr>

                    </table>
                    <tr>
                        <td><input type="hidden" name="nieuwe_verf" value="<?php echo $geselecteerde_verf;?>"> </td>
                        <td><input type="hidden" name="nieuwe_kleur" value="<?php echo $geselecteerde_kleur;?>"></td>
                    </tr>
                </form>
                <?php
            }//Sluit de else van if(empty) dropdown wijzigen.php de redirect_to functie
        }//Sluit accolade van isset van wijzigen.php (Vorige pagina)

        ?>

        <?php
        $nieuwe_meting = array();
        if(isset($_POST['submitMeting'])){
            $geselecteerde_verf = $_POST['nieuwe_verf'];
            $geselecteerde_kleur = $_POST['nieuwe_kleur'];


        for ($y = 1; $y <= 30; $y++) {
            if (isset($_POST['submitMeting'])) {
                $nieuwe_meting[$y - 1] = intval($_POST['meting' . $y]);

            }
        }

        ?>
                        </div>
                </div>
                    </div>
                    </div>
        <?php

        $query = "UPDATE $geselecteerde_verf SET";
        for ($i = 0; $i < count($nieuwe_meting); $i++) {

            if ($i == (count($nieuwe_meting) - 1)) {
                $query .= " `meting" . ($i + 1) . "` = " . $nieuwe_meting[$i];
            } else {
                $query .= " `meting" . ($i + 1) . "` = " . $nieuwe_meting[$i] . ",";
            }
        }
        $query .= " WHERE kleur_id  = $geselecteerde_kleur;";
        $result = mysqli_query($connection, $query);
        ?>
        <div class="container main">
            <div class="col-md-6 center">
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Succesvol wijziging van meting doorgevoerd  aan database</h3>
                        </div>
                            <table class="table">
                        <tr>
                            <td><li><a href="home.php" >Ga terug naar admin-paneel</a></li></td>
                        </tr>
                            </div>
                </table>
                </div>


                </div>
        <?php
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
</footer>

