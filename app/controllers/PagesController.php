<?php
namespace app\controllers;

use \mill\core\App;
use \mill\html\Url;

/**
 * Description of base PagesController
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
        $post = $this->request->post;
        /**
        * create new user
        */
        $user = new \app\models\SignUpForm();
        /**
         * make new session for alerting
         */
        $session = $this->session;
        /**
         * if data is uploaded
         */
        if(!empty($post)){
            /**
             * give new user data from your form
             */
            $user->load($post);
            
            /**
             * if there is some troubles
             */
            if(!$user->validate($post) || !$user->checkUnique()){
                /**
                 * method for all errors
                 */
                $user->getErrors();
                /**
                 * save data which user has written
                 */
                $_SESSION['form_data'] = $post;
                /**
                 * refresh the page
                 */
                Url::redirect();
            }
            /**
             * password hashing
             */
            $user->attributes['password'] = hashstring($user->attributes['password']);
            /**
             * user saving
             */
            if($user->save('user')){
                /**
                 * make new alert message for user
                 */
                $_SESSION['success'] = 'You have registered!';
            }else{
                /**
                 * make danger message for user
                 */
                $_SESSION['error'] = 'Fail';
            }
            /*
             * and redirect to home page
             */
            Url::redirect('/'); 
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
         * make new session
         */
        $session = $this->session;
        /**
         * set meta tags of page
         */
        $this->metatags['title'] = 'Login';
        /**
         * if user clicks on submit button
         */
        $data = [
            [
                'login' => 'admin',
                'password' => 'admin'
            ],
            [
                'login' => 'user',
                'password' => 'user'
            ]
        ];
        $user = new \app\models\LoginForm();
        if(!empty($this->request->post)){
            /**
             * make new user
             */
            if($user->validate($this->request->post) && $user->login($data)){
                /**
                 * maek new alert
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
        App::$app->user->logout('/');

        
    }
    
}
