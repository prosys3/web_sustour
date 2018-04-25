
<?php

    // Preliminary code:
    include 'dbconfig.php';
    include 'admin/rsc/import/php/functions/functions.php';

    // Regular template:
    include 'rsc/import/php/components/head.php';
    include 'rsc/import/php/components/header.php';
  ?>
  <!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->

<!-- ... Your code goes here ... -->
<main>

    <section class="jumbotron jumbotron-fluid">

        <div class="container text-center">
          <!-- logo start -->
          <a href="#" class=""><img src="rsc/img/logo/sustour/logo_symbol_black.svg" width="150"></a>
          <!-- logo stopp -->

          <!-- logo tekst start -->
          <h1 class="display-3">Project events</h1>
          <!-- logo tekst stopp -->


        </div>

    </section>


    <section class="py-5">

        <div class="container">

            <?php

            $sql = 'SELECT * FROM Event ORDER BY Event_Date ASC';
            $result = mysqli_query($con, $sql);

            $counter = 1;
                          
            echo '<div class="row">';
            while ( $row = mysqli_fetch_array( $result ) ){
                $tempQuery = "SELECT * FROM Company WHERE " . $row['Event_Company'] . " = Company_ID ";
                $tempRes = mysqli_query($con,$tempQuery);
                $tempRow = mysqli_fetch_array($tempRes);
                // Gets date
                $d = new DateTime($row['Event_Date']);
                $date = $d->format('F jS - o');
                
                // Gets time
                $sTime = new DateTime($row['Event_Start']);
                $eTime = new DateTime($row['Event_End']);
                $startTime = $sTime->format('H:i');
                $endTime = $eTime->format('H:i');
               

                echo '<div class="col-sm">';
                echo '<div class="card" style="width: 20rem; margin:10px;">';
                echo '<div class="card-body d-flex flex-column justify-content-between" style="flex-wrap: wrap; ">';
                echo '<h5 class="card-title" style="text-align: center;">';
                echo $row['Event_Name'];
                echo '</h5>';
                echo '<h6 class="card-subtitle mb-2">' . $tempRow['Company_Name'];
                echo '</h6>';
                echo '<h7 class="card-subtitle mb-2 text-muted">' . $row['Event_Location'] ;
                echo '</h7>';
                echo '<p class="card-text">' . $date;
                echo '</br>' . $startTime . ' - ' . $endTime;
                echo '</p>' ;
                echo '<div class="card-text">';
                echo '<p>' . $row['Event_Text'] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              
                if ($counter % 3 == 0) {
                 echo '</div>';
                 echo '<div class="row">';
                  }
                  $counter++;

            }

            ?>

        </div>

    </section>

</main>
<!-- quick fix -->
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- quick fix -->

<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer.php'?>