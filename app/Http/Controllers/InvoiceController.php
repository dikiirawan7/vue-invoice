<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Invoice;
class InvoiceController extends Controller
{
    //

    public function getData(){
       return $customers = Customer::orderBy('created_at','DESC')->get(); 
    }

    public function save(Request $request){

        try{
            $invoice = Invoice::create([
                'customer_id'=>$request->optionss,
                'total'=>0
            ]);


            return response()->json($invoice);
        }
        catch(\Exception $e) {
            //JIKA GAGAL REDIRECT BACK KE FORM, DAN MENAMPILKAN ERROR MESSAGE
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        
    }
}
