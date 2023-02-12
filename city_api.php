
<?php
include("navbar.htm");
require_once("includes\init.php");

if (!$session -> signed_in){
    header('Location: login.php');
    exit;
}


?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </head>
    <body>
        <h2>Welocome - Search City Name</h2>
        <p>Here you will check how to enter the city name correctly</p>
        <p>Please enter it to the form in the way the service shows you.</p>

        

        <form>
        
        <p> enter city name to search: <input id = "nir" name = "citytosearch" type="text" onchange="func()"></p>
        <div id = "options">
            <p>you choose wrote the letters: <b><span id = "enter"></span></b>.<br>
            look at your options - enter the city name as follows.
            <?php
            $temp = 'תל';
            $urlContents = "https://data.gov.il/api/3/action/datastore_search?resource_id=351d4347-8ee0-4906-8e5b-9533aef13595&q='".$temp."'";
            $data = file_get_contents($urlContents);
            $cities = json_decode($data, true);
            // print_r($cities);
            $cities = $cities['result']['records'];
            $i=0;
            while($i < count($cities)){
                echo ($cities[$i]['תעתיק']." || ");
                $i+=1;   
            }
            ?>
        </div>

    
    
    
    
    
    
    
    <label for="city">1. from witch city do you drive to the collage?</label>
    <input list = "list_cities" type='text' id = "city" name="city" autocomplete="off" oninput="citynamesUpdate()" aria-autocomplete="list" aria-labelledby="list_cities">
        <datalist id='list_cities'></datalist>
    
    </form>
    
    <script>

        function func() {
            let city = document.getElementById('nir').value;
            document.getElementById('enter').innerHTML = city;

        }
        // let city = document.getElementById("api");
        // console.log(city);
        // city.addEventListener("input",citynamesUpdate());
        
        function citynamesUpdate(){            
            let letters = document.getElementById("city").value;
            console.log(letters);
            let datalist = document.getElementById("list_cities");
            result = fetch('https://data.gov.il/api/3/action/datastore_search?resource_id=351d4347-8ee0-4906-8e5b-9533aef13595&q=' + letters)            
            .then(data=>{return data.json()})
            .then(res=>{
                const cities = res.result.records;
                deleteChilds();
                i= 0;
                while(i<5 && i<cities.length){
                    const option = document.createElement("option");
                    let x = Object.entries(cities[i]);
                    option.value = x[3][1];
                    datalist.appendChild(option);                    
                    i+=1;
                }
                console.log(datalist);                
            });
        }
     
        function deleteChilds() {
            var e = document.getElementById("list_cities");
            //e.firstElementChild can be used.
            var child = e.lastElementChild;
            while (child) {
                e.removeChild(child);
                child = e.lastElementChild;
            }
        }


    </script>
    </body>

</html>


<!-- .then(res=>{const city = res.result.records;
    console.log(city); -->