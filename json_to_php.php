<?php
$ip_api = '{ "query": "24.48.0.1", "status": "success", "country": "Canada", "countryCode": "CA", "region": "QC", "regionName": "Quebec", "city": "Montreal", "zip": "H1K", "lat": 45.6085, "lon": -73.5493, "timezone": "America/Toronto", "isp": "Le Groupe Videotron Ltee", "org": "Videotron Ltee", "as": "AS5769 Videotron Telecom Ltee" }';
$ip_api_obj = json_decode($ip_api);
if($ip_api_obj === null) {
 echo "This is an invalid json structure";
}else{
 echo "This is a valid json structre"; 
 print_r($ip_api_obj);   
};