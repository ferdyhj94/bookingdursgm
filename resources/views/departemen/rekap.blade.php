
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style type="text/css">
    .table{
      border: 1px;
    }
    .page-break{
        page-break-after: always;
    }
        </style>
    <title>Rekap Stok Obat Opname</title>
  </head>
  <body>
    <h3>Rekap Stok Obat Opname Apotek Kronggahan</h3>
    <table class="table table-bordered">
      <tr>
        <th>No.</th>
        <th>Kode Obat</th>
        <th>Nama Obat</th>
        <th>Qty</th>
      </tr>
      <?php $no=1; ?>
      @foreach($stok as $data)
      <tr>
        <td>{{$no++}}</td>
        <td>{{$data->kode_obat}}</td>
        <td>{{$data->nama_obat}}</td>
        <td>{{$data->qty}}</td>
      </tr>
      @endforeach
    </table>
  </body>
</html>