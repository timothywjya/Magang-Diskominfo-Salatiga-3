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



    .container {

        display: inline-flex;
        margin: auto;

    }

    .logo{
        text-align: center;
        
    }
    
    .header-isi {
        text-align: center;

    }

    .line {
        padding: 1em;
    }

    .underline-1 {
        background-color: #074e94;
        height: 5px;
        width: 800px;
        border-radius: 2em;
        margin: auto;
    }

    .underline-2 {
        background-color: #074e94;
        height: 7px;
        width: 800px;
        border-radius: 1em;
        margin: auto;
    }
</style>

<body>


    <div class="line">
        <div class="underline-1"></div>
        <br><br>
        <div class="logo">
            <img src="/images/kominfo.png" width="100" height="100" alt="kominfo">
            <img src="/images/radio.png" width="100" height="100" alt="kominfo">
        </div>
        <div class="header-isi">

            <a style="font-size: 20px;">Lembaga Penyiaran Publik Lokal (LPPL)</a>
            <h1>RADIO SUARA SALATIGA</h1>
            <a href="{{ route('home') }}" type="submit" class="btn btn-primary">Kembali</a>

        </div><br><br>
        <div class="underline-2"></div>
    </div>




</body>

</html>