<?php
use Xmf\Request;
use XoopsModules\Tadtools\Utility;
use XoopsModules\Ugm_signup\Ugm_signup_actions;

/*-----------引入檔案區--------------*/
require_once __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'ugm_signup_index.tpl';
require_once XOOPS_ROOT_PATH . '/header.php';

/*-----------變數過濾----------*/
$op = Request::getString('op');
$id = Request::getInt('id');

/*-----------執行動作判斷區----------*/
switch ($op) {

    // 1.新增表單
    case 'ugm_signup_actions_create':
        Ugm_signup_actions::create();
        break;

    // 2.修改用表單
    case 'ugm_signup_actions_edit':
        Ugm_signup_actions::create($id);
        $op = 'ugm_signup_actions_create';
        break;

    // 3.新增資料
    case 'ugm_signup_actions_store':
        $id = Ugm_signup_actions::store();
        header("location: {$_SERVER['PHP_SELF']}?id=$id");
        exit;

    // 4.更新資料
    case 'ugm_signup_actions_update':
        Ugm_signup_actions::update($id);
        header("location: {$_SERVER['PHP_SELF']}?id=$id");
        exit;

    // 5.刪除資料
    case 'ugm_signup_actions_destroy':
        Ugm_signup_actions::destroy($id);
        header("location: {$_SERVER['PHP_SELF']}");
        exit;

    default:
        if (empty($id)) {// 6.列表
            Ugm_signup_actions::index();
            $op = 'ugm_signup_actions_index';
        } else {//顯示某筆記錄
            Ugm_signup_actions::show($id);
            $op = 'ugm_signup_actions_show';
        }
        break;
}

/*-----------function區--------------*/

/*-----------秀出結果區--------------*/
unset($_SESSION['api_mode']);
$xoopsTpl->assign('toolbar', Utility::toolbar_bootstrap($interface_menu));
$xoopsTpl->assign('now_op', $op);
$xoTheme->addStylesheet(XOOPS_URL . '/modules/ugm_signup/css/module.css');
require_once XOOPS_ROOT_PATH . '/footer.php';
