<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-22
 * Time: 下午11:11
 */

namespace IPro;

class Loader{

//    static function autoload($className)
//    {
//        $thisClass = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
//
//        $baseDir = __DIR__;
//
//        if (substr($baseDir, -strlen($thisClass)) === $thisClass) {
//            $baseDir = substr($baseDir, 0, -strlen($thisClass));
//        }
//
//        $className = ltrim($className, '\\');
//        $fileName  = $baseDir;
//        $namespace = '';
//        if ($lastNsPos = strripos($className, '\\')) {
//            $namespace = substr($className, 0, $lastNsPos);
//            $className = substr($className, $lastNsPos + 1);
//            $fileName  .= str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
//        }
//        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
//
//        if (file_exists($fileName)) {
//            require $fileName;
//        }
//    }

//    static function autoload($class) {
//        require BASEDIR.'/'.str_replace('\\','/',$class).'.php';
//
//    }

    static function autoload($class){
        $classpath = BASEDIR.'/'.str_replace('\\','/',$class).'.php';
        if(file_exists($classpath)){
            require $classpath;
        }
        else{
            echo 'class file '.$classpath.' not found!';
        }
    }

    public static function registerAutoloader()
    {
        spl_autoload_register(__NAMESPACE__ . "\\Loader::autoload");
    }
}