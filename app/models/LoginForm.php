<?php
namespace app\models;

/**
 * Description of Login Form Base Class
 * @author Yaroslav Palamarchuk
 */
class LoginForm extends \mill\core\base\Model {

    public $attributes = [
        'login' => '',
        'password' => ''
        
    ];
    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            
        ],

    ];

}
