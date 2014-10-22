<?php

namespace App\Models;

use DibiConnection;

/**
 * @author Danndy
 */
class UserModel extends \Nette\Object {
	
	const TABLE = 'user';
	
	/**
	 * @var \DibiConnection
	 */
	private $database;


	/**
	 * @param \DibiConnection
	 */
	public function __construct(DibiConnection $database)
	{
		$this->database = $database;
	}

	/**
	 * @param int $id
	 * @return \DibiRow|FALSE
	 */
	public function find($id)
	{
		$query = $this->database->select('*')
			->from(self::TABLE)
			->where(self::TABLE . '.id = %i', $id);

		return $query->fetch();
	}
	
	/**
	 * @param string $email
	 */
	public function findByEmail($email)
	{
		$query = $this->database->select('*')
			->from(self::TABLE)
			->where(self::TABLE . '.email = %s', $email);
		
		return $query->fetch();
	}

	/**
	 * @return array
	 */
	public function findAll()
	{
		$query = $this->database->select('*')
			->from(self::TABLE)
			->orderBy(self::TABLE . '.id ASC');
		
		return $query->fetchAll();
	}

	/**
	 * @param array|\DibiRow $user
	 * @return bool
	 */
	public function save(&$user)
	{
		if (!isset($user['id']))
		{
			//hashing password
			$user['password'] = password_hash($user['password'],PASSWORD_BCRYPT);
			$this->database->insert(self::TABLE, $user)
				->execute();
			$user['id'] = $this->database->getInsertId();
		}
		else
		{
			$this->database->update(self::TABLE, $user)
				->where(self::TABLE, '.id = %i', $user['id'])
				->execute();
		}
		return $this->database->getAffectedRows() == 1;
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function delete($id)
	{
                $this->database->delete('user_groups')->where('user_id ='.$id)->execute();
		$this->database->delete(self::TABLE)
			->where(self::TABLE . '.id = %i', $id)
			->execute();

		return $this->database->getAffectedRows() == 1;
	}
	
	/*
	 * @param string $search
	 * @return array
	 */
	public function findByString($searchString)
	{
		$query = $this->database->select("*,GROUP_CONCAT(name SEPARATOR ', ') AS groups")
			->from(self::TABLE )
			->join('user_groups')->on('('.self::TABLE.'.id = user_groups.user_id)')
			->join('group')->on('(group.id = user_groups.group_id)')
                        ->where("firstname LIKE '%$searchString' OR email LIKE '%$searchString' ")
                        ->groupBy('user.id');		
                
                return $query->fetchAll();
	}
	
}
