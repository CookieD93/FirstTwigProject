<?php

if(isset($_GET['fejl'])){
    $Fejlmeddelelse = "";
    switch ($_GET['fejl']){

        case 1:
            $Fejlmeddelelse = "Der må ikke stå bogstaver i feltet";
            break;
    }


}
else{$Fejlmeddelelse = "";}

require_once 'vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
'auto_reload' => true
));
$template = $twig->loadTemplate('index.html.twig');
$parametersToTwig = array("Fejlmeddelelse" => $Fejlmeddelelse);
echo $template->render($parametersToTwig);