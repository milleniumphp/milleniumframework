<?php
namespace sections\examples\controllers;

/**
 * @author Yaroslav Palamarchuk
 */
class ShopController extends \app\controllers\AppController {

    public $layout = 'shop';
    
    public $errorview = 'shop';

    public function indexAction() {  
        $total = \R::count('examples_shopproducts');

        $page = isset( $this->request->get['page'] ) ? (int) chars( $this->request->get['page'] ) : 1;

        $pagination = new \mill\libs\Pagination($page, 6, $total);
        $start = $pagination->getStart();

        $products = \R::findAll('examples_shopproducts', "LIMIT $start, 6");
        
        $tshirts = \R::findAll('examples_shopproducts', 'category_id = ? OR category_id = ? OR category_id = ? ORDER BY RAND() LIMIT 4', [10, 11, 12]);
        
        $this->set(compact('products', 'tshirts', 'pagination'));
    }

    public function categoryAction() {
        $category = \R::findOne('examples_shopcategories', 'id = ? LIMIT 1', [ $this->request->get['id'] ]);

        $this->metatags['title'] = 'Category'. $category['title']; 
        $total = \R::count('examples_shopproducts', 'category_id = ?', [ $category['id'] ]);
        

        $page = isset( $this->request->get['page'] ) ? (int) chars( $this->request->get['page'] ) : 1;

        $perpage = 3;

        $pagination = new \mill\libs\Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $things = \R::findAll('examples_shopproducts', "WHERE category_id = {$category['id']} LIMIT $start, $perpage");

        $this->set(compact('things', 'pagination'));
    }
    
    public function cartAction(){
        $this->layout = false;
        $c = isset($_SESSION['cart']) ? $_SESSION['cart'] : 'Cart is empty!';
        $this->set(compact('c'));
    }
    
    public function addtocartAction(){
        $this->layout = false;
        
        if($this->isAjax()){
            $id = (int)$this->request->post['id'];
            $pr = \R::findOne('examples_shopproducts', 'WHERE id = ? LIMIT 1', [$id]);
            foreach($pr as $k => $v){
                $_SESSION['cart'][$id][] = [$k=>$v];
            };
        }
        
    }

}
