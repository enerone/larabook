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


    public function getPaginated($howMany=25){

        return User::orderBy('username','asc')->paginate($howMany);

    }

    /**
     * Fetch a user by username
     * @param $username
     * @return mixed
     */
    public function findByUsername($username){
        return User::with(['statuses' => function($query)
            {
            $query->latest();
        }])->whereUsername($username)->first();
    }
}