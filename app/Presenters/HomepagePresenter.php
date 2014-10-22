<?php

namespace App\Presenters;

use Nette,
	Nette\Application\UI\Form;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{

	
	/**
	 * @inject
	 * @var \App\Models\UserModel
	 */
	public $userModel;
		 
	public function renderDefault($search)
	{
		$this->template->anyVariable = $search;
		$this->template->users = $this->userModel->findByString($search);
		
	}

	public function createComponentSearchForm()
	{
		$form = new Form;
		
		$form->addText('search','Vychladávaj')
			->setAttribute('placeholder','Vstup pre vyhladávanie');
		
		$form->addSubmit('send','Vyhladávať');
		
		$form->onSuccess[] = $this->seachFormSucceeded;
		return $form;
	}
	
	public function seachFormSucceeded($form)
	{
		$searchValues = $form->getValues();
		
		$this->redirect('HomePage:default', $searchValues['search']);	    
	}
}
