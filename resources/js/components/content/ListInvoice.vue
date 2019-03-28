<template>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="card-title">Manajemen Invoices</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover tabled-borderd">
                            <thead class="text-center">
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Nama Lengkap</th>
                                    <th>No Telp</th>
                                    <th>Total Item</th>
                                    <th>SubTotal</th>
                                    <th>Pajak</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody v-for="(invoice,nomer) in dataInvoice" :key="invoice.id">
                                <tr>
                                    <td>#{{invoice.id}}</td>
                                    <td>{{invoice.customer.nama}}</td>
                                    <td>{{invoice.customer.phone}}</td>
                                    <td><span class="badge badge-success" :class="{'badge badge-danger':invoice.Totaldetail === 0}" width="20px" >{{invoice.Totaldetail}} Items</span></td>
                                    <td>Rp.{{formatPrice(invoice.total)}}</td>
                                    <td>Rp.{{formatPrice(invoice.Tax)}}</td>
                                    <td>Rp.{{formatPrice(invoice.TotalPrice)}}</td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-primary btn-sm" target="_blank">Print</a>
                                        <router-link :to="{name:'EditInvoice',params:{id:invoice.id}}" class="btn btn-warning btn-sm">Edit</router-link>
                                        <button  @click.prevent="deleteProduk(invoice.id,nomer)" class="btn btn-danger btn-sm">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                             <tbody v-show="jumlah.data">
                                <tr >
                                    <td colspan="8"><center>Data kosong</center></td>
                                </tr>
                            </tbody>
                            <tbody v-show="displayError">
                                <tr >
                                    <td colspan="8"><center>{{errorMsg}}</center></td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination 
                            :meta_data="meta_data"
                            v-on:next="fetchUsers">
                        </pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from '../theme/Pagination.vue'
import NProgress from 'nprogress'

export default {
    components:{
        Pagination
    },
    data(){
        return{
            dataInvoice:[],
            meta_data:{
                    last_page:null,
                    current_page:1,
                    prev_page_url:null,
                    
                },
            jumlah:{
                data:false
            },
            aksi:{
                status:'',
                klik:'',
                id:'',
                ubah:{},
            },
            displayError:false,
            errorMsg:''

        
        }
    },
    mounted(){
        this.fetchUsers()
    },
    methods:{
        formatPrice(value) {
                    let val = (value/1).toFixed(2).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                },
        fetchUsers(page=1){
                NProgress.start();
                axios.get('http://localhost:8000/api/invoices/listinvoice',{
                    params:{
                        page
                    }
                }).then(response=>{
                    
                this.dataInvoice = response.data.data;
                this.meta_data.last_page = response.data.last_page;
                this.meta_data.range = 3;
                this.meta_data.current_page = response.data.current_page;
                this.meta_data.prev_page_url = response.data.prev_page_url;
                this.meta_data.prev_page_url = response.data.prev_page_url;
                this.meta_data.total = response.data.total;
                this.displayError=false;
                
                if(this.meta_data.total==0){
                    this.jumlah.data=!this.jumlah.data;
                }
                else{
                    this.jumlah.data
                }
                NProgress.done();
            }).catch(error => {
                
                let statusCode = error.response.status
                if(statusCode==500){
                    this.errorMsg='Tidak Tersambung Ke Database'
                }
                else{
                    this.errorMsg=error
                }
                this.displayError=true
                NProgress.done();

            });

            },
            deleteProduk(id,no){

            let uri = `http://localhost:8000/api/invoices/deleteinvoice/${id}`;
            
            
               this.$swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Menghapus ini maka data tidak akan kembali!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete(uri).then(response=>{
                                NProgress.start();
                            //ini untuk menghapus data di front end   this.posts.splice(oke,1);
                            this.$swal.fire(
                                'Deleted!',
                                'Data Invoice Berhasil Dihapus.',
                                'success'
                                ).then(response=>{
                                    this.fetchUsers(this.meta_data.current_page);
                                    
                                   //this.$delete(this.posts, oke);
                                    });

                            }).then(response => { 
                                NProgress.done();
                                });
                        }
                    });
        }
    }
}
</script>

