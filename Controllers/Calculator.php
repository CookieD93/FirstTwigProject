<?php

$result = "";
if(isset($_POST['Udregn'])){
    /*if($_POST['operators']=="+"){
        echo $_POST['NumberOne'] + $_POST['NumberTwo']."<br><br>";
    }
    elseif($_POST['operators']=="-"){
        echo $_POST['NumberOne'] - $_POST['NumberTwo']."<br><br>";
    }
    elseif($_POST['operators']=="*"){
        echo $_POST['NumberOne'] * $_POST['NumberTwo']."<br><br>";
    }
    elseif($_POST['operators']=="/"){
        if($_POST['NumberTwo']==0){echo "Can't Divide by Zero";}
        else
        {
        echo $_POST['NumberOne'] / $_POST['NumberTwo']."<br><br>";
        }
    }*/
        switch ($_POST['operators']){
        case "+":
            $result = $_POST['NumberOne'] + $_POST['NumberTwo'];
            break;
        case "-":
            $result = $_POST['NumberOne'] - $_POST['NumberTwo'];
            break;
        case "*":
            $result = $_POST['NumberOne'] * $_POST['NumberTwo'];
            break;
        case "/":
            if($_POST['NumberTwo']==0){$result = "Can't Divide by Zero";}
            else
            {
                $result = $_POST['NumberOne'] / $_POST['NumberTwo'];
            }
            break;
    }
}
require_once '../vendor/autoload.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader, array(
    'auto_reload' => true
));
$template = $twig->loadTemplate('Calculator.html.twig');
$parametersToTwig = array("result" => $result);
echo $template->render($parametersToTwig);

?>

