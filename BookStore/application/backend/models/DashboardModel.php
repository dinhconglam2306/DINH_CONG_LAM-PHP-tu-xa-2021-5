<?php
class DashboardModel extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->setTable(TBL_USER);
	}
	public function count($params, $option = null)
	{
		if ($option['task'] == 'count-groups') {
			$query[] = "SELECT  COUNT(*) AS `count`";
			$query[] = "FROM `group` WHERE `id` > '0'";

			$query = implode(' ', $query);
			$result = $this->fetchAll($query);
			$result = $result[0]['count'];
			return $result;
		}
		if ($option['task'] == 'count-items') {
			$query[] = "SELECT  COUNT(*) AS `count`";
			$query[] = "FROM `user`";
			$query[] =	" WHERE `id` > 0";

			$query = implode(' ', $query);
			$result = $this->fetchAll($query);
			$result = $result[0]['count'];
			return $result;
		}
	}
	public function saveItem($params, $option = null)
	{
		if ($option == null) {
			$data  = ['fullname' => $params['form']['fullname']];
			$_SESSION['user']['info']['fullname'] = $data['fullname'];
			$id   = $params['form']['id'];
			$where = [['id', $id]];
			$this->update($data, $where);
		}
	}
}
