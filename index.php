<!DOCTYPE html>
<html>
    <head>
        <title>Nir Ayal, Tomer Ben Ami, Lior Sendik</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="sign_up.css">
        <link rel="stylesheet" href="log_in_styls.css">
    </head>
    <body>
        <header>
            <navbar>
                <button onclick="document.getElementById('log_in').style.display='block'" style="width:auto;">Login</button>
                <button onclick="document.getElementById('sign_up').style.display='block'" style="width:auto;">Sign Up</button>
                <h1> PHP Project</h1>
            </navbar>
        </header>
        <div id = "info"></div>
        <p>To the Transportaion Poll : <button><a href="poll_first_page.php">Transportaion Poll</a></button></p>
        <p>To the poll statistics : <button><a href="#">Statistics</a></button></p>
        
        
        <!-- sign up section -->
        <div id = "sign_up" class = "modal"> 
            <span onclick = "document.getElementById('sign_up').style.display='none'" class = "close" title = "Close Modal">&times;</span>
            <form class = "modal-content" action="sign_up.php" method = "post">
                <div class = "container">
                    <h1>Sign Up</h1>
                    <p>Please fill in this form to create an User.</p>
                    
                    <hr>
                    <!-- user name sing up -->
                    <label for = "user_name"><b>User Name</b></label>
                    <input type = "text" placeholder = "Enter User Name" name = "user_name" required>
                    <!-- full name sign up -->
                    <label for = "full_name"><b>Full Name</b></label>
                    <input type = "text" placeholder = "Enter Full Name" name = "full_name" required>
                    <!-- password and re password sign up -->
                    <label for = "password"><b>Password</b></label>
                    <input type = "password" placeholder = "Enter Password" name = "password" required>
            
                    <label for = "password-repeat"><b>Repeat Password</b></label>
                    <input type = "password" placeholder = "Repeat Password" name = "password-repeat" required>
                    <!-- email sign up -->
                    <label for = "email"><b>Email</b></label>
                    <input type = "text" placeholder = "Enter Email" name = "email" required>
                    
                    <label for = "phone"><b>Phone Number</b></label>
                    <input type = "tel" placeholder = "Enter Phone Number" name = "phone" required>
                    <!-- birth-day sign up -->
            
                    <label for = "birth_day"><b>Birth Day</b></label>
                    <input type = "date" placeholder = "enter birth day" name = "birth_day" required>
                    <hr>
                    <div class="clearfix">
                        <button type = "button" onclick = "document.getElementById('sign_up').style.display='none'" class = "cancelbtn">Cancel</button>
                        <!-- <button id = "submit" type = "button" value = "sign_up" class = "signupbtn buttonSignUP" onclick = "phpErrorFunc()">Sign Up</button> -->
                        <button type = "submit" class = "signupbtn buttonSignUP">Sign Up</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Log in section
        <?php
        require_once("includes\init.php");

        $error = null;
        if ($_POST) {
            if (!$_POST['user_name'])
                $error .= "Error:  User Name is required for Log-in.<br>";
            else {
                $chars = str_split($_POST['user_name']);
                foreach ($chars as $char) {
                    if (!ctype_alpha($char) || !is_numeric($char)) {
                        $error .= "Error:  Full Name must contain only letters.<br>";
                        break;
                    }
                }
            }
            if (!$_POST['password'])
                $error .= "Error:  Password is required for sign-up.<br>";
            elseif (isset($error))
                $user_name = $_POST['user_name'];
            $password = $_POST['pasword'];
            $user = new User();
            $error = $user->find_user_by_username_pass($user_name, $password);
            if (!$error) {
                $session->login($user);
            }
        }

        ?> -->
        <div id="log_in" class="modal">
            <p id = "error"><?php echo $error; ?> </p>
            <span onclick="document.getElementById('log_in').style.display='none'" class="close" title="Close Modal">&times;</span>
            <form class="modal-content animate" action="" method="post">
                <div class="container">
                    <h1>Log In</h1>
                    <p>Please fill in this form to Enter the system.</p>
                    <hr>
                    <!-- user name -->
                    <label for = "user_name"><b>User Name</b></label>
                    <input id = "user_name" type = "text" placeholder = "Enter Username" name = "user_name" required>
                    <!-- Password -->
                    <label for = "password"><b>Password</b></label>
                    <input id = "password" type = "password" placeholder="Enter Password" name="pasword" required>
                    <hr>
                    <div class="clearfix">
                        <button type = "button" onclick = "document.getElementById('log_in').style.display = 'none'" class = "cancelbtn">Cancel</button>
                        <button id = "submit" type = "button" value = "login" class = "signupbtn buttonSignUP" onclick = "login()">Login</button>
                        <!-- <button type = "submit" class = "signupbtn buttonSignUP">Login</button> -->
                    </div>
                </div>
            </form>
        </div>

        <script> // this is the script for the sign up
            // Get the modal
            
            var model_SU = document.getElementById('sign_up');
            var model_LI = document.getElementById('log_in');
        
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == model) 
                {
                    model.style.display = "none";
                }
            }

            function login() {
                var request = new XMLHttpRequest();
                request.onreadystatechange=function(){
                    if(request.readyState == 4 && request.status == 200){
                        document.getElementById("info").innerHTML = request.responseText;
                    }
                }
                request.open("POST","login.php",true);
                request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                request.send("user=" + document.getElementById("user_name").value + "&password=" + document.getElementById("password").value);
            }

           
        </script>                

    </body>
</html>