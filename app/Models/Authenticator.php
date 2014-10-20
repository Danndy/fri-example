<?php

namespace App\Models;

use Nette\Security as NS;
use Nette\Object;
use Nette;

class Authenticator extends Object implements NS\IAuthenticator
{
	
	/**
	 * @var \App\Models\UserModel
	 */
	public $userModel;
	
	function __construct(\App\Models\UserModel $userModel)
	{
	    $this->userModel = $userModel;
	}
	
	public function authenticate(array $credentials) {
		list($email, $password) = $credentials;
		
		$user = $this->userModel->findByEmail($email);

		if (!$user) {
		    throw new NS\AuthenticationException('Pre tento email neexistuje uživateľské konto');
		}

		//verify password
		if (!password_verify($password,$user->password)) {
		    throw new NS\AuthenticationException('Heslo ktoré ste zadali nieje správne.');
		}

		$user->last_login = new \DateTime();
		$this->userModel->save($user);
		
        return new NS\Identity($user->user_id, NULL, $user);
	}
	
}
