<?php

namespace App\Presenters;

use App\Datagrids\UserGroupGrid;


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
		 
	public function createComponentUserGroupGrid($name)
	{
		return new UserGroupGrid($this, $name, $this->userModel);
	}
	
}
