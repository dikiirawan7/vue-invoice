<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ProductRepository;
class ProductController extends Controller
{
    //
    private $product;

    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return view('indexproduct');
    }

    public function getAlldata()
    {
        $allData = $this->product->getAll();
        return $allData;
    }
    public function insertProduct(request $request)
    {   
        
        $insert = $this->product->postProduct($request);
        
        return response()->json($insert);
    }

    public function edit($id)
    {
        return $this->product->findProduct($id);
    }

    public function update(request $request,$id)
    {
        $data = $this->product->updateProduct($request,$id);
        return response()->json($data);
    }

    public function delete($id)
    {
        $data = $this->product->deleteProduct($id);
        return response()->json($data);
    }
}
