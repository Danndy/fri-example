<?php

namespace App\Presenters;

use Nette;


/**
 * Signin/Signup presenters.
 */
class SignPresenter extends BasePresenter
{
    
	/**
	 * 
	 * @inject
	 * @var \App\Models\UserModel
	 */
	public $userModel;


	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		if ($this->getUser()->isLoggedIn())
		{
			$this->error('Access denied.', 403);
		}
		
		$form = new \App\Forms\SignInForm;
		$form->onSuccess[] = $this->signInFormSucceeded;
		return $form;
	}
	
	/**
	 * Sign-in form factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignUpForm()
	{
		if ($this->getUser()->isLoggedIn())
		{
			$this->error('Access denied.', 403);
		}
		
		$form = new \App\Forms\SignUpForm;
		$form->onSuccess[] = $this->signUpFormSucceeded;
		return $form;
	}
	
	/**
	 * 
	 * @param Nette\Application\UI\Form $form
	 */
	public function signUpFormSucceeded($form)
	{
		$user = $form->getValues(true);
		unset($user['password2']);
		
		if (($this->userModel->findByEmail($user['email'])) != false) {
			$form['email']->addError("Účet pod týmto emailom uz je v databáze!");
		}
		elseif ($this->userModel->save($user)) {
			$this->flashMessage('Účet bol vytvorený');
			$this->redirect('Sign:in');
		}else {
			$form->addError("Účet sa nepodarilo vytvoriť.");			
		}
	}


	public function signInFormSucceeded($form)
	{
		$values = $form->getValues();

		if ($values->remember) {
			$this->getUser()->setExpiration('14 days', FALSE);
		} else {
			$this->getUser()->setExpiration('20 minutes', TRUE);
		}

		try {
			$this->getUser()->login($values->email, $values->password);
			$this->redirect('Homepage:');

		} catch (Nette\Security\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}


	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}

}
