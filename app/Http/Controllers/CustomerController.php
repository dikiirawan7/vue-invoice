<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CustomerRepository;
class CustomerController extends Controller
{
    //
    private $customer;

    public function __construct(CustomerRepository $customer){
        $this->customer=$customer;

    }

    public function getData(){
        return $this->customer->getAll();
    }

    public function insertCustomer(request $request)
    {   
        
        $insert = $this->customer->postCustomer($request);
        
        return response()->json($insert);
    }

    public function edit($id)
    {
        return $this->customer->findCustomer($id);
    }

    public function update(request $request,$id)
    {
        $data = $this->customer->updateCustomer($request,$id);
        return response()->json($data);
    }

    public function delete($id)
    {
        $data = $this->customer->deleteCustomer($id);
        return response()->json($data);
    }
}
