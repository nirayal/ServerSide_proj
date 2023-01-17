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
                <div class = "container-login-sign_up col-sm-1">
                    <button onclick="document.getElementById('log_in').style.display='block'" style="width:auto;" header>Login</button>
                    <h1> PHP Project</h1>
                    <button onclick="document.getElementById('sign_up').style.display='block'" style="width:auto;">Sign Up</button>
                </div>
            </navbar>
        </header>
        </navbar>
        <p>To the Transportaion Poll : <button><a href="poll_firstpage.php">Transportaion Poll</a></button></p>
        <p>To the poll statistics : <button><a href="#">Statistics</a></button></p>
        
        
        <!-- sign up section -->
        <div id = "sign_up" class = "modal"> 
            <span onclick = "document.getElementById('sign_up').style.display='none'" class = "close" title = "Close Modal">&times;</span>
            <form class = "modal-content" action = "sign_up.php" method = "post">
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
                <input type = "tel" placeholder = "Enter Phone Number" name = "phone" required><br>
                <!-- birth-day sign up -->
        
                <label for = "birth_day"><b>Birth Day</b></label>
                <input type = "date" placeholder = "enter birth day" name = "birth_day" required>
        
                <div class="clearfix">
                    <button type = "button" onclick = "document.getElementById('sign_up').style.display='none'" class = "cancelbtn">Cancel</button>
                    <button type = "submit" class = "signupbtn buttonSignUP">Sign Up</button>
                </div>
            </form>
        </div>

        <!-- Log in section -->
        <?php
        require_once("includes\init.php");

        $error = null;
        if(!$_POST['user_name'])
            $error .= "Error:  User Name is required for Log-in.<br>";
        else
        {
            $chars = str_split($_POST['user_name']);
            foreach($chars as $char)  
            {
                if(!ctype_alpha($char) || !is_numeric($char))
                {
                    $error .= "Error:  Full Name must contain only letters.<br>";
                    break;
                }
            }  
        }
        if(!$_POST['password'])
            $error .= "Error:  Password is required for sign-up.<br>";
        elseif(isset($error))
            $user_name = $_POST['user_name'];
            $password = $_POST['pasword'];
            $user = new User();
            $error = $user -> find_user_by_username_pass($user_name, $password);
            if(!$error)
            {
                $session -> login($user);
            }


        ?>
        <div id="log_in" class="modal">
            <p id = error><?php echo $error; ?> </p>
            <form class="modal-content animate" action="" method="post">
              <div class="container">
                <span onclick="document.getElementById('log_in').style.display='none'" class="close" title="Close Modal">&times;</span>
              </div>
      
              <div class="container">
                <label for = "user_name"><b>User Name</b></label>
                <input type = "text" placeholder = "Enter Username" name = "user_name" required>
      
                <label for = "password"><b>Password</b></label>
                <input type = "password" placeholder="Enter Password" name="pasword" required>
                  
                <button type = "submit">Login</button>
              </div>
      
              <div class="container" style="background-color:#f1f1f1">
                <button type = "button" onclick = "document.getElementById('log_in').style.display = 'none'" class = "cancelbtn">Cancel</button>
              </div>
            </form>
          </div>

        <script> // this is the script for the sign up
            // Get the modal
            // var modal_SU = document.getElementById('sign_up');
            var model_LI = document.getElementById('log_in');
        
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) 
                {
                    modal.style.display = "none";
                }
            }
            </script>
    
    </body>
</html>