<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
                <span class="navbar-brand" to="/">Vue Invoice</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link  class="nav-link" to="/">Home <span class="sr-only">(current)</span></router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/produk">Produk</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/customers">Customer</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/CreateInvoice">Buat Invoice</router-link>
                    </li>
                    </ul>
                </div>
        </nav>
    </div>
</template>
<style>
 .nav-item{
padding:0;
 }   
 .navbar-brand.active{
 color:black !important;    
 }
 .active {
 background-color:antiquewhite;
 color:black !important;
 
 
}
</style>

