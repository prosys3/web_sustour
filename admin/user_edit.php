<?php
session_start();
if(!isset($_SESSION['login'])){
    header("Location:../login.php");
    exit();
}
?>
<?php include 'rsc/import/php/components/head_dashboard.php' ?>
<?php include 'rsc/import/php/components/header_dashboard.php' ?>

<!--
##################################################################################
######################## ! DO NOT EDIT ABOVE THIS POINT ! ########################
##################################################################################
-->


<?php

$id = $_GET['id'];

$sql = "SELECT * FROM User_Data WHERE User_ID =" . $id;

$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$fname      = $row['User_Name_First'];
$lname      = $row['User_Name_Last'];
$email      = $row['User_Email'];
$type       = $row['User_Type'];
$phone      = $row['User_Phone'];
$company    = $row['User_Company'];

?>


<main>

    <section class="bg-primary">

        <div class="container text-center">

            <div style="height: 50px"></div>
            <img src="../rsc/img/logo/sustour/logo_symbol_green.svg" width="100" alt="Logo">
            <div style="height: 50px"></div>

        </div>

    </section>

    <hr>

    <section>

        <div class="container">

            <form action="user_login_script.php" method="post">

                <!-- First name: -->
                <div class="form-group">
                    <label for="inputNameFirst">First name:</label>
                    <input id="inputNameFirst" name="fname" class="form-control" type="text" value="<?php echo $fname; ?>" autofocus required>
                </div>

                <!-- Last name: -->
                <div class="form-group">
                    <label for="inputNameLast">First name:</label>
                    <input id="inputNameLast" name="lname" class="form-control" type="text" value="<?php echo $lname; ?>" required>
                </div>

                <!-- Email address: -->
                <div class="form-group">
                    <label for="inputEmail">Email address</label>
                    <input id="inputEmail" name="email" class="form-control" type="email" value="<?php echo $email; ?>" required>
                </div>

                <!-- Password: -->
                <div class="form-group">
                    <label for="inputPassword">Password:</label>
                    <input id="inputPassword" name="pass" class="form-control" type="password" placeholder="Enter new password" required>
                </div>

                <!-- User type: -->
                <div class="form-group">
                    <label for="inputUserType">User type:</label>
                    <select id="inputUserType" name="usertype" class="form-control" selected="">
                        <?php
                        $sql = "SELECT * FROM User_Type ORDER BY User_Type_ID DESC";
                        $result = mysqli_query($con, $sql);

                        while ( $row = mysqli_fetch_array($result) ){

                            if ( $row['User_Type_ID'] == $type ) {

                                echo '<option value="' . $row['User_Type_ID'] . '" selected>' . $row['User_Type_Name'] . '</option>';

                            } else {

                                echo '<option value="' . $row['User_Type_ID'] . '">' . $row['User_Type_Name'] . '</option>';

                            }


                        }
                        ?>
                    </select>
                </div>

                <!-- Phone number: -->
                <div class="form-group">
                    <label for="inputPhone">Phone number:</label>
                    <input id="inputPhone" name="phone" class="form-control" type="tel" value="<?php echo $phone; ?>">
                </div>

                <!-- User company: -->
                <div class="form-group">
                    <label for="inputCompany">User company</label>
                    <select id="inputCompany" name="company" class="form-control">

                        <?php
                        $sql = "SELECT * FROM Company ORDER BY Company_ID ASC";
                        $result = mysqli_query($con, $sql);

                        while ( $row = mysqli_fetch_array($result) ){

                            if ( $row['Company_ID'] == $company ) {

                                echo '<option value="' . $row['Company_ID'] . '" selected>' . $row['Company_Name'] . '</option>';

                            } else {

                                echo '<option value="' . $row['Company_ID'] . '">' . $row['Company_Name'] . '</option>';

                            }
                        }
                        ?>

                    </select>
                </div>

                <button type="submit" name="submit_user" class="btn btn-primary">Submit</button>

            </form>

        </div>

    </section>

</main>


<!--
##################################################################################
######################## ! DO NOT EDIT BELOW THIS POINT ! ########################
##################################################################################
-->
