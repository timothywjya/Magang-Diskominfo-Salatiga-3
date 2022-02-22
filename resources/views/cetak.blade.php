<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>
<style>
  :root {
    --color1: #007af3;
  }

  body {
    background: #ffffff;
    margin: 0;
  }

  .header {
    background-color: rgb(255, 255, 255);

    height: 130px;
  }

  .container {

    display: inline-flex;
    width: max-content;

  }

  .header-isi {
    text-align: center;

  }

  .barcode {
    margin-top: 1em;
  }

  .underline-1 {
    background-color: #074e94;
    height: 5px;
    width: 800px;
    border-radius: 2em;
  }

  .underline-2 {
    background-color: #074e94;
    margin-top: 5px;
    height: 7px;
    width: 800px;
    border-radius: 1em;
  }

  section {
    padding: 0em 2em;
  }

  .kuitansi {
    padding-top: 4em;
    padding-bottom: 2em;
  }

  .container-1 {
    width: 800px;
    height: 800px;
  }

  .TandaTangan {
    text-align: center;
    padding: 5em 0em;
  }

  .TandaTangan p {
    padding: 2em;
  }
</style>

<body>
  <div class="header">
    <div class="container">
      <div class="logo">
        <img src="{{url('/images/radio.png')}}" width="150px">
      </div>
      <div class="header-isi">
        <a style="font-size: 20px;">Lembaga Penyiaran Publik Lokal (LPPL)</a>
        <h1>RADIO SUARA SALATIGA</h1>
        <a>jl.Pemuda No.3, Salatiga, Jawa Tengah</a>
        <br>

        <a>Telp. (0298) 312082, (0298) 323210</a>
        <br>

        <a>Email: suarasalatiga@salatiga.go.id - Website: https://suarasalatiga.com</a>
      </div>
      <div class="barcode">
        <?php echo DNS2D::getBarcodeHTML(route('cetak', ['nomor_dokumen'=>$data[0]->nomor_dokumen, 'nomor_billing'=>$data[0]->nomor_billing, 'tanggal_setor'=>$data[0]->tanggal_setor->format('Ymd')]), 'QRCODE', 4, 4); ?>
      </div>
    </div>
    <div class="underline-1"></div>
    <div class="underline-2"></div>
  </div>
  <section class="isi">
    <div class="kuitansi">
      <table border="0">
        <tr>
          <th width="25%"> </th>
          <th width="75%"> </th>
        </tr>
        <tr>
          <td>Nomor Dokumen</td>
          <td>: {{$data[0]->nomor_dokumen}} </td>

        </tr>
        <tr>
          <td>Nomor Billing</td>
          <td>: {{$data[0]->nomor_billing}} </td>

        </tr>
        <tr>
          <td>Tanggal</td>
          <td>: {{($data[0]->tanggal_setor)->isoFormat('dddd, D MMMM Y')}} </td>

        </tr>
      </table>
    </div>
    <div class="container-1">

      <div class="tabel">
        <table class="table table-striped">

          <tr class="bg-secondary text-white">
            <th width="300">
              Nama
            </th>
            <th width="300">
              Keterangan
            </th>
            <th width="60">
              Jumlah
            </th>
          </tr>
          @foreach($data as $d)
          <tr>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->keterangan }}</td>
            <td align="right">{{ number_format($d->jumlah, 0,',','.') }}</td>
          </tr>
          @php
          $total += $d->jumlah ;
          @endphp
          @endforeach
          <tr class="bg-secondary text-white">
            <td colspan="2">Total</td>
            <td align="right">{{ number_format($total,0,',','.') }}</td>
          </tr>
        </table>
        <p> Terbilang : <i>{{Terbilang::make($total, ' rupiah','senilai ')}}</i></p>
      </div>
      <div class="TandaTangan">
        <table width="100%">
          <tr>
            <th width="60%"> </th>
            <th width="40%">Salatiga, {{($data[0]->tanggal_setor)->isoFormat('D MMMM Y');}}</th>
          </tr>
          <tr>
            <td height="70px"> </td>
            <td> </td>

          </tr>
          <tr>
            <td> </td>
            <td>
              <center>Ari Purwani</center>
            </td>

          </tr>
        </table>
      </div>
      <div class="footer">
        <p style="font-size: 10px;">Kuitansi ini merupakan bukti pembayaran yang sah dan dapat diakses melalui alamat http://radiodiskom1.test/cetak/{{($data[0]->nomor_dokumen)}}/{{($data[0]->nomor_billing)}} atau Scan QR code diatas</p>

      </div>
    </div>
  </section>
</body>

</html>