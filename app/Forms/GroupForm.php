<?php
namespace App\Forms;

class GroupForm extends \Nette\Application\UI\Form {
    
	public function __construct() {
		parent::__construct();
		
		$this->addHidden('id', '-1');
		
		$this->addText('name', 'Názov:')
			->setRequired('Musíte zadať názov skupiny.');

		$this->addTextArea('description', 'Popis:');

		$this->addSubmit('send', 'Odošli');
	}

}

