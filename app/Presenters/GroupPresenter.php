<?php

namespace App\Presenters;

use Nette,
    App\Datagrids\GroupGrid;


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
		return new GroupGrid($this, $name, $this->groupModel, $this->getUser()->getId());                
	}
        
        /**
	 * @param int $id
	 */
	public function actionAddToGroup($id) {
		$group = $this->groupModel->find($id);
		
		if(!$this->getUser()->isLoggedIn()){
			$this->redirect('Sign:in');
		}
		
		if (!$group) {
			$this->flashMessage('Skupina neexistuje!', 'error');
		}
		else {
			$this->groupModel->addUser($id, $this->getUser()->getId());
			$this->flashMessage('Užívatel bol pridaný do skupiny' . $group['name'], 'success');
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
			$this->flashMessage('Užívatel bol pridanýdo skupiny'  . $group['name'], 'success');
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

		if (!$group) {
			$this->flashMessage('Skupina neexistuje!.', 'error');
		}

		$this['groupForm']->setDefaults($group);

		$this->setView('add');
	}
	
	/**
	 * @param \App\Forms\GroupForm $form
	 */
	public function groupFormSubmitted(\App\Forms\GroupForm $form)
	{
		$group = $form->getValues(true);
		
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
