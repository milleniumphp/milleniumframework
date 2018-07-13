<?php
namespace mill\core\base;

/**
 * Description of ErrorController
 *
 * @author Yaroslav Palamarchuk
 */
class ErrorController extends Controller {
    /**
     * response code
     * @var int 
     */
    public $response;
    
    public $errorview = 'default';
    
    public $layout;
    
    public $vroute;

    /**
     * get response code from ErrorHandler
     * @param int $code
     */
    public function __construct($code, $view = '', $layout = '', $vroute = []) {
        $this->errorview = $view ?: 'default';
        $this->layout = $layout ?: LAYOUT;
        $this->response = $code;
        $this->vroute = $vroute;
    }

    /**
     * Errors for users[but you can add for project admins if you need that]
     * @param int $errno
     * @param string $errstr
     */
    public function usererror($errno = 8, $errstr) {
        
        $code = $this->response;
        $this->set([
            'error_code'=> $this->response,
            'error_message'=>$errstr
        ]);
        
        $this->route = [
            'controller'=> 'error',
            'action'=> 'error',
            'prefix'=> $this->vroute['prefix']
        ];
        $this->metatags['title'] = $this->response . ' ' . $errstr;
        $this->view = $this->errorview;
        $this->layout = $this->layout;
        $this->getView();
    }

}
