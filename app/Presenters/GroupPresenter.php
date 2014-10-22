<?php

namespace App\Presenters;

use Nette,
    Grido;


/**
 * User presenters.
 */
class GroupPresenter extends BasePresenter
{
    
	/**
	 * 
	 * @inject
	 * @var \App\Models\GroupModel
	 */
	public $groupModel;
	
	
	public function renderDefault()
	{
	    
	}

	public function createComponentGroupGrid($name)
	{
		$grid = new \Grido\Grid($this, $name);
                $grid->setModel($this->groupModel->findAllForGrido($this->getUser()->getId()));

                $grid->addColumnText('name', 'Názov skupiny')
                        ->setSortable()
                        ->setFilterText()
                        ->setSuggestion();
                $grid->addColumnText('description', 'Popis skupiny');
                $grid->addColumnText('pocet', 'Počet členov')->setSortable();
                $grid->addActionHref('addToGroup', 'Pridaj sa do skupiny')
                        ->setDisable(function($row) {
                                    return $row['ingroup'] > 0;
                            });
                $grid->addActionHref('removeFromGroup', 'Odober sa zo skupiny')
                        ->setDisable(function($row) {
                                    return $row['ingroup'] == 0;
                            });
                $grid->addActionHref('edit', 'Uprav skupinu');
                $grid->addActionHref('delete', 'Zmaž skupinu')
                            ->setConfirm(function($item) {
                                    return "Určite chcete zmazať skupinu {$item->name}?";
                            });
                return $grid;
	}
        
        /**
	 * @param int $id
	 */
	public function actionAddToGroup($id) {
		$group = $this->groupModel->find($id);
		if (!$group) {
			$this->flashMessage('Skupina neexistuje!', 'error');
		}
		else {
			$this->groupModel->addUser($id, $this->getUser()->getId());
			$this->flashMessage('Uzivatel bol pridanýdo skupiny' . $group['name'], 'success');
		}
		$this->redirect('Group:');
	}
        
        /**
	 * @param int $id
	 */
	public function actionRemoveFromGroup($id) {
		$group = $this->groupModel->find($id);
		if (!$group) {
			$this->flashMessage('Skupina neexistuje!', 'error');
		}
		else {
			$this->groupModel->removeUser($id, $this->getUser()->getId());
			$this->flashMessage('Uzivatel bol pridanýdo skupiny'  . $group['name'], 'success');
		}
		$this->redirect('Group:');
	}
        
        /**
	 * @param int $id
	 */
	public function actionDelete($id) {
		$group = $this->groupModel->find($id);
		if (!$group) {
			$this->flashMessage('Skupina neexistuje!.', 'error');
		}
		$this->groupModel->delete($id);
		$this->flashMessage('Skupina odstránená', 'success');
		$this->redirect('Group:');
	}
        
        /**
	 * @param int $id
	 */
	public function actionEdit($id)
	{
		$group = $this->groupModel->find($id);

		if (!$group)
		{
			$this->error('Skupina neexistuje.', 404);
		}

		$this['groupForm']->setDefaults($group);

		$this->setView('add');
	}
	
	/**
	 * @param \App\Forms\GroupForm $form
	 */
	public function groupFormSubmitted(\App\Forms\GroupForm $form)
	{
		$group = $form->getValues(TRUE);
		$this->groupModel->save($group);

		$this->flashMessage('Skupina upravena!.', 'success');
		$this->redirect('default');
	}
	
	/**
	 * @return \App\Forms\GroupForm
	 */
	protected function createComponentGroupForm()
	{
		$form = new \App\Forms\GroupForm();
		$form->onSuccess[] = callback($this, 'groupFormSubmitted');

		return $form;
	}
        
}
