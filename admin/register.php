<?php  session_start(); ?>
<!-- you need to include the shieldui css and js assets in order for the charts to work -->
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>

<div class="container" id="f1">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div id="panel1" class="panel panel-default">
            <h1>Register to Sustainable Tourism</h1>
            
            <fieldset>
                <legend><span class="number">1</span>User basic info</legend>
                <label for="name">First name:</label>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon1"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" class="form-control" placeholder="Enter user first name here..." aria-describedby="sizing-addon1">
                </div>
                <br />
                <label for="mail">Last name:</label>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input type="text" class="form-control" placeholder="Enter user last name here..." aria-describedby="sizing-addon2">
                </div>
                <br />
                <label for="pass">Email</label>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-cog"></span></span>
                    <input type="password" class="form-control" placeholder="Enter user Email here..." aria-describedby="sizing-addon3" id="pass">
                </div>
                <br />
                   <label for="pass">Password</label>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-cog"></span></span>
                    <input type="password" class="form-control" placeholder="Enter user password here..." aria-describedby="sizing-addon3" id="pass">
                </div>
                <br />



                  <!-- Skal backend ha en confirm funksjon på passord? -->
                <label for="pass_confirm">Confirm password:</label>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon4"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input type="password" class="form-control" placeholder="Confirm user password" aria-describedby="sizing-addon4" id="confirmPass">
                </div>
                <p id="passwordMatch"></p>
                <!-- Skal backend ha en confirm funksjon på passord? -->


                <br />
                   <label for="pass">UserType:</label>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-cog"></span></span>
                    <input type="password" class="form-control" placeholder="Enter your UserType here..." aria-describedby="sizing-addon3" id="pass">
                </div>
                <br />
                   <label for="pass">Phone</label>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon3"><span class="glyphicon glyphicon-cog"></span></span>
                    <input type="password" class="form-control" placeholder="Enter your phone number here..." aria-describedby="sizing-addon3" id="pass">
                </div>
                <br />



                <label for="job">Company:</label>
                <select id="job" name="user_job">
                    <optgroup label="Web">
                        <option value="frontend_developer">Front-End Developer</option>
                        <option value="php_developor">PHP Developer</option>
                        <option value="python_developer">Python Developer</option>
                        <option value="rails_developer">Rails Developer</option>
                        <option value="web_designer">Web Designer</option>
                        <option value="WordPress_developer">WordPress Developer</option>
                    </optgroup>
                    <optgroup label="Mobile">
                        <option value="Android_developer">Androild Developer</option>
                        <option value="iOS_developer">iOS Developer</option>
                        <option value="mobile_designer">Mobile Designer</option>
                    </optgroup>
                    <optgroup label="Business">
                        <option value="business_owner">Business Owner</option>
                        <option value="freelancer">Freelancer</option>
                    </optgroup>
                    <optgroup label="Other">
                        <option value="secretary">Secretary</option>
                        <option value="maintenance">Maintenance</option>
                    </optgroup>
                </select>
            </fieldset>
        

            <input id="b1" type="button" value="Sign Up" />
            <footer>
                <p id="footer">Created by <a href="">ProSys3</a></p>
            </footer>
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

<style>
    #f1
    {
        font-family: 'Nunito', sans-serif;
        color: #384047;
    }

    #panel1
    {
        padding: 10px 20px;
        background: #f4f7f8;
        border-radius: 8px;
    }

    h1
    {
        margin: 0 0 30px 0;
        text-align: center;
    }

    #f1 input[type="text"],
    #f1 input[type="password"],
    #f1 input[type="date"],
    #f1 input[type="datetime"],
    #f1 input[type="email"],
    #f1 input[type="number"],
    #f1 input[type="search"],
    #f1 input[type="tel"],
    #f1 input[type="time"],
    #f1 input[type="url"],
    #f1 textarea,
    #f1 select
    {
        background: rgba(255,255,255,0.1);
        
        font-size: 16px;
        height: auto;
        margin: 0;
        outline: 0;
        padding: 15px;
        width: 100%;
        background-color: #fff;
        color: #8a97a0;
        box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
    }

    #f1 textarea,
    #f1 select

    {
        border: 1px solid #ccc;
    }

    #f1 input[type="radio"],
    #f1 input[type="checkbox"]
    {
        margin: 0 4px 8px 0;
    }

    #f1 .sui-sprite.sui-calendar-icon
    {
        margin-top: 14px;
    }

    #b1
    {
        padding: 19px 39px 18px 39px;
        color: #FFF;
        background-color: #4bc970;
        font-size: 18px;
        text-align: center;
        font-style: normal;
        border-radius: 5px;
        width: 550px;
        margin-left: 605px;
        border: 1px solid #3ac162;
        border-width: 1px 1px 3px;
        box-shadow: 0 -1px 0 rgba(255,255,255,0.1) inset;
        margin-bottom: 10px;
    }

    fieldset
    {
        margin-bottom: 30px;
        border: none;
        width: 30%;
        margin-left:600px;
        s
    }

    legend
    {
        font-size: 1.4em;
        margin-bottom: 10px;
        margin-left: 180px;
    }

    label
    {
        display: block;
        margin-bottom: 8px;
        

    }

        label.light
        {
            font-weight: 300;
            display: inline;

        }

    .number
    {
        background-color: #5fcf80;
        color: #fff;
        height: 30px;
        width: 30px;
        display: inline-block;
        font-size: 0.8em;
        margin-right: 4px;
        line-height: 30px;
        text-align: center;
        text-shadow: 0 1px 0 rgba(255,255,255,0.2);
        border-radius: 100%;
        text-align: center;
    }   

    #footer
    {
        font-size: 10px;
        text-align: center;
        font-weight: bold;
    }

    #passwordMatch
    {
        text-align: center;
    }

    .input-group-addon
    {
        background-color: #e8eeef;
    }

    #or
    {
        text-align: center;
        font-weight: bold;
    }

    .social
    {
        list-style-type: none;
        background: #29AFBB;
        height: 52px;
        border: 2px solid#218C95;
    }

        .social li
        {
            padding-right: 20px;
            display: inline-block;
            font-size: 27px;
            border-bottom: 5px solid#29AFBB;
            cursor: pointer;
            margin-top: 5px;
        }

            .social li a
            {
                color: #fff;
                vertical-align: -webkit-baseline-middle;
            }
</style>

<script type="text/javascript">
    jQuery(function ($) {
        $(function () {
            $("#dateTimePicker").shieldDatePicker();

            $('#confirmPass').on('keyup', function () {
                if ($('#confirmPass').val() == $('#pass').val()) {
                    $('#passwordMatch').html('Passwords match!').css('color', 'green');
                }
                else {
                    $('#passwordMatch').html('Passwords do not match!').css('color', 'red');
                }
            });
        });
    });
</script>