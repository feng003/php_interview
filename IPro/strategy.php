<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-24
 * Time: 下午4:11
 */

define('BASEDIR',__DIR__);
include BASEDIR . '/IPro/Loader.php';
spl_autoload_register('\\IPro\\Loader::autoload');

class Page
{
    private $strategy;

    function index()
    {
        $this->strategy->showAd();

        echo "<br/>";

        $this->strategy->showCategory();

    }

    function setStrategy(\IPro\UserStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

}

$page = new Page();
//get ?female
if(isset($_GET['female'])){
    $strategy = new IPro\FemaleStrategy();
}else{
    $strategy = new IPro\MaleStrategy();
}
$page->setStrategy($strategy);
$page->index();