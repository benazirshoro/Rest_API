<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Resources\CategoryResource;

class CategoriesController extends Controller
{
    
    //get list of categories
    public function index(){

        $categories = Category::all();
        if($categories){
            return CategoryResource::collection($categories);
        } else{
            return response()->json(["message" => "The is no category avaibale"]);
        }
    }
}
