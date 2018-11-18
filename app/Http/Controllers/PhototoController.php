<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class PhototoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $photoposts = $user->feed_photoposts()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'photoposts' => $photoposts,
            ];
        }
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
            'file' => 'present|image|mimes:jpeg,png,jpg|dimensions:max_width=400,max_height=400'
        ]);

        
        
        if ($request->file('file')->isValid([])) {
            $file = $request->file('file');
            // 第一引数はディレクトリの指定
            // 第二引数はファイル
            // 第三引数はpublickを指定することで、URLによるアクセスが可能となる
            $path = Storage::disk('s3')->putFile('/', $file, 'public');
            // hogeディレクトリにアップロード
            // $path = Storage::disk('s3')->putFile('/hoge', $file, 'public');
            // ファイル名を指定する場合はputFileAsを利用する
            // $path = Storage::disk('s3')->putFileAs('/', $file, 'hoge.jpg', 'public');
            $request->user()->photoposts()->create([
                'content' => $request->content,
                'img_name' => $path,
            ]);
        }

        return redirect()->back();
    }
    
    public function destroy($id)
    {
      $photopost = \App\Photopost::find($id);

        if (\Auth::id() === $photopost->user_id) {
            $photopost->delete();
         }

        return redirect()->back();
    }
}
    
    

