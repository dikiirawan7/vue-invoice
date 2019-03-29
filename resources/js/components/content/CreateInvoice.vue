<template>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Buat Invoice</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group" >
                                <label>Customer</label>
                                <select name="Customer_id" class="form-control" v-model="customer_id.optionss" >
                                    <option value="" disabled>Pilih Customer</option>
                                    <option v-for="customer in dataCustomer" :key="customer.id" :value="customer.id">{{customer.nama}}</option>
                                </select>
                                
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" @click.prevent="Simpan()">Simpan</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            dataCustomer:[],
            customer_id:{
                optionss:"",
            },
    

         }
    },
    methods:{
        Simpan(){
            if(this.customer_id.optionss==''){
                 this.$swal.fire({
                        type: 'error',
                        title: 'Data Tidak Lengkap',
                        text: 'Tolong Pilih Customer!'
                        });
            }
            else{
                let uri='http://localhost:8000/api/invoices/';
                axios.post(uri,this.customer_id).then(response=>{
                    this.$router.push({name:'EditInvoice',params:{id:response.data.id}});//untuk reload location
                });
            }
        }
    },
    created(){
        
            axios.get('http://localhost:8000/api/customer/')
                .then(response=>{
                    this.dataCustomer = response.data.data;
                });
        
    }
    
}
</script>
