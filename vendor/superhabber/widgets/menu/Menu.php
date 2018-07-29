<?php
namespace mill\widgets\menu;

use mill\core\App;
/**
 * Description of Menu
 * base menu widget with parent::child relations
 * @author Yaroslav Palamarchuk
 */
class Menu {
    
    protected $data;
    /**
     * 
     * @var array
     */
    protected $tree;
    /**
     *  container for html code
     * @var string
     */
    protected $menuHtml;
    /**
     *  template for menu widget
     * @var string
     */
    protected $tpl = __DIR__ . "/menu_tpl/menu.php";
    /**
     *
     * @var string 
     */
    protected $container = 'ul';
    /**
     *  class of container
     * @var string
     */
    protected $class = 'widget_menu';
    /** 
     * table in db from which we wanna get data[ example:categories ]
     * @var string
     */
    protected $table = 'categories';
    /**
     * menu caching properties
     * cache['on'] = true - turn on caching
     * cache['time'] = 3600 - set cache time in seconds
     * @var array
     */
    protected $cache = [
        'on'=>true,
        'time'=>3600
    ];
    
    public function __construct($options = []) {
        $this->getOptions($options);
        /**
         * run main widget function
         */
        $this->run();
        
    }
       
    /**
     * main function 
     */
    protected function run(){
        /** 
         * use cache for menu optimization
         */
        if($this->cache['on']){
            if(App::$app->cache->get($this->table)){
                $this->data = App::$app->cache->get($this->table);
            }else{
                $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
                App::$app->cache->set($this->table, $this->data, $this->cache['time']); 
            }
        }
         
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        $this->output();
    }
    
    public function output() {
        echo "<{$this->container} class='{$this->class}'>";
            echo $this->menuHtml;
        echo "</{$this->container}>";
    }
    
    public function getOptions($options) {
        foreach ($options as $k => $v){
            if(property_exists($this, $k)){
                $this->$k = $v;
            }
        }
    }
    /**
     * get widget tree
     * @return array
     */
    protected function getTree(){
        $tree = [];
        $data = $this->data;

	foreach ($data as $id=>&$node) {    
            if (!$node['parent']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }
        /**
         * tree wirh parents and childs
         */
	return $tree;
    }
    
    /**
     * 
     * @param array $tree
     * @param string $tab
     */
    public function getMenuHtml($tree, $tab = ''){
        $menu = '';
        foreach ($tree as $id => $category) {
            $menu .= $this->catToTemplate($category, $tab, $id);
        }
        return $menu;
    }
    
    public function catToTemplate($category, $tab, $id){
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}
