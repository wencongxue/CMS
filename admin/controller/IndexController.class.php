<?php
namespace admin\controller;
use core\lib\Controller;
use admin\model\PublicModel;
use admin\model\AdminModel;
use admin\model\BasicModel;

class IndexController extends Controller
{
    private $pmodel = null;
    private $amodel = null;
    private $bmodel = null;

    /**
     * 架构方法
     */
    public function __construct()
    {
        parent::__construct();
        $this->pmodel = new PublicModel();
        $this->amodel = new AdminModel();
        $this->bmodel = new BasicModel();
    }

    /**
     * 主方法
     */
	public function index()
	{
        if (!isLogin()) {
            $this->login();  
        } else {
          $this->smarty->display('index.tpl');
        }
	}

    /**
     * 用于加载登录页面
     */
    public function login()
    {
        if (isLogin()) {
            $this->index();
        }
        $this->smarty->display('login.tpl');
    }
    /**
     * 登录验证
     * @return string json字符串
     */
    public function loginCheck()
    {
        $username = trim($_POST['username']);
        $password = sha1(trim($_POST['password']));

        if (!$username) {
            return show(0, '用户名不得为空');
        }

        if (!$password) {
            return show(0, '密码不得为空');
        }

        if (!$this->amodel->getAdminByUsername($username)) {
            return show(0, '该用户名不存在');
        }

        if (!$this->amodel->checkLoginPassword($username, $password)) {
            return show(0, '密码错误');
        }

        //写入到cookie时注意它的作用域
        //让它对整个根域都有效
        setcookie('username', $username, time()+3600, '/');

        $this->amodel->updateLoginTime($username);
        return show(1, '登录成功');
    }
    
    /**
     * 退出登录
     */
    public function logout()
    {
        setcookie('username', '', time()-3600, '/');
        header('location:'.makeUrl());
    }

    /**
     * 网站基本信息显示
     */
    public function info()
    {
        $web_title = $this->bmodel->getInfo()[0]['web_title'];
        
        $this->smarty->assign('web_title', $web_title);
        $this->smarty->display('index_info.tpl');
    }
}
