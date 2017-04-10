<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-24
 * Time: 下午4:08
 */

namespace IPro;

class MaleStrategy implements UserStrategy
{
    function showAd()
    {
        echo 'male ad';
    }

    function showCategory()
    {
        echo 'male cate';
    }
}