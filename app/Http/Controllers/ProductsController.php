<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Validation\Validator;

class ProductsController extends Controller
{
    
    protected $rules =  ['name' => 'required','category_id' => 'required','price' => 'required', 'sku' => 'required|unique:products'];
    
    /**
     * Display listings of all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        if($products){
            return ProductResource::collection($products);
        } else{
            return $this->showMessages(2, $id);
        }
    }

    /**
     * add a new product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {        
        $validator = \Validator::make($request->all(),$this->rules);

        if ($validator->fails()) {
        return response()->json(["errors" => $validator->errors()], 422);
        }
        
        $product = new Product;
        $product->id = $request->id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;

        if($product->save()) {
            return $this->showMessages(4, $product->id);
        } else {
            return $this->showMessages(6);
        }
    }

    /**
     * update a product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $product = Product::find($request->id);
        if(!$product){
            return $this->showMessages(1, $request->id);
        }
            
        $product->id = $request->id;
        $product->category_id = $request->category_id ? $request->category_id : $product->category_id;
        $product->name = $request->name ? $request->name : $product->name;
        $product->sku = $request->sku ? $request->sku : $product->sku;
        $product->price = $request->price ? $request->price : $product->price;

        if($product->save()) {
            return $this->showMessages(5, $request->id);
        } else {
            return $this->showMessages();
        }
    }

    /**
     * Display a single product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if($product) {
            return new ProductResource($product);
        } else {
            return $this->showMessages(1, $id);
        }
    }

    /**
     * Delete a product
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product) {
            $product->delete();
            return $this->showMessages(3,$id);
        }
        return $this->showMessages(1, $id);
    }

    /**
     * Send messages in json 
     *
     * @param  int  $message_id
     * @param  int  $product_id
     */
    public function showMessages($message_id, $product_id = null) {

        switch($message_id){
            
            case 1:
            //when product id does not exist
            $message = "The Product: ".$product_id." doesn't exist";
            break;
            
            case 2:
            //when list of products is not available
            $message = "The is no product avaibale";
            break;

            case 3:
            //when product has deleted
            $message = "The Product (id: ".$product_id.") has deleted";
            break;

            case 4:
            //when a new product has added
            $message = "The New Product (id: ".$product_id.") has added";
            break;

            case 5:
            //when product has updated
            $message = "The Product (id: ".$product_id.") has updated";
            break;

            default:
            $message = "There's some problem. Please try later";
        }

        return response()->json(["message" => $message]);
    }

}
