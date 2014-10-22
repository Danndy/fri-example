<?php

namespace App\Forms;

class SignUpForm extends \Nette\Application\UI\Form {
	public function __construct() {
		parent::__construct();
		$this->addText('firstname', 'Meno:')
			->addRule(self::MAX_LENGTH, '"%label" môže mať maximálnu dĺžku %value.', 64)
			->setRequired('Zadaj meno.');
		
		$this->addText('surname', 'Priezvisko:')
			->addRule(self::MAX_LENGTH, '"%label" môže mať maximálnu dĺžku %value.', 64)
			->setRequired('Zadaj priezvisko.');

		$this->addPassword('password', 'Heslo:')
			->setRequired('Zadaj heslo');

		$this->addPassword('password2', 'Opakovať heslo:')
			->addRule(self::EQUAL, 'Hesla se nezhodujú!', $this['password'])
			->setRequired('Opakuj heslo!');
		
		$this->addText('email', 'Email:')
			->addRule(self::MAX_LENGTH, '"%label" môže mať maximálnu dĺžku %value.', 64)
			->addRule(self::EMAIL, "Zadajte platnú emailovú adresu")
			->setRequired('Zadaj platný email!.');
		
		$this->addText('age', 'Vek:')
			->addRule(self::INTEGER, 'Vek musí byt číslo')
			->addRule(self::RANGE, 'Vek musí byť v intervale od %d do %d', array(15, 100))
			->setRequired('Zadaj vek.');

		$this->addSubmit('send', 'Registrovať');
	}

}
