<?php

namespace App\Components;

use DibiRow;

class ArticleControl extends \Nette\Application\UI\Control
{
	/**
	 * @var \DibiRow
	 */
	private $article;


	/**
	 * @param DibiRow $article
	 */
	public function __construct(DibiRow $article)
	{
		parent::__construct();

		$this->article = $article;
	}

	public function render()
	{
		$this->template->setFile(__DIR__ . '/../templates/components/Article/default.latte');
		$this->template->article = $this->article;
		$this->template->render();
	}
}