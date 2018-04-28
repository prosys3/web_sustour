<?php

    // Preliminary PHP code:
    include '../dbconfig.php';
    include 'rsc/import/php/functions/functions.php';

    // Security - Check whether user is logged in:
    if( !isset($_SESSION['login']) ){
        header("Location:../login.php")
        ;exit();
    }

    // HTML - Head and header:
    include 'rsc/import/php/components/head_dashboard.php';
    include 'rsc/import/php/components/header_dashboard.php';

?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->

<?php

    // Preliminary data:
    $event_id = $_GET['id'];
    $sql = "SELECT * FROM Event WHERE Event_ID = ".$event_id;
    $result = mysqli_query($con, $sql);
    $event_row = mysqli_fetch_array($result);

    $event_title = $event_row['Event_Name'];
    $event_text  = $event_row['Event_Text'];
    $event_loc  = $event_row['Event_Location'];
    $event_start  = $event_row['Event_Start'];
    $event_end  = $event_row['Event_End'];
    $event_date  = $event_row['Event_Date'];
    $event_company  = $event_row['Event_Company'];

?>

<main>

    <section class="bg-dark py-5">

        <div class="container text-center text-light">

            <h1>Admin dashboard</h1>

        </div>

    </section>

    <section class="bg-light py-5">
        <div class="container">

            <div class="row">
                <div class="col-3">
                    <?php include 'rsc/import/php/components/dashboard/dashboard_nav.php' ?>
                </div>

                <div class="col-9">
                    <ul class="list-group">
                        <li class="list-group-item text-light bg-dark">Event editor</li>
                        <li class="list-group-item">

                            <form method="POST" action="update_handler.php?object=event&id=<?php echo $event_id?>&name=submit" enctype="multipart/form-data">

                                <!-- Event title: -->
                                <div class="form-group">
                                    <label>Event name</label>
                                    <input type="text" name="title" class="form-control form-text" placeholder="Page Title" value="<?php echo $event_title;?>">
                                </div>

                                 <!-- User Company: -->
                                <div class="form-group">
                                    <?php populate_event_company_selection('company',$event_id) ?>
                                </div>

                                 <!-- Event location: -->
                                <div class="form-group">
                                    <label>Event location</label>
                                    <input type="text" name="location" class="form-control form-text" placeholder="Page Title" value="<?php echo $event_loc;?>">
                                </div>

                                 <!-- Event Date: -->
                                <div class="form-group">
                                    <label>Event Date</label>
                                    <input type="date" name="date" class="form-control form-text" placeholder="Page Title" value="<?php echo $event_date;?>">
                                </div>

                                 <!-- Event Time: -->
                                <div class="form-group">
                                    <label>Event Time</label>
                                    <div class="form-row">
                                         <label>From:</label>
                                        <div class="col">
                                         <input type="time" name="starttime" class="form-control form-inline" placeholder="Page Title" value="<?php echo $event_start;?>">
                                       </div>
                                         <label>To:</label>
                                       <div class="col">
                                        <input type="time" name="endtime" class="form-control form-inline" placeholder="Page Title" value="<?php echo $event_end;?>">
                                       </div>
                                    </div>
                                </div>


                                <!-- Post text: -->
                                <div class="form-group mt-4">
                                    <label>Event description</label>
                                    <textarea name="eventtext" class="form-control" placeholder="Page Body" maxlength="255"><?php echo $event_text;?></textarea>
                                </div>
                                                                                                  
                                
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success" name="submit">Update event</button>
                                </div>


                            </form>

                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

</main>

<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->

<?php include 'rsc/import/php/components/footer_dashboard.php' ?>