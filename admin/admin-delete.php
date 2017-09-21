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
    $sql = mysqli_query($connection,"SELECT * FROM gebruikers ");
    $total = mysqli_num_rows($sql);

    $adjacents = 3;
    $targetpage = "admin-delete.php"; //your file name
    $limit = 10 ; //how many items to show per page

    if(!isset($_GET['page'])){

        $page = 0;

    }else

    {

        $page = $_GET['page'];

    }


    if($page){
        $start = ($page - 1) * $limit; //first item to display on this page
    }else{
        $start = 0;
    }

    /* Setup page vars for display. */
    if ($page == 0) $page = 1; //if no page var is given, default to 1.
    $prev = $page - 1; //previous page is current page - 1
    $next = $page + 1; //next page is current page + 1
    $lastpage = ceil($total/$limit); //lastpage.
    $lpm1 = $lastpage - 1; //last page minus 1

    $sql2 = "SELECT * FROM gebruikers WHERE 1=1 ORDER BY id ASC LIMIT $start ,$limit ";
    $sql_query = mysqli_query($connection,$sql2);
    $curnm = mysqli_num_rows($sql_query);

    /* CREATE THE PAGINATION */

    $pagination = "";
    if($lastpage > 1)
    {
        $pagination .= "<div> <ul class='pagination'>";
        $counter = 0;
        if ($page > $counter+1) {
            $pagination.= "<li><a href=\"$targetpage?page=$prev\">prev</a></li>";
        }

        if ($lastpage < 7 + ($adjacents * 2))
        {
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                else
                    $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                }
        }
        elseif($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                }
                $pagination.= "<li>...</li>";
                $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                $pagination.= "<li>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                }
                $pagination.= "<li>...</li>";
                $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                $pagination.= "<li>...</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage;
                     $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                }
            }
        }

        //next button
        if ($page < $counter - 1)
            $pagination.= "<li><a href=\"$targetpage?page=$next\">next</a></li>";
        else
            $pagination.= "";
        $pagination.= "</ul></div>\n";
    }


    ?>
    <?php
    //$query = "SELECT * FROM gebruikers ORDER BY id";
    $result = mysqli_query($connection,$sql2);

    $subjects = mysqli_fetch_all($result,MYSQLI_BOTH);

    ?>
    <div class="container main">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Verwijder een admin</h3>
                </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Naam</th>
                    <th>Gebruikersnaam</th>
                    <!--<th style="width: 36px;"></th>-->
                </tr>
                </thead>
                <tbody>
                <?php
                $i = ($page * 10) -10;
                foreach ($subjects as $subject) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?> </td>
                        <td><?php echo $subject['naam'];
                            ?>
                        </td>
                        <td><?php echo $subject['gebruikersnaam']; ?></td>
                        <td><a href="delete.php?id=<?php echo $subject['id'];?>">Delete</a> </td>
                    </tr>

                    <?php
                }

                ?>

                </tbody>
            </table>

        <?php
        echo $pagination;
        ?>
            <li><a href="home.php">Ga terug</a></li>

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
        $(".container.main").css("min-height",window.innerHeight-276);
    </script>
</footer>