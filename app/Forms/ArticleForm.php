<?php

namespace App\Forms;

class ArticleForm extends \Nette\Application\UI\Form
{

	public function __construct()
	{
		parent::__construct();

		$this->addText('title', 'Názov')
			->addRule(self::MAX_LENGTH, '"%label" môže mať maximálnu dĺžku %value.', 255)
			->setRequired('Prosím, vyplňte povinné pole %label.');

		$this->addTextArea('content', 'Obsah');

		$this->addSubmit('save', 'Uložiť');
	}
}