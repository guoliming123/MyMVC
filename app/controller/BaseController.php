<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2016/12/24
 * Time: 14:52
 */
namespace app\controller;
use \Pheasant;

class BaseController
{

    private $config;

    public function __construct()
    {
        $this->loadConfig();
        $this->initDb();
    }

    public function initDb()
    {
    	$pheasant = new Pheasant();
        $pheasant::setup($this->config['dsn']);
    }

    public function loadConfig()
    {
        $this->config = require APP_ROOT . '/config/base.php';
    }

}
