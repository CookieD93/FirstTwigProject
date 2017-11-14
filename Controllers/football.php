<?php
$client = new SoapClient("http://footballpool.dataaccess.eu/data/info.wso?WSDL");

$result = $client ->GroupCount();

$groupcount = $result -> GroupCountResult;

require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('football.html.twig');
$parametersToTwig = array("result" => $groupcount);
echo $template->render($parametersToTwig);