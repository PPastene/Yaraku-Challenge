<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/books/save" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Title">
        <input type="text" name="author" placeholder="Author">
        <button type="submit">Create</button>
    </form>
</body>
</html>
