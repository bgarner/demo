<?php

namespace App\Http\Controllers\Video;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Video\Video;

class LikeController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
     {
         $likeCount = Video::incrementLikeCount($request->id);
         return number_format($likeCount);
     }

}
