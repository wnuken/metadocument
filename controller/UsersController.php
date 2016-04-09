<?php

/**
* 
*/
class Users // extends AnotherClass
{
	
	/*function __construct(argument)
	{
		# code...
	}*/

	public function Insert($params)
	{
		$Id = 0;
		$status = false;
		$salt = md5($params['pass1']);
		$passGen = hash('sha256',$salt. $params['pass1']);

		$password = $passGen . ":" . $salt;

		$AdminUser = new AdminUser();
		$AdminUser->setUser($params['user']);
		$AdminUser->setName($params['name']);
		$AdminUser->setPassword($password);
		$AdminUser->setEmail($params['email']);
		$AdminUser->setFolderRoot($params['folder_id']);
		$AdminUser->setRolId($params['rol_id']);

		$AdminUser->save();

		$Id =  $AdminUser->getId();

		if($Id != 0)
			$status = true;

		$arrayResponse = array(
			'id' => $Id,
			'status' => $status);

		$result = json_encode($arrayResponse);
		return $result;
	}

	public function Update($params)
	{	
		$Id = 0;
		$status = false;
		$AdminUser = AdminUserQuery::create()->findOneById($params['id']);

		if(!empty($AdminUser))
		{
			$AdminUser->setUser($params['user']);
			$AdminUser->setName($params['name']);
			$AdminUser->setEmail($params['email']);
			$AdminUser->setFolderRoot($params['folder_id']);
			$AdminUser->setRolId($params['rol_id']);

			if(isset($params['pass1']) && $params['pass1'] == $params['pass2'])
			{
				$salt = md5($params['pass1']);
				$passGen = hash('sha256',$salt. $params['pass1']);
				$password = $passGen . ":" . $salt;
				$AdminUser->setPassword($password);
			}

			$AdminUser->save();
			$Id =  $AdminUser->getId();
			$status = true;
		}

		$arrayResponse = array(
			'id' => $Id,
			'status' => $status);

		$result = json_encode($arrayResponse);
		return $result;
	}

	public function Delete($params)
	{
		$Id = 0;
		$status = false;
		$AdminUser = AdminUserQuery::create()->findOneById($params['id']);

		if(!empty($AdminUser))
		{
			$Id =  $AdminUser->getId();
			$AdminUser->delete();
			$status = true;
		}

		$arrayResponse = array(
			'id' => $Id,
			'status' => $status
			);

		$result = json_encode($arrayResponse);
		return $result;
	}
}