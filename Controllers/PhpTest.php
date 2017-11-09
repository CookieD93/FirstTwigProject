<?php
function Sum($Str){
    $GemtData = explode(" ",$Str);
    $Result = 0;
    foreach ($GemtData as $Data=>$Value){
        $Result= $Result+$Value;
    }
    return $Result;
}
$Str = "";
$SumStr ="";
$SummedArray="";
$exploda="";
if (isset($_POST['Number'])){
    $Str = $_POST['Number'];

    if(preg_match("/[^0-9\s-]/",$Str)){
        header("location:index.php?fejl=1");
    }
   /* if(empty($Str)){
        header("location:index.php?fejl=2");
    }*/

   $SumStr = Sum($Str);

    $SummedArray = array_sum(explode(" ",$Str));

    $exploda = explode(" ",$Str);
    sort($exploda);
}
require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('PhpTest.html.twig');
$parametersToTwig = array("Str" => $Str, "SumStr" => $SumStr, "SummedArray" => $SummedArray, "exploda" => $exploda );
echo $template->render($parametersToTwig);
?>

