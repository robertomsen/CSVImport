<!DOCTYPE html>
<html>
<head>
    <title>Importar CSV - Index</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/ajax.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
</head>
<body>
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Importar CSV con nombres y categorías
        </div>

        <div class="card-body">
            <form action="{{ route('importCsv') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success" id="btn-uploadCsv">Importar CSV</button>
            </form>
        </div>
        <div class="col-md-12" style="background-color:green; color:white;" id="mensaje"></div>
    </div>
</div>

</body>
</html>