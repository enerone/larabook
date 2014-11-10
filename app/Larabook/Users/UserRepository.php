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

    /**
     * Find the user by their id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function follow($userIdToFollow, User $user)
    {
       return $user->follows()->attach($userIdToFollow);
    }


}