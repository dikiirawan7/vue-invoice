<template>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <h1>Ini Invoice</h1>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="30%">Pelanggan</td>
                                        <td>:</td>
                                        <td>{{dataPelanggan.nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{dataPelanggan.address}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <td>{{dataPelanggan.phone}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{dataPelanggan.email}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td>Perusahaan</td>
                                        <td>:</td>
                                        <td>PT.Invoice</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>Jln. Dimana Aja</td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <td>0812132322</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>support@invoiceVue.id</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-12 mt-3">
                                <form>
                                    <table class="table table-hover table-bordered">
                                        <thead class="text-center">
                                            <tr>
                                                <td>#</td>
                                                <td>Produk</td>
                                                <td>Qty</td>
                                                <td>Harga</td>
                                                <td>Subtotal</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(dataProduk,no) in dataInvoice.detail" :key="dataProduk.id" >
                                                <td>{{no+1}}</td>
                                                <td>{{dataProduk.product.title}}</td>
                                                <td>{{dataProduk.qty}}</td>
                                                <td>Rp.{{formatPrice(dataProduk.price)}}</td>
                                                <td>Rp.{{formatPrice(dataProduk.Subtotal)}}</td>
                                                <td><button class="btn btn-sm btn-danger" @click.prevent="hapusproduk(dataProduk.id)">Hapus</button>
                                                
                                                </td>
                                            </tr>
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <select class="form-control" v-model="produk_id.produk">
                                                        <option value="" disabled>Pilih Produk</option>
                                                        <option v-for="produkc in dataProduk" :key="produkc.id" :value="produkc.id">{{produkc.title}}</option>
                                                    </select>
                                                </td>
                                                <td class="col-md-4">
                                                    <input type="number" name="jumlah" class="form-control" v-model="produk_id.qty" v-validate="'required||numeric||min_value:1'" data-vv-as="jumlah" :class="{'is-invalid':errors.first('jumlah')}" placeholder="jumlah">
                                                    <span v-if="errors.first('jumlah')" class="text-danger">{{ errors.first('jumlah') }}</span>
                                                </td>
                                                <td colspan="3">
                                                    <button class="btn btn-primary btn-sm" @click.prevent="tambahProduk">Tambahkan</button>
                                                 </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                            <div class="col-md-4 offset-md-8">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>:</td>
                                        <td>Rp.{{formatPrice(dataInvoice.total)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pajak</td>
                                        <td>:</td>
                                        <td>2% (Rp.{{formatPrice(dataInvoice.Tax)}}) </td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>:</td>
                                        <td>Rp.{{formatPrice(dataInvoice.TotalPrice)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NProgress from 'nprogress'
export default {
    data(){
        return{
            dataInvoice:{},
            dataPelanggan:{},
            dataProduk:[],
            produk_id:{
                produk:''
            }
        }
    },
    methods:{
        hapusproduk(id){
            
            let uri = `http://localhost:8000/api/invoices/delete/${id}`;
            
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
                                'Barang Berhasil Dihapus.',
                                'success'
                                ).then(response=>{
                                    this.tampilInvoice();
                                    
                                   //this.$delete(this.posts, oke);
                                    });

                            }).then(response => { 
                                NProgress.done();
                                });
                        }
                    });
        },
        tampilInvoice(){
            NProgress.start();
            let uri =   `http://localhost:8000/api/invoices/${this.$route.params.id}`;
            axios.get(uri).then((response)=>{
            this.dataInvoice   =   response.data.invoice;
            this.dataPelanggan = response.data.invoice.customer;
            this.dataProduk   =   response.data.products;
            NProgress.done();

        });
        },
        formatPrice(value) {
                    let val = (value/1).toFixed(2).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                },
        tambahProduk(){
            if(this.produk_id.produk==''){
                 this.$swal.fire({
                        type: 'error',
                        title: 'Data Tidak Lengkap',
                        text: 'Tolong Pilih Produk!'
                        });
            }
            else{
            var id=this.dataInvoice.id;
           
            this.$validator.validateAll().then((result) => {
            if (result) {
                
                let uri='http://localhost:8000/api/invoices/update/'+id;
                axios.post(uri,this.produk_id).then((response)=>{
                     this.$swal.fire(
                    'Produk Tersimpan!',
                    'You clicked the button!',
                    'success'
                    ).then(response=>{
                         this.tampilInvoice();
                          this.produk_id={};
                          this.produk_id.produk='';
                          
                    });
                });
             return;
            }
            
            this.$swal.fire({
                        type: 'error',
                        title: 'Data Tidak Lengkap',
                        text: 'Tolong Lengkapi Data Customer!'
                        });
           });
           }

        }
    },
    created(){
        this.tampilInvoice();
        
    }

}
</script>

