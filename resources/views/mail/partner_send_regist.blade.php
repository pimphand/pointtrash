<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type='text/css'>
        .header {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: auto;
            background-color: #11AB7C;
            color: #fff;
            text-align: center;
        }

        .img-size {
            width: 300px;
            height: auto;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .card {
            box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            width: 65%;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: auto;
            margin-left: auto;
        }

        .container {
            padding: 4px;
        }

        .button {
            display: inline-block;
            padding: 12px 30px;
            font-weight: 700;
            background-color: #11AB7C;
            color: #fff;
            border-radius: 3px;
            text-decoration: none;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: auto;
            background-color: #11AB7C;
            color: #fff;
            text-align: center;
        }

        body {
            font-family: sans-serif;
        }
    </style>
</head>
<body>
<div class='header'>
    <img src='{{asset('assets/pointtrash_logo.png')}}' width="80%" class='img-size'>
</div>
<div class='card'>
    @php
        date_default_timezone_set('Asia/Jakarta');
        $time_now = intval(date('H'));
        $year_now = date('Y');

        if ($time_now < 11 && $time_now >= 01) {
            $notification = 'Selamat Pagi';
        } else if ($time_now < 15 && $time_now >= 11) {
            $notification = 'Selamat Siang';
        } else if ($time_now < 20 && $time_now >= 15) {
            $notification = 'Selamat Sore';
        } else {
            $notification = 'Selamat Malam';
        }
    @endphp
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    
    <div class='container'>
        <h2>Pendaftaran Berhasil</h2>
        <p>{{$notification}}, <b>{{$partner->name}}</b></p>
        <p>Terimakasih telah mendaftar sebagai mitra di <a href='{{env('APP_URL')}}'>Pointtrash</a>. Pendaftaran akun
            anda telah diverifikasi. Untuk akses lebih lanjut, silahkan login ke akun anda.
        </p>
        <p>
            <b>Email : </b> {{$partner->email}}<br>
            <b>Password : </b> {{$password}}<br>

        </p>
        <small><em>Note : Jangan menyebarkan data ini demi keamanan akun anda</em></small>
        <br><br>
        <center>
            <p>Untuk informasi lebih lanjut silahkan hubungi CS kami, <a href='{{env('APP_URL')}}/contact'>klik
                    disini</a>.</p>
            <small><em>*Pesan ini dikirim dari server Pointtrash, jangan balas pesan ini.</em></small>
        </center>
    </div>
</div>
<div class='footer'>
    @php
        $year_now = date('Y');
    @endphp
    <p style='padding-top: 20px; padding-bottom: 20px;'>&copy; {{$year_now}} Pointtrash</p>
</div>
</body>
</html>
