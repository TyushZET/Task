<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        display: none;
    }
</style>
<body>
<form action="" method="post" id="addSubForm">
    @csrf
    <div class="errMsg">

    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" required >
    </div>
    <div class="mb-3">
        <label class="form-label">Website</label>
        <input type="number" class="form-control" name="website_id" id="website_id" required style="">
    </div>
    <button type="submit" class="btn btn-primary add_subscriber">Submit</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).ready(function () {
        $(document).on('click', '.add_subscriber', function (e) {
            e.preventDefault();
            let email = $('#email').val();
            let website_id = $('#website_id').val();

            $.ajax({
                url: "/api/subscribers/store",
                method: 'post',
                data: {email: email, website_id: website_id},
                success: function (res) {
                    if (res.status == 200) {
                        alert('Success')
                    }
                }, error: function (err) {
                    let error = err.responseJson;
                    $.each(error.errors, function (index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span>' + '<br>')
                    })
                }

            })
        })
    })
</script>
</body>
</html>
