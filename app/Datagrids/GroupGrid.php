<?php

namespace App\Datagrids;

use Grido\Grid;

class GroupGrid extends Grid
{
	public function __construct($parent, $name,$usersModel,$userId) {

		parent::__construct($parent, $name);
		
		$this->setModel($usersModel->findAllForGrido($userId));

                $this->addColumnText('name', 'Názov skupiny')
			->setSortable()
			->setFilterText()
			->setSuggestion();
		
		$this->addColumnText('description', 'Popis skupiny');
		$this->addColumnText('pocet', 'Počet členov')
			->setSortable();
                
	
		$this->addActionHref('addToGroup', 'Pridaj sa do skupiny')
			->setDisable(function($row) {
				return $row['ingroup'] > 0;
			});
			
		$this->addActionHref('removeFromGroup', 'Odober sa zo skupiny')
			->setDisable(function($row) {
				return $row['ingroup'] == 0;
			});
	
		$this->addActionHref('edit', 'Uprav skupinu');
		$this->addActionHref('delete', 'Zmaž skupinu')
			->setConfirm(function($item) {
				return "Určite chcete zmazať skupinu {$item->name}?";
			});
	}
	
}

