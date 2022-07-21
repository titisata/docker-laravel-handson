<?php

namespace App\Http\Controllers;

use App\Models\ExperienceComment;
use App\Models\ExperienceFolder;
use App\Models\GoodsComment;
use App\Models\GoodsFolder;
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
        $average_rate = ExperienceComment::where('experience_folder_id', $experience_folder_id)->avg('rate');
        ExperienceFolder::where('id', $experience_folder_id)->update(['average_rate' => $average_rate]);

        return response()->json($comment);
    }

    public function goods_post(Request $request)
    {
        $uid = Auth::user()->id;
        $goods_folder_id = $request->goods_folder_id;
        $content = $request->content;
        $rate = $request->rate;

        $comment = [
            'user_id' => $uid,
            'goods_folder_id' => $goods_folder_id,
            'content' => $content,
            'rate' => $rate,
        ];

        GoodsComment::create($comment);
        $average_rate = GoodsComment::where('goods_folder_id', $goods_folder_id)->avg('rate');
        GoodsFolder::where('id', $goods_folder_id)->update(['average_rate' => $average_rate]);
        return response()->json($comment);
    }
}
