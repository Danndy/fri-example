<?php

namespace App\Models;

use DibiConnection;

/**
 * @author Danndy
 */
class GroupModel extends \Nette\Object {
	
	const TABLE = 'group';
	const ASSOC_TABLE = 'user_groups';
	
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
	public function save(&$group)
	{
		if (!isset($group['id']))
		{
			$this->database->insert(self::TABLE, $group)
				->execute();
			$group['id'] = $this->database->getInsertId();
		}
		else
		{
			$this->database->update(self::TABLE, $group)
				->where(self::TABLE,'.id = %i', $group['id'])
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
                $this->database->delete('user_groups')->where('group_id ='.$id)->execute();
		$this->database->delete(self::TABLE)
			->where(self::TABLE . '.id = %i', $id)
			->execute();

		return $this->database->getAffectedRows() == 1;
	}
	
        /**
	 * @return array
	 */
	public function findAllForGrido($userId)
	{
		$query = $this->database->select('*,count(user_id) as pocet, SUM(CASE user_id WHEN '.$userId.' THEN 1 ELSE 0 END) AS ingroup')
			->from(self::TABLE)
			->leftJoin(self::ASSOC_TABLE)
				->on(self::ASSOC_TABLE . '.group_id = ' . self::TABLE . '.id')
			->groupBy(self::TABLE . '.id');

		return $query;
	}
        
        /**
	 * @param int $group_id
	 * @param int $user_id
	 * @return bool
	 */
	public function removeUser($group_id, $user_id) {
		return $this->database->delete(self::ASSOC_TABLE)
			->where('group_id = %i AND user_id = %i', $group_id, $user_id)
			->execute();
	}
        
        /**
	 * @param int $group_id
	 * @param int $user_id
	 * @return bool
	 */
	public function addUser($group_id, $user_id) {
		return $this->database->insert(self::ASSOC_TABLE, array(
			'group_id' => $group_id, 
			'user_id' => $user_id
		))->execute();
	}
        
        
  
}
