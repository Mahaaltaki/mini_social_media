<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ApiResponseTrait ;
    public function index()
    {
        $categories=category::all();
        
        return CategoryResource::collection($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
       // $request->validated();
        $category=new category();
        $category->name= $request->name;
        //$category->category_id= $request->category_id;
        $category->save();
        if($category){
            return response()->json($category,200);
        }else{
            return response(null,'evaluation faild');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category=category::Find($id);
        $msg=['ok'];
        return response($category,'200',$msg);
       }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {   $category=Category::Find($id);
        $category->name= $request->name;
        $category->save();
        return response()->json($category,200);

    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    { $category=Category::Find($id);
        $validate=$request->validate([
        
            'name'=>'required|string',
        ]);
        if(!$validate){
         return $this->apiResponse(null,'Faild',400);
         }
       
        //$category->update([
            
            $category->name=$request->name;
            $category->save();
        //]);
        if($category){
            return $this->ApiResponse(($category),'the update has been success',201);
        }
        return $this->Apiresponse(null,'Faild',400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category=Category::Find($id);
        if(!$category){
            return $this->Apiresponse(null,'Not Found',404);
        }
        $category->delete();
        if($category){
            return $this->Apiresponse(null,'category deleted',201); 
        }
   
    }
}
