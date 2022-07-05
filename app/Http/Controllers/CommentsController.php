<?php

namespace App\Http\Controllers;

use App\Models\ExperienceComment;
use App\Models\GoodsComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function experience_post(Request $request)
    {
        $uid = Auth::user()->id;
        $experience_folder_id = $request->experienceFolderId;
        $content = $request->content;
        $rate = $request->rate;

        $comment = [
            'user_id' => $uid,
            'experience_folder_id' => $experience_folder_id,
            'content' => $content,
            'rate' => $rate,
        ];

        ExperienceComment::create($comment);

        return response()->json($comment);
    }

    public function goods_post(Request $request)
    {
        $uid = Auth::user()->id;
        $goods_id = $request->goodsId;
        $content = $request->content;
        $rate = $request->rate;

        $comment = [
            'user_id' => $uid,
            'goods_id' => $goods_id,
            'content' => $content,
            'rate' => $rate,
        ];

        GoodsComment::create($comment);

        return response()->json($comment);
    }
}
