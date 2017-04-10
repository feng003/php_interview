<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 11:17
 */

namespace IPro;

interface IDatabase
{
    function connect($host,$user,$passwd,$dbname);
    function query($sql);
    function find();
    function select();
    function add();
    function save();
    function close();
}