<?php

use Larabook\Forms\SignInForm;
use Laracasts\Flash\Flash;

class SessionsController extends \BaseController {

	private $signInForm;

	function __construct(SignInForm $signInForm) {
		$this->signInForm = $signInForm;
		$this->beforeFilter('guest', ['except'=>'destroy']);
		
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
		
		$formData = Input::only('email', 'password');
		$this->signInForm->validate($formData);

		if(!Auth::attempt($formData)){

            Flash::message('We were unable to sign you in. Please check your credentials and try again!');

            return Redirect::back();
        }
		Flash::message('Welcome back!');

		return Redirect::intended('/statuses');



	}
/**
 * Log user out of larabook
 */
	public function destroy(){
		Auth::logout();

		Flash::message('You have now been logged out.');
		return Redirect::home();
	}

}
