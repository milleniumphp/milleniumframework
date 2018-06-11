<?php
namespace mill\core\base;

/**
 * Description of Request
 *
 * @author Yaroslav Palamarchuk
 */
class Request {

    public $post = [];
    public $get = [];

    public function __construct() {
        $this->post = $this->post();
        $this->get = $this->get();
    }

    public function get() {
        $m = [];
        foreach ($_GET as $k => $post) {
            $m[$k] = chars($post);
        }
        return $m;
    }

    public function post() {
        $m = [];
        foreach ($_POST as $k => $post) {
            $m[$k] = chars($post);
        }
        return $m;
    }

    public function xss_protect(&$item) {
        $item = htmlspecialchars($item);
    }

}
