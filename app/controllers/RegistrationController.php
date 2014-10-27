<?php

use Larabook\Core\CommandBus;
use Larabook\Forms\RegistrationForm;
use Larabook\Registration\RegisterUserCommand;

class RegistrationController extends BaseController {

	use Larabook\Core\CommandBus;

	private $registrationForm;

	/**
	 * Constructor
	 * @param CommandBus       $commandBus
	 * @param RegistrationForm $registrationForm
	 */
	function __construct(RegistrationForm $registrationForm) {

		$this->registrationForm = $registrationForm;

		$this->beforeFilter('guest');
	}

	/**
	 * Show the form to registrate the user
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('registration.create');
	}

	public function store() {

		$this->registrationForm->validate(Input::all());

		extract(Input::only('username', 'email', 'password'));
		$user = $this->execute(
			new RegisterUserCommand($username, $email, $password)
		);

		Auth::login($user);

		Flash::message('Glad to have you as a larabook member');

		return Redirect::home();
	}

}
