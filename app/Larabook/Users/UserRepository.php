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
        return User::with('statuses' )->whereUsername($username)->first();
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

    /**
     * follow a larabook user
     *
     * @param $userIdToFollow
     * @param User $user
     * @return mixed
     */
    public function follow($userIdToFollow, User $user)
    {
       return $user->followedUsers()->attach($userIdToFollow);
    }

    /**
     * Unfollow a laravel user
     *
     * @param $userIdToUnfollow
     * @param User $user
     * @return mixed
     */
    public function unfollow($userIdToUnfollow, User $user)
    {
        return $user->followedUsers()->detach($userIdToUnfollow);
    }

}