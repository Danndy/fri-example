<?php

namespace App\Forms;

class SignInForm  extends \Nette\Application\UI\Form {
    
	public function __construct() {
		parent::__construct();
		$this->addText('email', 'Email:')
			->setRequired('Zadaj emailovú adresu.');

		$this->addPassword('password', 'Heslo:')
			->setRequired('Zadaj heslo.');

		$this->addCheckbox('remember', 'Trvalé prihlásenie');

		$this->addSubmit('send', 'Prihlásiť');
	}

}
