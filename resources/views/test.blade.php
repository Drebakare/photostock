<html>
<head>
</head>

<body>
    <form action="{{url('/test-upload')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">submit</button>
    </form>
</body>
</html>