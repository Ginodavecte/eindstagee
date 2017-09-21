<?php
include("../pChart2.1.4/class/pData.class.php");
include("../pChart2.1.4/class/pDraw.class.php");
include("../pChart2.1.4/class/pImage.class.php");



$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ankerstuy_test";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(mysqli_connect_errno()) {
    die("database query failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")"
    );
}
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit;
}
if($_POST['submitResultaat'] == 'Grafiek'){
    if (empty($_POST['selecteer_verf'])) {
        redirect_to("testindex.php");

    } else {
$geselecteerde_verf = $_POST['selecteer_verf'];

$min =0;
$max =0;

if(strpos($geselecteerde_verf,'glans20') !== false || strpos($geselecteerde_verf,'glans60') !== false){
    $min = 0;
    $max =100;
}
if(strpos($geselecteerde_verf,'kleurverschil') !== false || strpos($geselecteerde_verf,'vuilaanhechting') !== false
    || strpos($geselecteerde_verf,'barsten') !== false || strpos($geselecteerde_verf,'krijten') !== false){
    $min =0;
    $max =5;
}
if(strpos($geselecteerde_verf,'vergeling') !== false){
    $min = -127;
    $max = 127;
}


//$geselecteerde_verf = "glans20_hoogglans";

$myData = new pData();

$i = 1;

$query2 = "SELECT kleuren.kleur_naam,`meting1`, `meting2`, `meting3`, `meting4`, `meting5`, `meting6`, `meting7`
          , `meting8`, `meting9`, `meting10`, `meting11`, `meting12`, `meting13`, `meting14`
          , `meting15`, `meting16`, `meting17`, `meting18`, `meting19`, `meting20`, `meting21`
          , `meting22`, `meting23`, `meting24`, `meting25`, `meting26`, `meting27`, `meting28`
          , `meting29`, `meting30`
          FROM $geselecteerde_verf, kleuren WHERE $geselecteerde_verf.kleur_id = kleuren.kleur_id
          ORDER BY $geselecteerde_verf.kleur_id ASC";

$result = mysqli_query($connection, $query2);

while($row = mysqli_fetch_assoc($result)){
    $naam = $row['kleur_naam'];
    unset($row['kleur_naam']);

    $myData->addPoints($row,"Serie".$i);
    $myData->loadPalette("../pChart2.1.4/palettes/blind.color", TRUE);
    $myData->setSerieDescription("Serie".$i,$naam);
    $myData->setSerieOnAxis("Serie".$i,0);
    $i++;


}

$myData->addPoints(array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30),"Labels");
$myData->setAbscissa("Labels");

$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
$myData->setAxisName(0,"");
$myData->setAxisUnit(0,"");

$myPicture = new pImage(700,320,$myData);//Afmeting plaatje als geheel
$myPicture->drawRectangle(0,0,699,319,array("R"=>0,"G"=>0,"B"=>0));

$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));


$myPicture->setFontProperties(array("FontName"=>"../pChart2.1.4/fonts/Forgotte.ttf","FontSize"=>14));
$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE
, "R"=>236, "G"=>21, "B"=>21);
$myPicture->drawText(350,25,$geselecteerde_verf,$TextSettings);

$myPicture->setShadow(TRUE);
$myPicture->setGraphArea(50,50,675,280);//Afmeting grafiek in pixels
$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>"../pChart2.1.4/fonts/pf_arma_five.ttf","FontSize"=>6));

$AxisBoundaries = array(0=>array("Min" =>$min,"Max"=>$max));    //Waardes x en y as instellen
$scaleSettings = array("XMargin"=>0,"YMargin"=>0
,"Floating"=>FALSE
,"GridR"=>255,"GridG"=>255,"GridB"=>255
,"DrawSubTicks"=>TRUE
,"CycleBackground"=>TRUE
,"Mode"=>SCALE_MODE_MANUAL
,"ManualScale"=>$AxisBoundaries);
$myPicture->drawScale($scaleSettings);


$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));

$Config = "";
$myPicture->drawSplineChart($Config);

$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"../pChart2.1.4/fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
, "Mode"=>LEGEND_VERTICAL
);
$myPicture->drawLegend(560,16,$Config);

$myPicture->render("grafiek.png");

}
    ?>
    <head xmlns="http://www.w3.org/1999/html">
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
    <body>
    <div class="container main">
        <div class="col-md-7">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Resultaten grafiek</h3>
                </div>
                <table>
    <tr><td><img src="grafiek.png"></td></tr>
    </div>
            </table>
        </div>
        <td><li><a href="testindex.php">Ga terug</a></li></td>
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
<?php
}
?>


<?php
if($_POST['submitResultaat'] == 'Tabel'){
    if(empty($_POST['selecteer_verf'])){
        redirect_to("testindex.php");
    }else{
    ?>
    <head>
        <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bootstrap-3.3.7-dist/css/style1.css" rel="stylesheet">
    </head>
    <?php
$geselecteerde_verf = $_POST['selecteer_verf'];
$query ="SELECT kleuren.kleur_naam,meting1, meting7,meting13,meting19,meting25,meting30
             FROM $geselecteerde_verf,kleuren
             WHERE  $geselecteerde_verf.kleur_id = kleuren.kleur_id
             ORDER BY $geselecteerde_verf.kleur_id";
$result = mysqli_query($connection,$query);

?>

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
<body>
    <div class="container main">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Resultaten in tabelvorm</h3>
                </div>
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>0 jaar</th>
                        <th>3 jaar</th>
                        <th>6 jaar</th>
                        <th>9 jaar</th>
                        <th>12 jaar</th>
                        <th>15 jaar</th>
                    </tr>
                    </thead>

                    <?php while($row = mysqli_fetch_assoc($result)){
                        $naam = $row['kleur_naam'];
                        unset($row['kleur_naam']);?>

                        <thead class="table-left">

                        <tr><td><th><?php echo $naam;?></th></td></tr>
                        </thead>


                        <td></td>
                        <td><?php echo $row['meting1'];?></td>
                        <td><?php echo $row['meting7'];?></td>
                        <td><?php echo $row['meting13'];?></td>
                        <td><?php echo $row['meting19'];?></td>
                        <td><?php echo $row['meting25'];?></td>
                        <td><?php echo $row['meting30'];?></td>

                        </tbody>
                        <?php
                    }
                    ?>
                </table>

            </div>
            <td><li><a href="testindex.php">Ga terug</a></li></td>
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


        <?php
    }
}
?>

