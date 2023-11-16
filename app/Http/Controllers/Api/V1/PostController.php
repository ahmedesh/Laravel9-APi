<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        return view('/Posts/index');
        $posts = Post::all();
//        return $posts;
        return response()->json($posts,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        return  'create page of posts';
        return str::of('create page of posts')->ucfirst();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'title' => 'required',
            'body' => 'required'
        ],[
            'title.required' => 'title is required',
            'body.required' => 'body is required',
        ]);
        if ($validator->fails()){
            $code = '404';
            return response()->json($validator , $code);
        }
             Post::create($request->all());
        $NewPost = Post::all()->where('title', $request->title);
        return $NewPost;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $postbyId = Post::where('id' , $id)->first();
        if (is_null($postbyId)){
            return response()->json('sorry not found this post');
        }
        return $postbyId;
    }

// ========== another way ===========
//    public function show(Post $post)
//    {
//        if (is_null($post)){
//            return response()->json('sorry not found this post');
//        }
//        return response()->json($post, 201);
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $updatedPost = Post::where('id' , $id)->first();
        if (is_null($updatedPost)){
            return response()->json('sorry not found this post');
        }
            $updatedPost->update(['title'=>$request->title, 'body'=>$request->body]);
//        Post::where('id' , $id)->update($request->all());    دي برضو شغاله
        $updatedPost = Post::all()->where('id' , $id);
        return  response()->json($updatedPost,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id' , $id)->first();
        if (is_null($post)){
            return response()->json('sorry not found this post');
        }
        $post->delete();
        return  response()->json('success delete',200);
    }

    public function Files(){
        return response()->download(public_path('images/image (1).png'), 'yoodaaa image');
    }
    public function UploadFiles(Request $request){
//        $fileName = "user_image.jpg";
        $file = $request->file('photo');
        $fileName = $file->getClientOriginalName();
        $path = $request->file('photo')->move(public_path("/images"), $fileName);  // to upload file
        $photoUrl = "images/".$fileName;
//        return '$photoUrl: '. $photoUrl;
        return response()->download(public_path($photoUrl));
//        return response()->download(public_path('images/yoodaaa.jpg'));

    }

}
