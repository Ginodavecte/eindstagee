<?php include ("database.php");?>
<head>
    <link href="../bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bootstrap-3.3.7-dist/css/style1.css" rel="stylesheet">
</head>
<?php

$geselecteerde_verf = "glans20_hoogglans";
    $query ="SELECT kleuren.kleur_naam,meting1, meting7,meting13,meting19,meting25,meting30
             FROM $geselecteerde_verf,kleuren
             WHERE  $geselecteerde_verf.kleur_id = kleuren.kleur_id
             ORDER BY $geselecteerde_verf.kleur_id";
    $result = mysqli_query($connection,$query);

?>
<div class="container">
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

                <th><?php echo $naam;?></th>
                    </thead>

                <tbody>
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
    </div>
</div>

