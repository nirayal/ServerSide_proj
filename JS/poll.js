//for poll 1
function updateText1() {
    var answer = document.getElementById("vehicle1").value;                   
    if(answer == 'car'){
        document.getElementById("car").style.display = 'block';
    }else{
        document.getElementById("car").style.display = 'none';
    }
    if(answer == 'bus'){
        document.getElementById("bus").style.display = 'block';
    }else{
        document.getElementById("bus").style.display = 'none';
    }
    if(answer == 'motorcycle'){
        document.getElementById("motor").style.display = 'block';
    }else{
        document.getElementById("motor").style.display = 'none';
    }
    if(answer == 'bike'){
        document.getElementById("bike").style.display = 'block';
    }else{
        document.getElementById("bike").style.display = 'none';
    }
    if(answer == 'e-bike'){
        document.getElementById("e-bike").style.display = 'block';
    }else{
        document.getElementById("e-bike").style.display = 'none';
    }
    if(answer == 'foot'){
        document.getElementById("foot").style.display = 'block';
    }else{
        document.getElementById("foot").style.display = 'none';
    }
}

//for poll 2
function updateText_q_23() {
    var answer = document.getElementById("q_23").value;                   
    if(answer == 'yes'){
        document.getElementById("yes").style.display = 'block';
    }else{
        document.getElementById("yes").style.display = 'none';
    }
}

//for poll 3
function movingPage(){
    window.location.href="index.php";
}

function updateText_q_32() {
    var answer = document.getElementById("q_32").value;                   
    if(answer == 'yes'){
        document.getElementById("yes").style.display = 'block';
    }
    else{
        document.getElementById("yes").style.display = 'none';
    }
}