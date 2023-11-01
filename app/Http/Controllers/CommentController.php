<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('cus');
    }

    public function create(Request $req)
    {
        Comment::create($req->all());

        $listComment = Comment::where('product_id', $req->product_id)->whereNull('reply_id')->orderBy('created_at', 'desc')->get();
        $userID = $req->user_id;

        return view('component.comment', compact('listComment', 'userID'));
    }

    public function createReply(Request $req)
    {
        Comment::create($req->all());

        $listComment = Comment::where('product_id', $req->product_id)->whereNull('reply_id')->orderBy('created_at', 'desc')->get();
        $userID = $req->user_id;

        return view('component.comment', compact('listComment', 'userID'));
    }

    public function delete(Request $req)
    {
        $comment = Comment::find($req->id);

        if ($comment) {
            $delete = $comment->delete();

            if ($delete) {
                $listComment = Comment::where('product_id', $req->product_id)->whereNull('reply_id')->orderBy('created_at', 'desc')->get();
                $userID = $req->user_id;

                return view('component.comment', compact('listComment', 'userID'));
            } else {
                return 'error';
            }
        } else {
            return 'error';
        }
    }
}
