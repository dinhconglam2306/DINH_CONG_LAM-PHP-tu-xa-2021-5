<?php
class UserController extends Controller
{
	public function __construct($arrParams)
	{
		parent::__construct($arrParams);
		$this->_templateObj->setFolderTemplate('frontend/adminlte/');
		$this->_templateObj->setFileTemplate('index.php');
		$this->_templateObj->setFileConfig('template.ini');
		$this->_templateObj->load();
	}

	public function indexAction()
	{

		$this->_view->_title 				= "Thông tin tài khoản";
		$this->_view->category = $this->_model->CategoryList($this->_arrParam, ['task' => 'category-list']);
		$this->_view->render('user/index');
	}
}
