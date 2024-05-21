<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments=Comment::all();
        
    
        if($comments){
    
         return  CommentResource::collection($comments);
        
         }
         else{return $this->ApiResponse(null,'not found',404);
            }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        $user= JWTAuth::parseToken()->Authenticate();
        $post=Post::where('id' , $id)->with('posts')->first();
        $comment=new Comment();
        $comment->body=$request->body;
        $comment->post_id=$post->id;
        $comment->user_id=$user->id;
        $comment->save();
        return response()->json($comment,200);
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $user= JWTAuth::parseToken()->Authenticate();
        $post=Post::where('id' , $id)->with('comments')->first();
        // $validate=$request->validate([
        
        //     'title'=>'required|string',
        //     'body'=>'required|string',
        //     'category_id'=>'required|string' ]);
        // if(!$validate){
        //  return $this->ApiResponse(null,'Faild',400);}
        if($post){
            $comment=new Comment();
            $comment->body=$request->body;
            $comment->post_id=$post->id;
            $comment->user_id=$user->id;
            $comment->save();
            return response()->json($comment,200);}
            return response()->json(null,'Faild');;
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $comment=Comment::Find($id);
        if(!$comment){
            return $this->Apiresponse(null,'Not Found',404);
        }
        $comment->delete();
        if($comment){
            return $this->Apiresponse(null,'comment deleted',201); 
        }
    }
}
