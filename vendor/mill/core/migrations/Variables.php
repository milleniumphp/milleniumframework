<?php
namespace mill\core\migrations;

/**
 * class which will return var objects for migration with string type
 * @author Yaroslav Palamarchuk
 */
class Variables {
    
    public $type;
    
    public $dbtype;
    
    /**
     *
     * @var array simple names for column types
     */
    public $types = [
        'mysql'=>[
            'integer'=>'int',
            'string'=>'varchar',
            'enum'=>'ENUM'
        ],
        'sqlite'=>[
            'integer'=>'INTEGER',
            'string'=>'TEXT',
            'enum'=>'CHAR'
        ]
        
    ];
    
    /**
     *
     * @var array options for column with default values
     */
    public $options = [
        'length'=>9,
        'notNull'=>false,
        'primary'=>false,
        'unique'=>false,
        'increment'=>false,
        'default'=>false
    ];
    
    /**
     *
     * @var array options names converted to SQL type
     */
    public $optionNames = [
        'mysql' => ['notNull' => 'NOT NULL',
            'unique' => 'UNIQUE',
            'primary' => 'PRIMARY KEY',
            'increment' => 'AUTO_INCREMENT',
            'default' => 'DEFAULT '
        ],
        'sqlite' => [
            'unique' => 'UNIQUE',
            'primary' => 'PRIMARY KEY',
            'increment' => 'AUTOINCREMENT',
            'default' => 'DEFAULT '
        ]
    ];
    
    public function __construct() {
        $this->dbtype = \mill\core\Db::$dbtype;
    }

    /**
     * makes new variable string with options and returnes it
     * @param string $type
     * @param array $options
     * @return string query
     */
    public function make($type, $options = []){
        foreach ($this->types[$this->dbtype] as $k => $n){
            if($k == $type){
                $this->type = $n;
                if($k == 'enum' && $this->dbtype == 'sqlite'){
                    $this->type .= '(1)';
                }
            }
        }
        foreach ($options as $k => $v){
            $this->options[$k] = $v;
        }
        
        $this->optionNames[$this->dbtype]['default'] .= $this->options['default'];
        
        $res = $this->dbtype=='sqlite' ? $this->type : "$this->type($this->options['length'])";
        
        return $this->createQuery($res);
        
    }
    
    /**
     * makes query string
     * @param string $res
     * @return string
     */
    public function createQuery($res){
        foreach ($this->options as $k =>$n){
            if($n){
                $res .= ' ' . $this->optionNames[$this->dbtype][$k];
            }
            
        }
        return $res;
    }
    
}
