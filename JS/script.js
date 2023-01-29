// this is the script for the sign up
// Get the modal

var model_SU = document.getElementById('sign_up');
var model_LI = document.getElementById('log_in');
var sessionValue;

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == model) 
    {
        model.style.display = "none";
    }
}

// function checkSession(){
//     var user_name = "<?php echo $_SESSION['user_name'];?>";
//     document.getElementById("tomer").innerHTML(user_name);
// }

// function log_out(){
//     sessionValue = null;
//     <?php $session -> logout();?>
//     document.getElementById("log_in_btn").style.display='inline-block';
//     document.getElementById("sign_up_btn").style.display='inline-block';
//     document.getElementById("log_out_btn").style.display='none';
// }
// function log_in_fun(){
//     sessionValue= document.getElementById("hdnSession").data;
//     window.alert(sessionValue);
//     if (sessionValue != null){
//         document.getElementById("log_in_btn").style.display='none';
//         document.getElementById("sign_up_btn").style.display='none';
//         document.getElementById("log_out_btn").style.display='block';
//     }
// }




function sign_up() {
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
