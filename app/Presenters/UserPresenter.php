<?php

namespace App\Presenters;

use Nette,
    App\Datagrids\UserGrid;


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
                return new UserGrid($this, $name, $this->userModel); 
	}
        
        /**
	 * @param int $id
	 */
	public function actionDelete($id) {
		$user = $this->userModel->find($id);
		
		if (!$user) {
			$this->flashMessage('Uživatel zo zadaným id neexistuje', 'error');
		}
		if ($user['id'] == $this->getUser()->getId()) {
			$this->flashMessage('Snažíte sa zmazať sám seba!', 'error');
			$this->redirect('User:');
		}else{
			$this->userModel->delete($id);
			$this->flashMessage('Uživateľ bol zmazany!', 'success');
			$this->redirect('User:');
		}
                
		
	}

}
