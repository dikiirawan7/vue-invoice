<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Invoice;
use App\Product;
use App\Invoice_detail;
class InvoiceController extends Controller
{
    //

    public function get_invoice_detail()
    {
        
        $invoice = Invoice::with(['customer','detail'])->orderby('created_at','DESC')->paginate(10);

        return response()->json($invoice);
    }

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

    public function edit($id){
        $edit['invoice'] = Invoice::with(['customer','detail','detail.product'])->find($id);
        $edit['products'] = Product::orderBy('title','ASC')->get();
        return response()->json($edit);

    }

    public function listBarang($id){

        $invoicelist= Invoice_detail::join('products','invoice_details.product_id','=','products.id')
        ->select('invoice_details.*','products.title as NBarang')
        ->where('invoice_id',$id)->get();
        return response()->json($invoicelist);
    }

    public function deletebarang($id){
        $data= Invoice_detail::destroy($id);
        return response()->json($data);
    }

    public function deleteinvoice($id){
        $data= Invoice::destroy($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        try{
            $invoice = Invoice::find($id);
            
            $product = Product::find($request->produk);
            
            $invoice_detail = $invoice->detail()->where('product_id',$product->id)->first();
            
            if($invoice_detail){
                $data=$invoice_detail->update([
                    'qty' => $invoice_detail->qty + $request->qty
                ]);
            }
            else{
               //echo $invoice->id."<br>";
              // echo $request->produk."<br>";
               //echo $product->price."<br>";
               //echo $request->qty;
                $data=Invoice_detail::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $request->produk,
                    'price' => $product->price,
                    'qty' => $request->qty
                ]);
                
            }
            
            return response()->json($data);
        }
        catch (\Exception $e) {
         
        }
    }
}
