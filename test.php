<?php

$urlContents = "https://data.gov.il/api/3/action/datastore_search?resource_id=1b14e41c-85b3-4c21-bdce-9fe48185ffca&limit=5";
$data = file_get_contents($urlContents);
$cities = json_decode($urlContents, true);
print_r($cities);


?>