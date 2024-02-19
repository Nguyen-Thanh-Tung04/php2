<?php
namespace App\Controllers;

use eftec\bladeone\BladeOne;

class BaseController {
    protected function render($view,$data=[]) {
        $viewDir = "./app/Views";
        $storageDir = "./storage";
        $blade = new BladeOne($viewDir,$storageDir,BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
        echo $blade->run($view,$data); 
    }
}
?>
