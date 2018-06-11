<?php
namespace app\controllers;

/**
 * ExamplesController
 *
 * @author Yaroslav Palamarchuk
 */
class ExamplesController extends AppController {
    
    
    public function indexAction(){
        if(!is_dir(ROOT . '/app/controllers/examples')){
            echo '<h2>Examples not installed</h2>';
            die;
        }
    }
}
