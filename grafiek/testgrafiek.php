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

$geselecteerde_verf = "glans20_hoogglans";

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

$AxisBoundaries = array(0=>array("Min" =>0,"Max"=>100));    //Waardes x en y as instellen
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

$myPicture->stroke();

?>