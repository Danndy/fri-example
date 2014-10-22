<?php

namespace App\Presenters;

use Nette,
    Grido;


/**
 * User presenters.
 */
class UserPresenter extends BasePresenter
{
    
	/**
	 * 
	 * @inject
	 * @var \App\Models\UserModel
	 */
	public $userModel;
	
	
	public function renderDefault()
	{
	    
	}

	public function createComponentUserGrid($name)
	{
                $grid = new \Grido\Grid($this, $name);
                $grid->setModel($this->userModel->findAll());

                $grid->addColumnText('firstname', 'Meno')
                        ->setSortable()
                        ->setFilterText()
                        ->setSuggestion();
                $grid->addColumnText('surname', 'Priezvisko')
                        ->setSortable()
                        ->setFilterText()
                        ->setSuggestion();
                $grid->addColumnText('age', 'Vek')
                        ->setSortable()
                        ->cellPrototype->class[] = 'center';
                $grid->addColumnText('email', 'Email')
                        ->setSortable()
                        ->setFilterText()
                        ->setSuggestion();
                $grid->addColumnDate('last_login', 'Posledné prihlásenie', \Grido\Components\Columns\Date::FORMAT_TEXT)
                        ->setSortable()
                        ->setFilterDate();
                $grid->addActionHref('delete', 'Delete')
                        ->setConfirm(function($item) {
                                        return "Naozaj chcete zmazať pouzivatela: {$item->firstname} {$item->surname} ?";
                                    });
                return $grid;
	}
        
        /**
	 * @param int $id
	 */
	public function actionDelete($id) {
		$user = $this->userModel->find($id);
		if (!$user) {
			$this->flashMessage('Uživatel neexistuje'.$id.'dsa', 'error');
		}
		$this->userModel->delete($id);
                
		$this->flashMessage('Uživatel bol zmazaný', 'success');
		if ($user['id'] == $this->getUser()->getId()) {
			$this->redirect('Sign:out');
		}
                
		$this->redirect('User:');
	}

}
