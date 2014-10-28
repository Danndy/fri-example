<?php

namespace App\Datagrids;

use Grido\Grid;

class UserGrid extends Grid
{
	public function __construct($parent, $name,$userModel) {

		parent::__construct($parent, $name);
		
		$this->setModel($userModel->findAll());

		$this->addColumnText('firstname', 'Meno')
			->setSortable()
			->setFilterText()
			->setSuggestion();
		
		$this->addColumnText('surname', 'Priezvisko')
			->setSortable()
			->setFilterText()
			->setSuggestion();
		
		$this->addColumnText('age', 'Vek')
			->setSortable()
			->cellPrototype->class[] = 'center';
		
		$this->addColumnText('email', 'Email')
			->setSortable()
			->setFilterText()
			->setSuggestion();
		
		$this->addColumnDate('last_login', 'Posledné prihlásenie', \Grido\Components\Columns\Date::FORMAT_TEXT)
			->setSortable()
			->setFilterDate();
		
		$this->addActionHref('delete', 'Delete')
			->setConfirm(function($item) {
				return "Naozaj chcete zmazať pouzivatela: {$item->firstname} {$item->surname} ?";
			});
	}
	
}

