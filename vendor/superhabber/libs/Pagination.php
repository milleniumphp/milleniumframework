<?php

namespace mill\libs;

/**
 * Description of Pagination
 *
 * @author Yaroslav Palamarchuk
 */
class Pagination {
    /**
     *
     * @var string
     */
    public $currentPage;
    /**
     * count per page
     * @var integer
     */
    public $perpage;
    /**
     * total pagination
     * @var integer
     */
    public $total;
    /**
     *
     * @var integer
     */
    public $countPages;
    /**
     *
     * @var string
     */
    public $uri;
        
    public function __construct($page, $perpage, $total) {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }
    /**
     * get pages count per page
     * @return integer
     */
    public function getCountPages(){
        return ceil($this->total / $this->perpage) ?: 1;
    }
    
    public function getCurrentPage($page){
        if(!$page || $page < 1) $page = 1;
        if($page > $this->countPages) $page = $this->countPages;
        return $page;
    }
    /**
     * return start number for controller[ LIMIT ]
     * @return integer
     */
    public function getStart(){
        return ($this->currentPage - 1) * $this->perpage;
    }
    /**
     * all GET params
     */
    public function getParams(){
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0] . '?';
        if(isset($url[1]) && $url[1] != ''){
            $params = explode( '&', $url[1] );
            foreach ($params as $param){
                if( !preg_match("#page=#", $param) ) $uri .= "{$param}&";
            }
        }
        return $uri;
    }
    
    public function __toString() {
        return $this->getHTml();
    }
    
    public function getHTml(){
        $back = null; //go back link
        $forward = null; //go forward link
        $startpage = null; // link to first page
        $endpage = null; //link to last page
        $page2left = null; //the second link to the left
        $page1left = null; //the first lenk to the left
        $page2right = null; //the second link to the right
        $page1right = null; //the first link to the right
        
        if($this->currentPage > 1){
            $back = "<li><a class='nav-link' href='{$this->uri}page=". ($this->currentPage - 1) . "'>&lt;</a></li>";
        }
        if($this->currentPage < $this->countPages){
            $forward = "<li><a class='nav-link' href='{$this->uri}page=". ($this->currentPage + 1) ."'>&gt</a></li>";
        }
        if($this->currentPage > 3){
            $startpage = "<li><a class='nav-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }
        if($this->currentPage < ($this->countPages - 2)){
            $endpage = "<li><a class='nav-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }
        if($this->currentPage - 2 > 0){
            $page2left = "<li><a class='nav-link' href='{$this->uri}page=". ($this->currentPage - 2) . "'>".($this->currentPage - 2) ."</a></li>";
        }
        if($this->currentPage - 1 > 0){
            $page1left = "<li><a class='nav-link' href='{$this->uri}page=". ($this->currentPage - 1) . "'>".($this->currentPage - 1) ."</a></li>";
        }
        if($this->currentPage + 1 <= $this->countPages){
            $page1right = "<li><a class='nav-link' href='{$this->uri}page=". ($this->currentPage + 1) . "'>". ($this->currentPage + 1) ."</a></li>";
        }
        if($this->currentPage + 2 <= $this->countPages){
            $page2right = "<li><a class='nav-link' href='{$this->uri}page=". ($this->currentPage + 2) . "'>".($this->currentPage + 2) ."</a></li>";
        }
        
        return '<ul class="pagination">'. 
                    $startpage. $back. $page2left. $page1left. 
                    '<li class="active"><a>'.$this->currentPage.'</a><li>'.$page1right. $page2right. $forward. $endpage. 
        '</ul>';
        
    }
   
}
    