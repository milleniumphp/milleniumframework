<?php

namespace mill\core;

/**
 * default error handler for all errors and exceptions
 * error files in /vendor/mill/core/local/errors 
 * @author Yaroslav Palamarchuk
 */

class ErrorHandler {
    
    /**
     * check debug or not
     */
    public function __construct() {  
        if(DEBUG){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
    }
    
    /**
     * special function for errors logging
     * @param string $message
     * @param string $file
     * @param string $line
     */
    protected function logErrors($message = '', $file = '', $line = '') {
        error_log("[" . date('Y-m-d H:i:s') . "] Error text: {$message} | File: {$file}, | Line: {$line}\n=============\n", 3, ROOT.'/tmp/logs/errors.log');
    }
    
    /**
     * handler for simple exceptions
     * @param Exception $e
     */
    public function exceptionHandler($e) {
        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Exception Error', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }
    
    public function errorHandler($errno, $errstr, $errfile, $errline) {
        $this->logErrors($errstr, $errfile, $errline);
        if(DEBUG || in_array($errno, [E_USER_ERROR, E_RECOVERABLE_ERROR])){
            $this->displayError($errno, $errstr, $errfile, $errline, 500);
        }
        return true;
    }
    
    /**
     * get error viewing file 
     * @param int $errno error number
     * @param string $errstr error text
     * @param string $errfile
     * @param int $errline
     */
    public function displayError($errno, $errstr, $errfile, $errline, $response = 500) {
        http_response_code($response);
        if($response == 404 && !DEBUG){
            die;
        }
        if(DEBUG){
            require CORE . '/local/errors/dev.php';die;
        }else{
            require CORE . '/local/errors/prod.php';
        }
    }
    
    public function fatalErrorHandler() {
        $error = error_get_last();
        if( !empty($error) && $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR) ){
            $this->logErrors($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        }else{
            ob_end_flush();
        }
    }
}
