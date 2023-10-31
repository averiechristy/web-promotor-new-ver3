@extends('layouts.user.app2')

@section('content2')

  <!-- ======= Edit Profil Section ======= -->

  <main id ="main">
  <section id="cobakalku" class="cobakalku d-flex align-items-center">
        <div class="container">
  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
          <div class="row justify-content-between">
          <div class="col-lg-5 pt-6 pt-lg-0  form-edit">

          <form action="{{ route('hitung') }}" method="post" role="form" class="php-email-form1 " id="calculator-form">
@csrf

         <h4 class="mt-4 text-center">Masukan kebutuhan cicilanmu</h4>
          <div id="input-fields">
<div class="input-field justify-content-center">                               

               
            <div class="mb-3 mt-4">
            <label for="email">Jenis Barang</label>
            
            <select style="width: 470px;" class="form-select" name="nama_barang[]" required  oninvalid="this.setCustomValidity('Pilih salah satu barang')" oninput="setCustomValidity('')">
    <option value="" selected disabled>-- Pilih Barang --</option>
    <option value="motor" {{ old('nama_barang.0') == 'motor' ? 'selected' : '' }}>Motor</option>
    <option value="mobil" {{ old('nama_barang.0') == 'mobil' ? 'selected' : '' }}>Mobil</option>
    <option value="rumah" {{ old('nama_barang.0') == 'rumah' ? 'selected' : '' }}>Rumah</option>
    <option value="other" {{ old('nama_barang.0') == 'other' ? 'selected' : '' }}>Other</option>
</select>


        </div>

        <div class="mb-3">
          
        <input type="text" name="nama_barang_other[]" style="width: 470px;" placeholder="Masukan nama barang lain" class="form-control" id="nama_barang_other_0" value="{{ old('nama_barang_other.0', $formInput['nama_barang_other.0'] ?? '') }}">
            
        </div>

        <div class="mb-3">

            <label for="cicilan">Cicilan</label>
            <input type="text" name="cicilan[]" style="width: 470px;" class="form-control" required value="{{ old('cicilan.0') }}" oninvalid="this.setCustomValidity('Masukan Cicilan')" oninput="setCustomValidity('')" id="cicilan">
<script>
document.getElementById('cicilan').addEventListener('input', function (e) {
    let inputValue = e.target.value.replace(/\D/g, ''); // Hapus karakter non-digit
    e.target.value = formatRupiah(inputValue);
});

function formatRupiah(value) {
    // Fungsi ini hanya menambahkan titik sebagai pemisah ribuan
    return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}


</script>

            
        </div>
        </div>
        </div>

        

<button type="button" class="btn btn-primary btn-sm " id="add-field">Tambah Barang</button>

        <br><br>
                
                <br><br>
            </div>
            
            <div class="col-lg-6 pt-5 pt-lg-0 form-edit">
           

            <div id="form-sales-skills" >
                <h4 class="mt-4 text-center">Kamu lebih jago penjualan apa</h4>
                <form id="sales-skills-form">
                   
                @foreach ($barang as $barang)
    <div class="col-auto">
        <label for="inputPassword6" class="col-form-label">{{ $barang->nama_produk }} </label>
    </div>
    <div class="row g-3 align-items-center">
        <div class="col-auto">
        <input type="number" class="form-control" style="width: 430px" name="product_persen[{{ $barang->id }}]" min="0" id="input-expression_{{ $barang->id }}" value="{{ old('product_persen.' . $barang->id) }}">
        </div>
        <div class="col-auto">
            <span id="" class="form-text">
                %
            </span>
        </div>
    </div>
@endforeach
          </div>
        </div>

        <button class="btn btn-success btn-sm mt-3 mx-auto" style="width: 50%;" type="submit">Hitung Jumlah Produk</button>
      
        @if (session('totalCicilan') && session('totalPoin') && session('jumlahProduk'))
    @php
        $totalCicilan = session('totalCicilan');
        $totalPoin = session('totalPoin');
        $jumlahProduk = session('jumlahProduk');
    @endphp


          <div class="alert alert-info mt-3">
   Asumsikan ditambahkan senilai Rp. 3.000.000 dari total cicilan untuk kebutuhan harianmu ya.
</div>

  
  <label for="name">Total Cicilan</label>
  <?php
    $formattedHasil = 'Rp. ' . number_format($totalCicilan, 0, ',', '.') . ',-';
    ?>

                            <input class="form-control font-weight-bold" style="  font-weight: bold;" type="text" value=" {{ $formattedHasil }}" aria-label="Rp. 0,-" disabled readonly>  
 
  <label class="mt-2" for="name">Target Poin</label>
                            <input class="form-control font-weight-bold"   style="font-weight: bold;" type="text" value="{{$totalPoin}} poin" aria-label="0 poin"  disabled readonly> 





    
    <div id="form-jumlah-produk" >
        <p>Jumlah Produk yang harus dijual:</p>
        <ul>
            @foreach ($jumlahProduk as $productId => $jumlah)
                @php
                    $product = \App\Models\Product::find($productId); // Gantilah '\App\Product' dengan namespace aktual model Produk Anda
                    $productName = $product->nama_produk;
                @endphp
                <li>
                    <span class="product-name">{{ $productName }}</span>:
                    <span class="product-quantity">{{ $jumlah }}</span>
                </li>
            @endforeach
        </ul>
        </div>
        @php
        session()->forget('totalCicilan');
        session()->forget('totalPoin');
        session()->forget('jumlahProduk');
    @endphp
@endif
        </form>  
      </section><!-- End Edit Profil Section -->
  
</main>
      @endsection

      <script>
document.addEventListener("DOMContentLoaded", function () {
    
    const selectInputs = document.querySelectorAll("select[name='nama_barang[]']");
    const otherInputFields = document.querySelectorAll("input[name^='nama_barang_other']");
    

    function toggleOtherInput(index) {
        const selectInputs = document.querySelectorAll("select[name='nama_barang[]']");
        const otherInputFields = document.querySelectorAll("input[name^='nama_barang_other']");

        const selectedOption = selectInputs[index].value;
        if (selectedOption === "other") {
            otherInputFields[index].style.display = "block";
        } else {
            otherInputFields[index].style.display = "none";
            otherInputFields[index].value = ""; // Reset input "nama_barang_other"
        }
    }

    selectInputs.forEach((select, index) => {
        select.addEventListener("change", () => {
            toggleOtherInput(index);
        });

        // Set initial state based on the current select value
        toggleOtherInput(index);
    });

    
    function updateSelectChangeListeners() {
        const selectInputs = document.querySelectorAll("select[name='nama_barang[]']");
        selectInputs.forEach((select, index) => {
            select.addEventListener("change", () => {
                toggleOtherInput(index);
            });

            // Set initial state based on the current select value
            toggleOtherInput(index);
        });
    }


    const addButton = document.getElementById("add-field");
    const inputFieldsContainer = document.getElementById("input-fields");
    const inputFieldTemplate = document.querySelector(".input-field").cloneNode(true);

    

    addButton.addEventListener("click", function () {
        const newInputField = inputFieldTemplate.cloneNode(true);
        inputFieldsContainer.appendChild(newInputField);

        // Tambahkan tombol "Hapus" di setiap input-field
        const deleteButton = document.createElement("button");
        deleteButton.innerText = "Hapus";
        deleteButton.className = "btn btn-danger btn-sm mb-2";
        deleteButton.addEventListener("click", function () {
            inputFieldsContainer.removeChild(newInputField);
            updateSelectChangeListeners(); // Update select change listeners after removing an input field
        });
        newInputField.appendChild(deleteButton);

        updateSelectChangeListeners(); // Update select change listeners for the newly added input field

        const newCicilanInput = newInputField.querySelector("input[name^='cicilan']");
    newCicilanInput.addEventListener('input', function (e) {
        let inputValue = e.target.value.replace(/\D/g, ''); // Hapus karakter non-digit
        e.target.value = formatRupiah(inputValue);
    });
    });

   
    

    // Initialize select change listeners for existing input fields
    updateSelectChangeListeners();
});

      </script>

<style>
    #form-jumlah-produk {
        margin-top: 20px;
        padding: 10px;
        background-color: #f2f2f2;
        border: 1px solid #ccc;
        border-radius: 5px;
    }


    .product-quantity {
        color: #01004C;
        font-weight: bold;/* Warna teks biru, bisa disesuaikan */
    }
</style>

<style>
    /* Warna latar belakang dan warna teks untuk judul */
   

    .form-edit {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        
       
    }

    h4 {
        color: #333; /* Warna teks judul */
    }

    /* Gaya untuk tombol "Tambah Barang" */
    #add-field {
        background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s; /* Tambahkan efek hover */
    }

    #add-field:hover {
        background-color: #0056b3; /* Warna tombol biru saat dihover */
    }
    input[type="text"] {
    border: 1px solid #ccc; /* Tambahkan border sesuai preferensi Anda */
    padding: 5px;
    border-radius: 5px;
}

    /* Gaya untuk alert dan hasil */
    .alert {
        background-color: #17a2b8; /* Warna latar belakang alert */
        color: #fff;
    }

    .font-weight-bold {
        font-weight: bold;
    }
</style>

