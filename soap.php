<?php
$client = new SoapClient("http://api.radioreference.com/soap2/?wsdl&v=latest");
if(extension_loaded("soap")){
    $countries = $client->getCountryList();
    foreach($countries as $country){
        echo "<h4> country: ".$country->countryName."</h4>";
        echo "<h4> code: ".$country->countryCode."</h4>";
    }
}
else{
    die("soap is not loaded");
}

?>