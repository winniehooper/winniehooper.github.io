<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class CommentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store() {
        $data = request()->only(['comment_text', 'project_id']);
        $comment = Comment::create([
          'project_id' => $data['project_id'],
            'user_id' => Auth::id(),
            'comment' => $data['comment_text']
        ]);
        $comment->save();
        $ret = [
          'status' => 'success',
          'comment' => $comment->comment,
          'commentId' => $comment->id,
        ];
        return $ret;
    }

    public function destroy() {
        $comment = Comment::findOrFail(request('commentId'));
        if ($comment->user_id != Auth::id()) {
            new AccessDeniedException();
        }

        $comment->delete();

        return [
          'status' => 'ok'
        ];
    }
}
