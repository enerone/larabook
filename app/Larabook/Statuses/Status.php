<?php namespace Larabook\Statuses;



use Larabook\Statuses\Events\StatusWasPublished;
use Laracasts\Commander\Events\EventGenerator;
class Status extends \Eloquent {

    use EventGenerator;

    protected $fillable=['body'];

    public function user(){
        return $this->belongsTo('Larabook\Users\User');
    }
    
    /**
     * publish a new status
     * 
     * @param  $body 
     * @return static
     */
    public static function publish($body)
    {
            $status = new static(compact('body'));
            $status->raise(new StatusWasPublished($body));

            return $status;
    }
}