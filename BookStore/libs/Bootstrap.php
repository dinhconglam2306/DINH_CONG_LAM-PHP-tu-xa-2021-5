<?php
class Bootstrap
{

	private $_params;
	private $_controllerObject;

	public function init()
	{
		$this->setParam();
		
		$controllerName = $this->convertNameURLToClassName($this->_params['controller']) .  'Controller';
		$filePath	= PATH_APPLICATION . $this->_params['module'] . DS . 'controllers' . DS . $controllerName . '.php';

		if (file_exists($filePath)) {
			$this->loadExistingController($filePath, $controllerName);
			$this->callMethod();
		} else {
			URL::redirect('frontend', 'index', 'notice', ['type' => 'not-url']);
		}
	}

	// CALL METHODE
	private function callMethod()
	{
		$actionName = $this->_params['action'] . 'Action';
		if (method_exists($this->_controllerObject, $actionName) == true) {
			$module = $this->_params['module'];
			$controller = $this->_params['controller'];
			$action = $this->_params['action'];
			$requestUrl = "$module-$controller-$action";
			$userInfo = Session::get('user');

			$login = (@$userInfo['login'] == true && @$userInfo['time'] + TIME_LOGIN >= time());
			//MODULE BACKEND
			if ($module == 'backend') {
				if ($login == true) {
					if ($userInfo['group_acp'] == 1) {
						// if (in_array($requestUrl, $userInfo['info']['privilege']) == true) {
						$this->_controllerObject->$actionName();
						// } else {
						// 	URL::redirect('frontend', 'index', 'notice', ['type' => 'not-permission-group']);
						// }
					} else {
						URL::redirect('frontend', 'index', 'notice', ['type' => 'not-permission']);
					}
				} else {
					$this->callLoginAction($module);
				}

				//MODULE FRONTEND
			} else if ($module == 'frontend') {
				if ($controller == 'user') {
					if ($login == true) {
						if ($userInfo['status'] != 'inactive') {
							$this->_controllerObject->$actionName();
						} else {
							Session::delete('user');
							URL::redirect('frontend', 'index', 'notice', ['type' => 'not-login']);
						}
					} else {
						$this->callLoginAction($module);
					}
				} else {
					$this->_controllerObject->$actionName();
				}
			}
		} else {
			URL::redirect('frontend', 'index', 'notice', ['type' => 'not-url']);
		}
	}

	// SET PARAMS
	public function setParam()
	{
		$this->_params 	= array_merge($_GET, $_POST);
		$this->_params['module'] 		= isset($this->_params['module']) ? $this->_params['module'] : DEFAULT_MODULE;
		$this->_params['controller'] 	= isset($this->_params['controller']) ? $this->_params['controller'] : DEFAULT_CONTROLLER;
		$this->_params['action'] 		= isset($this->_params['action']) ? $this->_params['action'] : DEFAULT_ACTION;
	}

	// LOAD EXISTING CONTROLLER
	private function loadExistingController($filePath, $controllerName)
	{
		require_once $filePath;
		$this->_controllerObject = new $controllerName($this->_params);
	}

	private function callLoginAction($module = 'fontend')
	{
		Session::delete('user');
		require_once(PATH_APPLICATION . $module . DS . 'controllers' . DS . 'IndexController.php');
		$indexController = new IndexController($this->_params);
		$indexController->loginAction();
	}

	// ERROR CONTROLLER
	public function _error()
	{
		require_once PATH_APPLICATION . 'default' . DS . 'controllers' . DS . 'ErrorController.php';
		$this->_controllerObject = new ErrorController();
		$this->_controllerObject->setView('default');
		$this->_controllerObject->indexAction();
	}

	private function convertNameURLToClassName($nameURL)
	{
		$nameURL = ucwords(strtolower($nameURL),'-');
		$className = str_replace('-',"",$nameURL);
		return $className;
	}
}
