<template>
    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{aksi.status}} Produk</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="namaProduk" class="form-control" v-model="aksi.ubah.title" v-validate="'required'" data-vv-as="Nama Produk" :class="{'is-invalid':errors.first('namaProduk')}" >
                        <span v-if="errors.first('namaProduk')" class="text-danger">{{ errors.first('namaProduk') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea type="text" name="Deskripsi" rows="3" class="form-control" v-model="aksi.ubah.description" v-validate="'required'" data-vv-as="Deskripsi" :class="{'is-invalid':errors.first('Deskripsi')}"></textarea>
                        <span v-if="errors.first('Deskripsi')" class="text-danger">{{ errors.first('Deskripsi') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="Harga" class="form-control" v-model="aksi.ubah.price" v-validate="'required||numeric'" data-vv-as="Harga" :class="{'is-invalid':errors.first('Harga')}">
                        <span v-if="errors.first('Harga')" class="text-danger">{{ errors.first('Harga') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" name="stok" class="form-control" v-model="aksi.ubah.stock" v-validate="'required||numeric'" data-vv-as="Stok" :class="{'is-invalid':errors.first('Harga')}">
                        <span v-if="errors.first('stok')" class="text-danger">{{ errors.first('stok') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" @click.prevent="Simpan(aksi.klik)">{{aksi.klik}}</button>
        </div>
        </form>
        </div>
    </div>
    </div>
</template>

<script>

export default {
    
    data(){
        return{
            produk:{},
            message:''
        }
    },
    props :['aksi'],
    methods:{
        
        Simpan(status){
            if(status=='Simpan'){
                this.SimpanProduk();
            }
            else{
                this.UbahProduk(this.aksi.ubah.id);

            }
        },
    SimpanProduk(e){
            this.$validator.validateAll().then((result) => {
            if (result) {
                
                let uri='http://localhost:8000/api/product';
                axios.post(uri,this.aksi.ubah).then((response)=>{
                     this.$swal.fire(
                    'Produk Tersimpan!',
                    'You clicked the button!',
                    'success'
                    ).then(response=>{
                         this.$emit('Simpan',status);
                          
                    });
                });
             return;
            }

            this.$swal.fire({
                        type: 'error',
                        title: 'Data Tidak Lengkap',
                        text: 'Tolong Lengkapi Data Produk!'
                        });
           });
            

        },
        
        UbahProduk(id){
            var title= this.aksi.ubah.title;
            this.$validator.validateAll().then((result) => {
            if (result) {
             let uri=`http://localhost:8000/api/product/update/${id}`;
                axios.post(uri,this.aksi.ubah).then((response)=>{
                     this.$swal.fire(
                    'Produk '+title+' Telah Dirubah!',
                    'You clicked the button!',
                    'success'
                    ).then(response=>{
                         this.$emit('Simpan',status);
                    });
                });
             return;
            }

            alert('Correct them errors!');
           });
        }
    }

}
</script>

