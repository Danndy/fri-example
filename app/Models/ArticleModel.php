<?php

namespace App\Models;

use DibiConnection;

class ArticleModel extends \Nette\Object
{
	const TABLE = 'article';


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
			->orderBy(self::TABLE . '.published DESC');

		return $query->fetchAll();
	}

	/**
	 * @param array|\DibiRow $article
	 * @return bool
	 */
	public function save(&$article)
	{
		if (!isset($article['id']))
		{
			$this->database->insert(self::TABLE, $article)
				->execute();

			$article['id'] = $this->database->getInsertId();
		}
		else
		{
			$this->database->update(self::TABLE, $article)
				->where(self::TABLE, '.id = %i', $article['id'])
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
		$this->database->delete(self::TABLE)
			->where(self::TABLE . '.id = %i', $id)
			->execute();

		return $this->database->getAffectedRows() == 1;
	}
}