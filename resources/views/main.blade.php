<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Choose which method you want to use!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text">First and second string</span>
                <input type="text" aria-label="First strong" id="first_string" class="form-control">
                <input type="text" aria-label="Second string" id="second_string"class="form-control">
                <button class="btn btn-outline-secondary" type="button" id="levenshtein">Levenshtein</button>
                <button class="btn btn-outline-secondary" type="button" id="hamming">Hamming</button>
            </div>
                <div class="alert alert-success" id="success" role="alert" style="display:none;" ></div>
                <div class="alert alert-danger" id="error" role="alert" style="display:none;" ></div>
            </div>
        </div>
    </div>
</div>

</body>
<script type="text/javascript">

    $('#levenshtein').on('click', function (e) {
        e.preventDefault();

        send("/api/levenshtein/submit")
    });

    $('#hamming').on('click', function (e){
        e.preventDefault();

        send("/api/hamming/submit")
    });

    function send(link) {

        $('#success').hide();

        $.ajax({
            url: link,
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                first_string: $('#first_string').val(),
                second_string: $('#second_string').val(),
            },
            success:function(response) {
                $('#success').show().text('Answer: ' + response.value);
            },
            error:function (error) {
                $('#error').show().text('Answer: ' + error.responseJSON.status);
            }
        });
    }
</script>
</html>
