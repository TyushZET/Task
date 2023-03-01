<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<form action="{{route('post.store')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Title</label>
        <input class="form-control" name="title">
    </div>
    <div class="mb-3">
        <label class="form-label">Content</label>
        <textarea class='form-control' name="content"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
