<?php
namespace mill\libs;

/**
 * Description of Cache
 * makes cache for data
 * @author Yaroslav Palamarchuk
 */
class Cache {

    public function __construct() {

    }

    /**
     * create new cache file
     * @param string  $key     file name for cache
     * @param string  $data    data for caching
     * @param integer $seconds time for caching
     */
    public function set($key, $data, $seconds = 3601) {
        $content['data'] = $data;
        $content['end_time'] = time() + $seconds;
        if(!is_dir(CACHE)){
            mkdir(CACHE);
        }
        if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {
            return true;
        }
        return false;
    }

    /**
     * get cached file
     * @return bool if cache exists return true
     */
    public function get($key) {
        /**
         * hashing a file
         * @var string
         */
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content['data'];
            } else {
                if (unlink($file));
            }
            return false;
        }
    }

    /**
     * delet cached file
     * @param  string $key cripted key | file name
     */
    public function delete($key) {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            unlink($file);
        }
    }

}
