<?php
/**
 * Created by PhpStorm.
 * User: zhang
 * Date: 15-5-24
 * Time: 下午4:07
 */

namespace IPro;

class FemaleStrategy implements UserStrategy
{
    function showAd()
    {
        echo 'female ad';

    }

    function showCategory()
    {
        echo 'female cate';

    }

}