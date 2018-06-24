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

        $this->copydir($system . '/examples/controllers/', ROOT . '/app/controllers/examples/');

        $this->copydir($system . '/examples/views/error/examples', ROOT . '/app/views/error/examples/');

        if (!is_dir(ROOT . '/app/views/examples/')) mkdir(ROOT . '/app/views/examples/');

        $this->copydir($system . '/examples/views/examples/Shop', ROOT . '/app/views/examples/Shop/');

        $this->copydir($system . '/examples/views/layouts/examples', ROOT . '/app/views/layouts/examples/');

        copy($system . '/examples/migrations/examples_shopcategories_1_64459388.php', ROOT . '/app/migrations/examples_shopcategories_1_64459388.php');
        copy($system . '/examples/migrations/examples_shopproducts_1_1241795668.php', ROOT . '/app/migrations/examples_shopproducts_1_1241795668.php');
        copy($system . '/examples/views/examples/index.php', ROOT . '/app/views/examples/index.php');
    }

    public function migrations() {
        exec('php mill migration migrate examples_shopproducts');
        exec('php mill migration migrate examples_shopcategories');
    }

    public function copydir($source, $destination) {
        if (!is_dir($destination)) {
            $oldumask = umask(0);
            mkdir($destination, 01777);
            umask($oldumask);
        }
        $dir_handle = @opendir($source) or die("Unable to open");
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != ".." && !is_dir("$source/$file")) copy("$source/$file", "$destination/$file");
        }
    }

}
