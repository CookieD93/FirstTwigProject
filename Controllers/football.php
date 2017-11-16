<?php
$client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?WSDL");

$resultGroupCount = $client ->GroupCount();
$groupcount = $resultGroupCount -> GroupCountResult;

$resultGroups = $client -> Groups();
$groups = $resultGroups ->GroupsResult->tGroupInfo;


$countries = "";
if (isset($_GET['bWithcompetitors'])){
    $varFromDD = filter_var($_GET['bWithcompetitors'],FILTER_VALIDATE_BOOLEAN);
    $params = array("bWithCompetitors" => $varFromDD);
    //$params = array("bWithCompetitors" => $varFromDD);
//$resultCountries = $client->__soapCall('CountryNames',array('bWithCompetitors'=>$params));
    $resultCountries = $client->CountryNames($params);
    $countries = $resultCountries->CountryNamesResult->tCountryInfo;
}

require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('football.html.twig');
$parametersToTwig = array("groupcount" => $groupcount,"groups"=>$groups, "countries"=>$countries);
echo $template->render($parametersToTwig);