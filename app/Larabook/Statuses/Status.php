<?php namespace Larabook\Statuses;



use Larabook\Statuses\Events\StatusWasPublished;
use Laracasts\Commander\Events\EventGenerator;
use Laracasts\Presenter\PresentableTrait;

class Status extends \Eloquent {

    use EventGenerator, PresentableTrait;

    protected $fillable=['body'];
    protected $presenter = 'Larabook\Statuses\StatusPresenter';

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