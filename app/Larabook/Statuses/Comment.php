<?php
/**
 * Created by PhpStorm.
 * User: fmesaglio
 * Date: 11/17/14
 * Time: 9:04 AM
 */

namespace Larabook\Statuses;


/**
 * Class Comment
 * @package Larabook\Statuses
 */
class Comment extends \Eloquent {

    protected $fillable = ['user_id','status_id','body'];


    public function owner()
    {
        return $this->belongsTo('Larabook\Users\User', 'user_id');
    }


    public static function leave($body, $statusId)
    {
        return new static([
            'body' => $body,
            'status_id' => $statusId
        ]);
    }

} 