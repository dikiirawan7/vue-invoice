<?php
namespace App\Repositories;
use App\Customer;
use Illuminate\Http\Request;


class CustomerRepository{

        protected $customer;

        public function __construct(Customer $customer){
            $this->customer=$customer;

        }

        public function getAll(){
            return $this->customer->orderby('id','DESC')->paginate(5);
        }

        public function postCustomer (Request $request){
            $data= array( 
                'nama' => $request->nama,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email
            );

            return $insertCustomer = $this->customer->create($data);
        }

        public function findCustomer($id){
            return $this->customer->find($id);
        }

        public function findby($column,$data)
        {
            return $this->customer->where($column,$data)->get();
        }

        public function updateCustomer(request $request,$id)
        {
            
            $data= array( 
                'nama' => $request->nama,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email
            );

            $updateCustomer = $this->customer->where('id',$id)->update($data);

            return $updateCustomer;
        }

        public function deleteCustomer($id)
        {
            return $this->customer->destroy($id);
        }
}
?>