<?php
$BaseUri = "http://restcustomerservicecookie.azurewebsites.net/service1.svc/";
$Customers="";

if (isset($_POST['GetCustomersKnap'])&!empty($_POST['GetCustomersFelt'])){
    $uri = $BaseUri . "customerdb/" . $_POST['GetCustomersFelt'];
    $jsondata = file_get_contents($uri);
    $convertToAssociativeArray = true;
    $Customers = json_decode($jsondata, $convertToAssociativeArray);
    $Customers = array($Customers);
}
elseif (isset($_POST['GetCustomersKnap'])){
    $uri = $BaseUri . "customersdb/";
    //if (!empty($_POST['GetCustomersFelt'])){
      //  $uri = $BaseUri . "customerdb/" . $_POST['GetCustomersFelt'];
        //print_r($uri);
   // }
    $jsondata = file_get_contents($uri);
//print_r($jsondata);
    $convertToAssociativeArray = true;
    $Customers = json_decode($jsondata, $convertToAssociativeArray);
   // print_r($Customers);
   // $Customers = array($Customers);
}



require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('restCustomers.html.twig');
$parametersToTwig = array("Customers"=>$Customers);
echo $template->render($parametersToTwig);