<?php

namespace App\Datagrids;

use Grido\Grid;

class UserGroupGrid extends Grid
{
	public function __construct($parent, $name,$userModel) {

		parent::__construct($parent, $name);
		
		$this->setModel($userModel->findForGrido());

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
                        ->setSortable();
		
		$this->addColumnText('groups', 'Skupiny')
			->setSortable()
			->setFilterText()
			->setSuggestion();
	}
	
}

