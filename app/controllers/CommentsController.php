<?php
use Larabook\Statuses\LeaveCommentOnStatusCommand;
use Laracasts\Commander\CommanderTrait;

class CommentsController extends \BaseController {

    use CommanderTrait;
	/**
	 * leave a new comment
	 * POST /comments
	 *
	 * @return Response
	 */
	public function store()
	{
        //fetch the input
        $input = array_add(Input::get(), 'user_id', Auth::id());
        //execute
        $this->execute(LeaveCommentOnStatusCommand::class, $input);

        return Redirect::back();

	}


}