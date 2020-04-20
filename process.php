<?php

$fp = fopen($_FILES['fileToUpload']['tmp_name'], 'r');

while (($line = fgetcsv($fp)) !== FALSE) {

   $data = array("stdid" => $line[0],
                "code" => $line[1],
                "grade" => $line[4],
                "year" => $line[2],
                "seme" => $line[3],
                "owner" => $line[5]);                                                         

   $data_string = json_encode($data);
   echo "data send: ".$data_string."<br>";

   $url = "http:2000//localhost/add";   

   $ch = curl_init();
   curl_setopt($ch,CURLOPT_URL,"http://localhost:2000/add");
   curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
   $result = curl_exec($ch);
   $arr = json_decode($result);
   echo "response_code: ".$arr->res_code;
   echo "<br>";
   curl_close($ch);

}
?>