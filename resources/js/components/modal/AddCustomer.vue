<template>
    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{aksi.status}} Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Customer</label>
                        <input type="text" name="namaCustomer" class="form-control" v-model="aksi.ubah.nama" v-validate="'required'" data-vv-as="Nama Customer" :class="{'is-invalid':errors.first('namaCustomer')}" >
                        <span v-if="errors.first('namaCustomer')" class="text-danger">{{ errors.first('namaCustomer') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Telp</label>
                        <input type="text" name="Phone" class="form-control" v-model="aksi.ubah.phone" v-validate="'required||numeric'" data-vv-as="Phone" :class="{'is-invalid':errors.first('Phone')}">
                        <span v-if="errors.first('Phone')" class="text-danger">{{ errors.first('Phone') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea type="text" name="Address" rows="3" class="form-control" v-model="aksi.ubah.address" v-validate="'required'" data-vv-as="Address" :class="{'is-invalid':errors.first('Address')}"></textarea>
                        <span v-if="errors.first('Address')" class="text-danger">{{ errors.first('Address') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="Email" class="form-control" v-model="aksi.ubah.email" v-validate="'required||email'" data-vv-as="Email" :class="{'is-invalid':errors.first('Email')}">
                        <span v-if="errors.first('Email')" class="text-danger">{{ errors.first('Email') }}</span>
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
                this.SimpanCustomer();
            }
            else{
                this.UbahCustomer(this.aksi.ubah.id);

            }
        },
    SimpanCustomer(e){
            this.$validator.validateAll().then((result) => {
            if (result) {
                
                let uri='http://localhost:8000/api/customer';
                axios.post(uri,this.aksi.ubah).then((response)=>{
                     this.$swal.fire(
                    'Customer Tersimpan!',
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
                        text: 'Tolong Lengkapi Data Customer!'
                        });
           });
            

        },
        
        UbahCustomer(id){
            var nama= this.aksi.ubah.nama;
            this.$validator.validateAll().then((result) => {
            if (result) {
             let uri=`http://localhost:8000/api/customer/update/${id}`;
                axios.post(uri,this.aksi.ubah).then((response)=>{
                     this.$swal.fire(
                    'Customer '+Nama+' Telah Dirubah!',
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
                        text: 'Tolong Lengkapi Data Customer!'
                        });
           });
        }
    }

}
</script>

