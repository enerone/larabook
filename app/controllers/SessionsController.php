<?php

use Larabook\Forms\SignInForm;

class SessionsController extends \BaseController {

	private $signInForm;

	function __construct(SignInForm $signInForm) {
		$this->beforeFilter('guest');
		$this->signInForm = $signInForm;
	}
	/**
	 * Show the form for sign in
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('sessions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//fetch the form input
		$input = Input::only('email', 'password');
		//validate the form
		////if invalid then go back
		$this->signInForm->validate(Input::only('email', 'password'));

		//if is valid the try to sign in
		//redirect to statuses
	}

}
