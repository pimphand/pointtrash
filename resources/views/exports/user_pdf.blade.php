<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print Data User |></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <img src="assets/upload/logo.pff" style="height: 60px;">
                    <small class="pull-right">
                        Tanggal cetak: {{now()}}
                    </small>
                </h2>
            </div>
            <!-- /.col -->
        </div>

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama User</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                {{ $item->phone }} <br>
                                {{ $item->email }}
                            </td>
                            <td>{{ $item->address }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>

