@extends('layouts.user.app2')

@section('content2')

       <!-- ======= Kalkulator Section ======= -->
       <section id="count" class="count d-flex align-items-center">
        <div class="container">
  
          <div class="row justify-content-between">
            <h3>Hitung pendapatan yang kamu mau!</h3>
            <div class="col-lg-5 d-flex align-items-center justify-content-center income-img">
                
                
                <img src="{{asset ('img/kalkulator-illus.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-5 pt-lg-0">
            @include('components.alert')
                <div class="col-lg-8 mt-5 mt-lg-0 d-flex align-items-center" >
                    <form action="{{ route('calculateTM') }}" method="post" role="form" class="php-email-form1" id="calculator-form">
                    @csrf
                      <p> Silakan masukan jumlah produk yang ingin kamu jual</p>
                      @if(isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif
   @foreach ($produk as $produk)
    <div class="col-auto">
    <label for="inputPassword6" class="col-form-label">{{ $produk->nama_produk }}</label>
  </div>
    <div class="row g-3 align-items-center">
 
  <div class="col-auto">
  <!-- <input type="number" class="form-control" style="width: 300px" name="product_quantity[{{ $produk->id }}]" min="0" id="input-expression" value="{{ isset($_SESSION['product_quantity'][$produk->id]) ? $_SESSION['product_quantity'][$produk->id] : old('product_quantity.' . $produk->id) }}" oninput="validasiNumber(this)"> -->
  <script>
function validasiNumber(input) {
    // Hapus karakter titik (.) dari nilai input
    input.value = input.value.replace(/\./g, '');

    // Pastikan hanya karakter angka yang diterima
    input.value = input.value.replace(/\D/g, '');
}
</script>
  

</div>
<div class="form-group">
    <label for="inputAddress">NTB Reguler</label>
    <input type="number" class="form-control" style="width: 300px" name="ntb_reg[{{ $produk->id }}]" value="{{ isset($_SESSION['ntb_reg'][$produk->id]) ? $_SESSION['ntb_reg'][$produk->id] : old('ntb_reg.' . $produk->id) }}">
  </div>
</div>

<div class="form-group">
    <label for="inputAddress">Sosmed</label>
    <input type="number" class="form-control" style="width: 300px" name="sosmed[{{ $produk->id }}]"  value="{{ isset($_SESSION['sosmed'][$produk->id]) ? $_SESSION['sosmed'][$produk->id] : old('sosmed.' . $produk->id) }}">
  </div>
</div>
@endforeach

                   
    <div class="form-group mt-3">
                    
                    <div class="text-center d-flex justify-content-center">
    <button type="submit" id="calculate-button" class="btn btn-primary" style="width:100%;">Hitung</button>
</div>
</div>
<div class="form-group mt-3">
                    <div class="row g-3">
                    @isset($hasil)
  <div class="col">
  <label for="name">Hasil yang kamu dapat</label>
  <?php
    $formattedHasil = 'Rp. ' . number_format($hasil, 0, ',', '.') . ',-';
    ?>

                            <input class="form-control font-weight-bold" style="  font-weight: bold;" type="text" value=" {{ $formattedHasil }}" aria-label="Rp. 0,-" disabled readonly>  </div>
  <div class="col">
</div>
@endisset
</div>
                    <div class="form-group col-md-6 mt-3 mt-md-0">

                    </div>
                    </div> 
                    </form>
                  </div>
          </div>
  
        </div>
      </section><!-- End Kalkulator Section -->


     
      @endsection