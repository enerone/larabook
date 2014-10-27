<?php namespace Larabook\Users;

class UserRepository {

	/**
	 * Persist a user
	 * @param  User   $user [description]
	 * @return mixed
	 */
	public function save(User $user) {
		return $user->save();
	}
}