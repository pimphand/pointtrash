@extends('frontend.layouts.app')
@section('content')
<style>
    .custom-select {
        position: relative;
        width: 100%;
    }

    .custom-select select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }

    .custom-select select:focus {
        outline: none;
        border-color: #007bff;
        /* focus color */
    }

    .custom-select select::-ms-expand {
        display: none;
        /* hide arrow in IE */
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="section-title">
                <h2 class="text-center">Daftar Mitra Pointtrash</h2>
            </div><!-- end title -->
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" id="form">
                @csrf
                <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Nama Lengkap">
                </div>
                <div class="">
                    <label for="">Jenis Kelamin</label>
                    <select class="custom-select" name="gender" id="gender" style="width: 100%;">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki - Laki">Laki - Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">No. Telp</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="No. Telp">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea class="form-control" name="address" id="address" rows="3" placeholder="Alamat"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Provinsi</label>
                    <input type="text" class="form-control" name="provinces" id="provinces" placeholder="Provinsi">
                </div>
                <div class="form-group">
                    <label for="">Kab/Kota</label>
                    <input type="text" class="form-control" name="regencies" id="regencies" placeholder="Kab/Kota">
                </div>
                <div class="form-group">
                    <label for="">Kecamatan</label>
                    <input type="text" class="form-control" name="districts" id="districts" placeholder="Kecamatan">
                </div>
                <div class="form-group">
                    <label for="">Kel/Desa</label>
                    <input type="text" class="form-control" name="villages" id="villages" placeholder="Kel/Desa">
                </div>
                <div class="form-group">
                    <label for="">No. kendaraan</label>
                    <input type="text" class="form-control" name="trans_number" id="trans_number"
                        placeholder="No. Kendaraan">
                </div>
                <div class="form-group">
                    <label for="">Info Kendaraan</label>
                    <input type="text" class="form-control" name="trans_info" id="trans_info"
                        placeholder="Info Kendaraan">
                </div>
                <div class="form-group">
                    <label for="">Foto</label>
                    <br>
                    <center>
                        <img src="https://pointtrash.co.id/assets/images/img-icon.svg" id="outputPhoto"
                            class="img-fluid rounded-circle" alt="" style="width: 200px; height: 200px;">
                    </center>
                    <br>
                    <input type="file" name="photo" class="form-control-file" onchange="loadPhoto(event)">
                </div>
                <br>
                <center>
                    <button type="button" class="btn btn-default" id="save"
                        style="display: inline-block; padding: 12px 30px; font-weight: 700; background-color: #11AB7C; color: #fff; border-radius: 40px; text-decoration: none; -webkit-transition: 0.2s all; transition: 0.2s all;">Daftar
                        Sekarang</button>
                </center>
            </form>
        </div>
        <div class="mt-4">
            <a href="#" class="ml-auto"><img src="https://pointtrash.co.id/assets/images/appstore.svg" class="img-fluid"
                    alt=""></a>
            <a href="https://play.google.com/store/apps/details?id=com.pointtrash.mitra_pointtrash" class="mr-auto"><img
                    src="https://pointtrash.co.id/assets/images/googleplaystore.svg" class="img-fluid" alt=""></a>
        </div>
    </div>
    <!--end .row-->
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    var loadPhoto = function(event) {
          var reader = new FileReader();
          reader.onload = function(){
              var outputPhoto = document.getElementById('outputPhoto');
              outputPhoto.src = reader.result;
          };
          reader.readAsDataURL(event.target.files[0]);
        };

    $('#save').click(function (e) {
        e.preventDefault();
        var form = $('#form')[0];
        var data = new FormData(form);
        //add gender value to data
        var genderValue = $('#gender').val(); // Mendapatkan nilai jenis kelamin dari dropdown select
        data.append('gender', genderValue);

        $('span.text-danger').remove();
        $.ajax({
            type: "post",
            url: "{{ route('register.partner') }}",
            data: data,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    title: "Sukses!",
                    text: "Berhasil mendaftar sebagai mitra Pointtrash. Silahkan cek email untuk mengakifkan Akun. Terima kasih!",
                    icon: "success"
                });
                $('#form').trigger("reset");
            },
            error: function (xhr, status, error) {
                //each error message
                $.each(xhr.responseJSON.errors, function (key, item) {
                    //add error message after input field with id
                    $('#' + key).after('<span class="text-danger">' + item + '</span>');

                });
            }
        });
    });

    //change href to "/"
    $('#nav_home li a').each(function() {
        $(this).attr('href','{{ route("home") }}'+$(this).attr('href') );
    });
</script>
@endpush