<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Traits\ApiResponseTrait;

class PostController extends Controller
{ use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        
    
    if($posts){

     return  PostResource::collection($posts);
    
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
    public function store(Request $request)
    {
        // $request->validate([
        //     'title'=>'required|string',
        //     'body'=>'required|string',
        //     'category_id'=>'required|exists:category,id'
        // ]);
        //try{
        $user= JWTAuth::parseToken()->Authenticate();
        $post=new Post();
        $post->title=$request->title;
        $post->body=$request->body;
        $post->category_id=$request->category_id;
        $post->user_id=$user->id;
        $post->save();
        return response()->json($post,200);
   
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
    public function update(Request $request, $id)
    {
        $post=Post::Find($id)->with(['categories']);
        // $validate=$request->validate([
        
        //     'title'=>'required|string',
        //     'body'=>'required|string',
        //     'category_id'=>'required|string' ]);
        // if(!$validate){
        //  return $this->ApiResponse(null,'Faild',400);}
        
         $post->title=$request->title;
         $post->body=$request->body;
         $post->category_id=$request->category_id;
         $post->save ();
     //]);
     if($post){ return response()->json($post,200);
         //return $this->ApiResponse(($post),'the update has been success',201);
     }
     //return $this->Apiresponse(null,'Faild',400)
     return response()->json(null,'Faild');;
 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $post=Post::Find($id);
        if(!$post){
            return $this->Apiresponse(null,'Not Found',404);
        }
        $post->delete();
        if($post){
            return $this->Apiresponse(null,'post deleted',201); 
        }
    }
}
