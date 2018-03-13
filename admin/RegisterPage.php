<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="Login.css">
</head>

<body style="background-color: black">
<div align="center">
    <div style="width:300px; border: solid 1px #333333; " align="left">
        <div style="background-color:#333333; color:#FFFFFF; padding:3px; "><b>Register</b></div>
        <div style="margin:30px">



            <form action="Register.php" method="POST" style="color : white">
                <label>First name  :</label><input type="text" name="fname" class = "box" required>
                <br /><br />
                <label>Last name  :</label><input type="text" name="lname" class = "box" required>
                <br /><br />
                <label>Username  :</label><input type="text" name="useracc" class = "box" required>
                <br /><br />
                <label>Password  :</label><br><input type="Password" name="pass" class = "box" required>
                <br /><br />
                <label>UserType  :</label><input type="text" name="usertype" class = "box" required>
                <br /><br />
                <label>Email  :</label><br><input type="text" name="email" class = "box" required>
                <br /><br />
                <label>Phone    :<br /></label><input type="text" name="phone" class = "box" required>
                <br /><br />
                <label>Company  :</label><input type="text" name="company" class = "box" required>
                <br /><br />
                <button type="submit" value='submit' name='submit'>Register</button>

            </form>



        </div>
    </div>

</div>
</body>
</html>