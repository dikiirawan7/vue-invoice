<template>
    <div class="container pt-3">
        <div class="row justify-content-center ">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6" >
                                <h2>Manajemen Produk</h2>
                            </div>
                            <div class="col-md-6 float-right">
                                <button href="" class="btn btn-primary float-right"  @click="showModal()" >Tambah Data</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>

                               <tr>
                                    <td>No</td>
                                    <td>Nama Produk</td>
                                    <td>Deskripsi</td>
                                    <td>Harga</td>
                                    <td>Stock</td>
                                    <td>Tanggal</td>
                                    <td class="col-md-3">Aksi</td>
                                </tr>

                            </thead>
                            <tbody v-for="(produk,nomer) in dataProduk" :key="produk.id">
                                <tr>
                                    <td>{{nomer+1}}</td>
                                    <td>{{produk.title}}</td>
                                    <td>{{produk.description}}</td>
                                    <td>Rp.{{formatPrice(produk.price)}}</td>
                                    <td>{{produk.stock}}</td>
                                    <td>{{format_date(produk.created_at)}}</td>
                                    <td>
                                        <a @click="showModal(produk.id)"  class="btn btn-warning btn-xs">Edit</a>
                                        <button @click.prevent="deleteProduk(produk.id,nomer)" class="btn btn-danger btn-xs">Hapus</button>
                                    </td>
                                </tr>
                                
                            </tbody>
                            <tbody v-show="jumlah.data">
                                <tr >
                                    <td colspan="7"><center>Data kosong</center></td>
                                </tr>
                            </tbody>
                            <tbody v-show="displayError">
                                <tr >
                                    <td colspan="7"><center>{{errorMsg}}</center></td>
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
        
        <AddProduk ref="modal" :aksi="aksi" v-on:Simpan="CloseProduk()"></AddProduk>
    </div>
</template>

<script>
import Pagination from '../theme/Pagination.vue'
import NProgress from 'nprogress'
import moment from 'moment'

import '../../../../node_modules/nprogress/nprogress.css'
import exampleModal from '../modal/ExampleModal.vue'
import AddProduk from '../modal/AddProduct.vue'

export default {
    components:{
        Pagination,
        exampleModal,
        AddProduk
    },
    data(){
        return{
            dataProduk:[],
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
            displayError:false

        }
    },
    mounted(){
        this.fetchUsers()
    },
    methods:{
       CloseProduk(){
            let element = this.$refs.modal.$el
               var closeModal= $(element).modal('hide');
                if(closeModal){
                    this.aksi.ubah={};
                    if(this.meta_data.total==0){
                    this.jumlah.data=!this.jumlah.data;
                    }
                    else{
                        this.jumlah.data
                    }
                    this.fetchUsers(this.meta_data.current_page);
                }
        }
        ,
        fetchUsers(page=1){
                axios.get('http://localhost:8000/api/product/',{
                    params:{
                        page
                    }
                }).then(response=>{
                this.dataProduk = response.data.data;
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
            }).catch(error => {
                let statusCode = error.response.status
                if(statusCode==500){
                    this.errorMsg='Tidak Tersambung Ke Database'
                }
                else{
                    this.errorMsg=error
                }
                this.displayError=true
                

            });

            },
            
            showModal(id) {

                if(!id){
                    this.aksi.status="Tambah";
                    this.aksi.klik="Simpan";
                    if(!this.aksi.ubah.id){
                        this.aksi.ubah;
                    }
                    else{
                        this.aksi.ubah={};
                        this.aksi.ubah.id='';
                    }

                }
                else{
                    this.aksi.status="Edit";
                    this.aksi.klik="Ubah";
                    let uri= `http://localhost:8000/api/product/find/${id}`;
                    axios.get(uri).then(response=>{
                        this.aksi.ubah = response.data;
                    })

                 }

                let element = this.$refs.modal.$el
                $(element).modal('show')
            },
            format_date(value){
                if (value) {
                moment.locale('id');
                return moment(value).format('dddd, D MMMM YYYY')
                }
            },

            formatPrice(value) {
                    let val = (value/1).toFixed(2).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                },
    
        deleteProduk(id,no){

            let uri = `http://localhost:8000/api/product/delete/${id}`;
            var Title = this.dataProduk[no].title;
            
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
                                'Produk '+Title+' Berhasil Dihapus.',
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

//modal

</script>
