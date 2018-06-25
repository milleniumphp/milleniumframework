<?php

namespace mill\core\local\examples;

/**
 * Description of Examples
 * @author Yaroslav Palamarchuk
 */
class Examples {

    public $argv;

    public function __construct($argv) {
        $this->argv = $argv;
    }

    public function make() {
        $this->folders();
        $this->migrations();
    }

    public function folders() {
        $system = ROOT . '/vendor/mill/libs/system';
        
        if (!is_dir(ROOT.'/sections/examples/')) mkdir(ROOT.'/sections/examples/');
        if (!is_dir(ROOT . '/sections/examples/views/')) mkdir(ROOT . '/sections/examples/views/');
        if (!is_dir(ROOT . '/sections/examples/controllers/')) mkdir(ROOT . '/sections/examples/controllers/');
        if (!is_dir(ROOT . '/sections/examples/models/')) mkdir(ROOT . '/sections/examples/models/'); 

        $this->copydir($system . '/examples/controllers/', ROOT . '/sections/examples/controllers');
        
        $this->copydir($system . '/examples/views/Shop', ROOT . '/sections/examples/views/Shop/');

        $this->copydir($system . '/examples/views/layouts', ROOT . '/sections/examples/views/layouts/');

        copy($system . '/examples/migrations/examples_shopcategories_1_64459388.php', ROOT . '/app/migrations/examples_shopcategories_1_64459388.php');
        copy($system . '/examples/migrations/examples_shopproducts_1_1241795668.php', ROOT . '/app/migrations/examples_shopproducts_1_1241795668.php');
        copy($system . '/examples/views/index.php', ROOT . '/sections/examples/views/index.php');
    }

    public function migrations() {
        exec('php mill migration migrate examples_shopproducts');
        exec('php mill migration migrate examples_shopcategories');
    }

    public function copydir($source, $destination) {
        if (!is_dir($destination)) {
            $oldumask = umask(0);
            mkdir($destination);
            umask($oldumask);
        }
        $dir_handle = @opendir($source) or die("Unable to open");
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != ".." && !is_dir("$source/$file")) copy("$source/$file", "$destination/$file");
        }
    }

}
