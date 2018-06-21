<?php
namespace mill\html\files;

/**
 * base class for actions on files
 * @author Yaroslav Palamarchuk
 */
class File {
    public $files = [];
    /**
     * @param array $files array files from $_FILES array
     */
    public function __construct($files = []) {
        foreach ($files as $n => $v){
            $this->files[$n] = $v;
        }
    }
    /**
     * function for one-file uploading
     * @param string $path path of the image in the /public folder will look like /assets/files/
     * @param array $d data if isset
     */ 
    public function uploadFile($path, $name = '', $d = []){
        /**
         * if isset needed other data uplaod it
         */
        $data = $d ?: $this->files;
        $i = 0;
        foreach ($data as $k =>$v){
            $n = $name ?: $data[$k]['name'];
            
            $uploadfile = WWW . $path . basename($n);

            if (move_uploaded_file($data[$k]['tmp_name'], $uploadfile)) {
                continue;
            }
            $i++;
        }
        
    }
    
    /**
     * function for multiple files uploading
     * @param string $path path of the files in the /public folder will look like /assets/files/
     */
    public function uploadFiles($path){
        foreach($this->files as $n => $v){
            /**
             * if multiple files
             */
            if(is_array($v['name'])){
                /* 
                 * @var $val array 
                */
                foreach($v as $val){
                    foreach($val as $key => $value){
                        /**
                         * path of file
                         * base to public folder
                         */
                        $uploadfile = WWW . $path . basename($v['name'][$key]);
                        if (move_uploaded_file($v['tmp_name'][$key], $uploadfile)) {
                            continue;
                        }
                    }
                }
            }else{
                /**
                 * if one file upload
                 */
                $this->uploadFile($path, null, $v);
            }
        }
    }
    
}
