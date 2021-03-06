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
                        <li class="list-group-item text-light bg-dark">Event create</li>
                        <li class="list-group-item">

                            <form method="POST" action="create_handler.php?object=event&name=submit" enctype="multipart/form-data">

                                <!-- Event title: -->
                                <div class="form-group">
                                    <label>Event name</label>
                                    <input type="text" name="title" class="form-control form-text" placeholder="What's the name of your event?">
                                </div>

                                 <!-- Event Company: -->
                                <div class="form-group">
                                    <label for="inputCompany">Event company</label>
                                    <select id="inputCompany" name="company" class="form-control">
                                        <?php
                                        $sql = "SELECT * FROM Company ORDER BY Company_ID ASC";
                                        $result = mysqli_query($con, $sql);
                                        while ( $row = mysqli_fetch_array($result) ){
                                        echo '<option value="' . $row['Company_ID'] . '">' . $row['Company_Name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                 <!-- Event location: -->
                                <div class="form-group">
                                    <label>Event location</label>
                                    <input type="text" name="location" class="form-control form-text" placeholder="Where does the event take place?">
                                </div>

                                 <!-- Event Date: -->
                                <div class="form-group">
                                    <label>Event Date</label>
                                    <input type="date" name="date" class="form-control form-text" placeholder="What date is the event?">
                                </div>

                                 <!-- Event Time: -->
                                <div class="form-group">
                                    <label>Event Time</label>
                                    <div class="form-row">
                                         <label>From:</label>
                                        <div class="col">
                                         <input type="time" name="starttime" class="form-control form-inline" placeholder="What time does the event start?">
                                       </div>
                                         <label>To:</label>
                                       <div class="col">
                                        <input type="time" name="endtime" class="form-control form-inline" placeholder="What time does the event end?">
                                       </div>
                                    </div>
                                </div>


                                <!-- Post text: -->
                                <div class="form-group mt-4">
                                    <label>Event description</label>
                                    <textarea name="eventtext" class="form-control" placeholder="Give a short description of the event (maximum 255 characters)" maxlength="255" style="height: 200px"></textarea>
                                </div>
                                
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success" name="submit">Create event</button>
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