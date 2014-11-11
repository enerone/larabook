<?php namespace Larabook\Users;

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Eloquent,Hash;
use Larabook\Registration\Events\UserRegistered;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator, PresentableTrait;
	//use EventGenerator;

	protected $fillable = ['username', 'email', 'password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * Path to presenter for a user
     * @var string
     */
    protected $presenter = 'Larabook\Users\UserPresenter';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function setPasswordAttribute($password) {
		$this->attributes['password'] = Hash::make($password);
	}

	public function statuses(){
		return $this->hasMany('Larabook\Statuses\Status');
	}

	/**
	 * Register a new user
	 * @param  $username
	 * @param  $email
	 * @param  $password
	 * @return static
	 */
	public static function register($username, $email, $password)
    {
		$user = new static (compact('username', 'email', 'password'));

		$user->raise(new UserRegistered($user));
		return $user;
	}

    /**
     * Verifies current user
     * @param $user
     */
    public function is($user)
    {
        if(is_null($user)) return false;
        return $this->username == $user->username;
    }

    /**
     * Get the list of users that the current user follows
     * @return mixed
     */
    public function followedUsers()
    {
        return $this->belongsToMany(self::class, 'follows', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * Get the list of users who follow the current user
     * @return mixed
     */
    public function followers(){
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'follower_id')->withTimestamps();
    }


    public function isFollowedBy(User $otherUser)
    {
        $idWhoOtherUserFollows = $otherUser->followedUsers()->lists('followed_id');
        return in_array($this->id, $idWhoOtherUserFollows);
    }

}
