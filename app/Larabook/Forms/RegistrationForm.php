<?php namespace Larabook\Forms;

use Laracasts\Validation\FormValidator;

class RegistrationForm extends FormValidator{
	/**
	 * validation rules for registration form
	 * @var arr
	 */
	protected $rules = [
		'username' => 'required|unique:users',
		'email'    => 'required|unique:users',
		'password'    => 'required|confirmed'

	];
}