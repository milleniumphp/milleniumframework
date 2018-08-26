<?php
namespace app\controllers;

use mill\core\base\User;
use \mill\html\Url;

/**
 * PagesController
 *
 * @author Yaroslav Palamarchuk
 */
class PagesController extends AppController{
    
    /**
     * index base page action 
     */
    public function indexAction() {  
        $this->metatags['title'] = 'Main Page';
    }

    /**
     * contacts base action 
     */
    public function contactsAction(){
        $this->metatags['title'] = 'Contacts Page';
    }
    /**
     * about base action 
     */
    public function aboutAction(){
        $this->metatags['title'] = 'About Page';
    }
    
    /**
     * signup example
     */
    public function signupAction() {
        /**
         * you always can set meta tags of yout page like this:
         * $this->metatags['title', 'keywords', 'description']
         */
        $this->metatags['title'] = 'Signup';
        /**
         * special htmlspecialchars method for post data
         * never use $_POST method
         */
        $post = \Mill::$request->get(INPUT_POST);
        /**
        * create new user
        */
        $user = new \app\models\SignUpForm();
        /**
         * make new session for alerting
         */
        $session = \Mill::$session;
        /**
         * if data is uploaded
         */
        if(!empty($post)){
            
            /**
             * if there is some troubles
             */
            if(!$user->validate($post) || !$user->checkUnique()){
                /**
                 * method for all errors
                 */
                $user->getErrors($session);
                /**
                 * save data which user has written
                 */
                $_SESSION['form_data'] = $post;
                /**
                 * refresh the page
                 */
                //Url::redirect();
            }
            /**
             * password hashing
             */
            $post['password'] = hashstring($post['password']);
            /**
             * user saving
             */
            if($user->validate($post) && \Mill::$user->save($post, 'user')){
	            Url::redirect('/');
            }else{
                /**
                 * make danger message for user
                 */
                $user->getErrors($session);
            }

        }
        
        $this->set([
            'session'=>$session,
            'model'=>$user
        ]);
    }
    /**
     * login handler example
     */
    public function loginAction(){
        /**
         * create new session
         */
        $session = \Mill::$session;
        /**
         * set meta tags of page
         */
        $this->metatags['title'] = 'Login';
        $post = \Mill::$request->get(INPUT_POST);

        $user = new \app\models\LoginForm();
        if(!empty($post)){

            /**
             * make new user
             */
            if($user->validate($post) && $user->login($post['login'], $post['password'])){
                /**
                 * make new alert
                 */
                Url::redirect('/');
            }else{
                $user->getErrors($session);
            } 
            
        }
       /**
        * put the variables to the view file
        */
        $this->set(compact('session', 'user'));
    }
    /**
     * base logout action for loginned user
     */
    public function logoutAction(){
        \Mill::$user->logout('/');
    }
    
}
