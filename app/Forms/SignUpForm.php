<?php

namespace App\Forms;

class SignUpForm extends \Nette\Application\UI\Form {
	public function __construct() {
		parent::__construct();
		$this->addText('name', 'Meno:')
			->addRule(self::MAX_LENGTH, '"%label" môže mať maximálnu dĺžku %value.', 64)
			->setRequired('Vlož svoje meno.');
		
		$this->addText('surname', 'Priezvisko:')
			->addRule(self::MAX_LENGTH, '"%label" môže mať maximálnu dĺžku %value.', 64)
			->setRequired('Vlož svoje priezvisko.');

		$this->addPassword('password', 'Heslo:')
			->setRequired('Zadaj heslo');

		$this->addPassword('password2', 'Potvrď heslo:')
			->addRule(self::EQUAL, 'Hesla se nezhoduju', $this['password'])
			->setRequired('Potvrď heslo');
		
		$this->addText('email', 'Email:')
			->addRule(self::MAX_LENGTH, '"%label" môže mať maximálnu dĺžku %value.', 64)
			->addRule(self::EMAIL, "Zadajte platnú emailovú adresu")
			->setRequired('Zadaj platný email.');
		
		$this->addText('age', 'Vek:')
			->addRule(self::INTEGER, 'Vek musí byt číslo')
			->addRule(self::RANGE, 'Vek musí byt od %d do %d', array(15, 100))
			->setRequired('Zadaj vek.');

		$this->addSubmit('send', 'Registruj sa');
	}

}
