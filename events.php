
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


    


            <?php

            $sql = 'SELECT * FROM Event WHERE Event_Date > CURDATE() ORDER BY Event_Date ASC, Event_Start ASC';
            $result = mysqli_query($con, $sql);
            $numrow = mysqli_num_rows($result);
            $counter = 1;
            echo '<section class="container py-4">';              
            echo '<div class="row">';
            while ( $row = mysqli_fetch_array( $result ) ){
                $tempQuery = "SELECT * FROM Company WHERE " . $row['Event_Company'] . " = Company_ID";
                $tempRes = mysqli_query($con,$tempQuery);
                $tempRow = mysqli_fetch_array($tempRes);
                // Gets date
                $d = new DateTime($row['Event_Date']);
                $date = $d->format('F jS o');
                
                // Gets time
                $sTime = new DateTime($row['Event_Start']);
                $eTime = new DateTime($row['Event_End']);
                $startTime = $sTime->format('H:i');
                $endTime = $eTime->format('H:i');
               
                echo '<div class="col-sm-4">';
                echo '<div class="card">';
                echo '<div class="card border-dark">';
                echo '<div class="card-body d-flex flex-column">';
                echo '<h5 class="card-title text-center">';
                echo $row['Event_Name'];
                echo '</h5>';
                echo '<h6 class="card-subtitle">'; 
                echo $tempRow['Company_Name'];
                echo '</h6>';
                echo '<h6 class="card-subtitle my-2 text-muted">';
                echo $row['Event_Location'];
                echo '</h6>';
                echo '<ul class="list-group list-group-flush">';
                echo '<li class="list-group-item">';
                echo $date;
                echo '</li>';
                echo '<li class="list-group-item">';
                echo $startTime . ' - ' . $endTime;
                echo '</li>' ;
                echo '</ul>' ;
                echo '<p class="card-text">';
                echo $row['Event_Text'];
                echo '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              
                if ($counter % 3 == 0) {
                 echo '</div>';
                 echo '</section>';
                  if ($counter == $numrow) {

                    } else {
                        echo '<section class="container py-4">';
                        echo '<div class="row">';

                    }

               }
                  $counter++;
                }

            ?>



     <!-- Collapse button start -->
  <section class="container py-5">
      <div class="row">
          <div class="col text-center">
              <p>
                  <a class="btn btn-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        View completed events
                  </a>
                </p>
                <div class="collapse" id="collapseExample">
          <div class="card text-white bg-dark">
                  <div class="card card-header">
                  COMPLETED EVENTS
                </div>
          </div>
  <!-- Collapse button end -->

   <!-- Collapse content start -->
          <?php

            $sql_old = 'SELECT * FROM Event WHERE Event_Date < CURDATE() ORDER BY Event_Date ASC, Event_Start ASC';
            $result_old = mysqli_query($con, $sql_old);
            $numrow_old = mysqli_num_rows($result_old);
            $counter_old = 1;
            echo '<section class="container py-4">';              
            echo '<div class="row">';
            while ( $row_old = mysqli_fetch_array( $result_old ) ){
                $tempQuery = "SELECT * FROM Company WHERE " . $row_old['Event_Company'] . " = Company_ID";
                $tempRes = mysqli_query($con,$tempQuery);
                $tempRow = mysqli_fetch_array($tempRes);
                // Gets date
                $d = new DateTime($row_old['Event_Date']);
                $date = $d->format('F jS o');
                
                // Gets time
                $sTime = new DateTime($row_old['Event_Start']);
                $eTime = new DateTime($row_old['Event_End']);
                $startTime = $sTime->format('H:i');
                $endTime = $eTime->format('H:i');
               

                echo '<div class="col-sm-4">';
                echo '<div class="card">';
                echo '<div class="card border-dark">';
                echo '<div class="card-body d-flex flex-column">';
                echo '<h5 class="card-title text-center">';
                echo $row_old['Event_Name'];
                echo '</h5>';
                echo '<h6 class="card-subtitle">'; 
                echo $tempRow['Company_Name'];
                echo '</h6>';
                echo '<h6 class="card-subtitle my-2 text-muted">';
                echo $row_old['Event_Location'];
                echo '</h6>';
                echo '<ul class="list-group list-group-flush">';
                echo '<li class="list-group-item">';
                echo $date;
                echo '</li>';
                echo '<li class="list-group-item">';
                echo $startTime . ' - ' . $endTime;
                echo '</li>' ;
                echo '</ul>' ;
                echo '<p class="card-text">';
                echo $row_old['Event_Text'];
                echo '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
              
                if ($counter_old % 3 == 0) {
                 echo '</div>';
                 echo '</section>';
                  if ($counter_old == $numrow_old) {

                    } else {
                        echo '<section class="container py-4">';
                        echo '<div class="row">';

                    }

               }
                  $counter++;
                }

            ?>
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