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
        <form >
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" v-model="aksi.ubah.title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea type="text" rows="3" class="form-control"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" class="form-control">
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
        }
    },
    props :['aksi'],
    methods:{
        Simpan(status){
            if(status=='Simpan'){
                this.SimpanProduk();
            }
            else{
                this.UbahProduk();

            }
        },

        SimpanProduk(){
            alert(this.aksi.ubah.title);
        },
        UbahProduk(){
            alert(this.aksi.ubah.title);
        }
    }

}
</script>

