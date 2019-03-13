<?php
namespace App\Repositories;

use App\Product;
use Illuminate\Http\Request;
class ProductRepository
    {
        protected $product;

        public function __construct(Product $product)
        {
            $this->product = $product;
        }

        public function getAll()
        {
            return $this->product->orderby('id','DESC')->paginate(2);
        }

        public function postProduct(request $request)
        {
            $data= array( 
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            );

            $insertProduct = $this->product->create($data);

            return $insertProduct;
        }

        public function findProduct($id){
            return $this->product->find($id);
        }

        public function findby($column,$data)
        {
            return $this->product->where($column,$data)->get();
        }

        public function updateProduct(request $request,$id)
        {
            
            $data= array( 
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock
            );

            $updateProduct = $this->product->where('id',$id)->update($data);

            return $updateProduct;
        }

        public function deleteProduct($id)
        {
            return $this->product->destroy($id);
        }


    }

?>