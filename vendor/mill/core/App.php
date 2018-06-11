<?php

namespace mill\core;

use mill\core\Registry;
use mill\core\ErrorHandler;
/**
 * Description of App
 * Main Class for Application
 * @author Yaroslav Palamarchuk
 */
class App {

    public static $app;

    public function __construct() {
        session_start();
        self::$app = Registry::instance();
        new ErrorHandler();
    }

}
