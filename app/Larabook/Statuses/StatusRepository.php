<?php namespace Larabook\Statuses;


use Larabook\Users\User;
class StatusRepository {



    public function getAllForUser(User $user){
        dd($user);
        return $user->statuses;
    }
    /**
     * Save a new status for user
     *
     * @param  Status $status
     * @param  $userId
     * @return mixed
     *
     */
    public function save(Status $status, $userId){

        return User::findOrFail($userId)
            ->statuses()
            ->save($status);



    }

}