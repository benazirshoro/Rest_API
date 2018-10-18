<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Run the Json file
        $products = base_path().'/database/seeds/json/spicy-deli.json';
        $json_data = file_get_contents($products);
        $products_array = json_decode($json_data, true);
        
        if($products_array["products"]) {

            foreach($products_array["products"] as $product) {

                //get category_id
                $category_id = $this->getCategoryId($product["category"]);
                
                $product_data = array(
                    'name' => $product["name"],
                    'sku' => $product["sku"],
                    'price' => $product["price"],
                    'category_id' => $category_id,
                    'created_at' => date("Y-m-d H:i:s")
                );

                DB::table('products')->insert($product_data);
            }
        }

    }

    public function getCategoryId($category_name) {
        
        //Check if category name already exists
        $category = DB::table('categories')->where('name', $category_name)->first();
            
            if($category) {
                $category_id = $category->id;
            } else {
                $category_data = array(
                    'name' =>$category_name,
                    'created_at' => date("Y-m-d H:i:s")
                );
    
                $category_id = DB::table('categories')->insertGetId($category_data);
            }
            return $category_id;
    }
}
