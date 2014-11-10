<?php namespace Larabook\Statuses;


use Larabook\Users\User;
class StatusRepository {



    public function getAllForUser(User $user)
    {
      //  return $user->statuses()->with('user')->latest()->get();
        return $user->statuses()->with('user')->latest()->get();
    }

    public function getFeedForUser(User $user)
    {
        $userIds = $user->follows()->lists('followed_id');

        $userIds[] = $user->id;

        $result = Status::whereIn('user_id', $userIds)->latest()->get();

        return $result;
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