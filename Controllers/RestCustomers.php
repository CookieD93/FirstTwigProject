<?php
$BaseUri = "http://restcustomerservicecookie.azurewebsites.net/service1.svc/customerdb/";
$Customers="";

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
            );
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

if (isset($_POST['GetCustomersKnap'])&!empty($_POST['GetCustomersFelt'])){
    $uri = $BaseUri . $_POST['GetCustomersFelt'];
    $jsondata = file_get_contents($uri);
    $convertToAssociativeArray = true;
    $Customers = json_decode($jsondata, $convertToAssociativeArray);
    $Customers = array($Customers);
}
elseif (isset($_POST['GetCustomersKnap'])){
    $uri = "http://restcustomerservicecookie.azurewebsites.net/service1.svc/customersdb/";
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

if (isset($_POST['CreatueCustomerSubmit'])){
    $Data = array("FirstName"=>$_POST['CreateCustomerFName'],"LastName"=>$_POST['CreateCustomerLName'],"Year"=>$_POST['CreateCustomerYear']);
    $Data = json_encode($Data);
    $result = CallAPI("POST",$BaseUri,$Data);
}
if (isset($_POST['UpdateCustomerSubmit'])){

    $Data = array("Id"=>$_POST['UpdateCustomerId'],"FirstName"=>$_POST['CreateCustomerFName'],"LastName"=>$_POST['CreateCustomerLName'],"Year"=>$_POST['CreateCustomerYear']);
    $Data = json_encode($Data);
   print_r($Data);

    $result = CallAPI("PUT",$BaseUri,$Data);

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