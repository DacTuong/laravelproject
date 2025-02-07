<?php

namespace App\Http\Controllers;

use App\Models\CommentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function send_comment(Request $request)
    {

        $data = $request->all();
        $id_product = $data['id_product'];
        $id_user = Session::get('id_customer');
        $comment = $data['comment'];
        if (!$id_user) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng đăng nhập hoặc đăng ký để thêm vào yêu thích']);
        }
        $add_comment = new CommentModel();
        $add_comment->id_phone_comment = $id_product;
        $add_comment->id_user_comment = $id_user;
        $add_comment->comment_text = $comment;
        $add_comment->repped = 1;
        $add_comment->save();
        return response()->json(['status' => 'success', 'message' => 'Đánh giá của bạn đã được gửi!']);
    }

    public function get_comment(Request $request)
    {
        $id_product = $request->input('idProduct'); // Use the input() method to retrieve data
        $comments = CommentModel::where('id_phone_comment', $id_product)
            ->orderBy('id_comment', 'desc')
            ->get();
        $outputComment = "";
        foreach ($comments as $comment) {
            $commentFind = $comment->cmt_name;
           

            $comment_rep = "";
            if ($comment->rep_comment != "") {

                $comment_rep .= '
                <div class="item-comment__box-rep-comment">
                            <div class="item-rep-comment">
                                <div class="box-info">
                                    <img class="avt-cmt-info" src="" alt="">
                                    <strong>QTV</strong>
                                </div>
                                <div class="box-time-cmt">
                                    <span class="time">' . $comment->updated_at . '</span>
                                </div>
                            </div>

                            <div class="box-cmt__box-question">
                                <p>' . $comment->rep_comment . '
                                </p>
                            </div>
                        </div>
                ';
            }
            $outputComment .= '<div class="item-comment__box-cmt">
                        <div class="box-cmt__box-info">
                            <div class="box-info">
                                <strong>' . $commentFind->name_user . '</strong>
                            </div>
                            <div class="box-time-cmt">
                                <span class="time">' . $comment->created_ad . '</span>
                            </div>
                        </div>
                        <div class="box-cmt__box-question">
                            <div class="content">
                                <span class="content-question">' . $comment->comment_text . '</span>
                            </div>
                        </div>

                        ' . $comment_rep . '
                    </div>';
        }

        echo  $outputComment;
    }

    public function comments_index()
    {
        $comments = CommentModel::get();
        return view('admin.comments.comments_list')->with('comments', $comments);
    }

    public function rep_comment(Request $request, $id_comment)
    {
        $comment = CommentModel::find($id_comment);
        $comment->rep_comment = $request->rep_comment;
        $comment->repped = 2;
        $comment->save();
        return Redirect::to('comments-index');
    }
}