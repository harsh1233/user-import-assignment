<!DOCTYPE html>
<html>
<head>
    <title>CSV Upload</title>
</head>
<body>
    <form action="{{ route('upload.process') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="csv_file">CSV File:</label>
        <input type="file" name="csv_file" id="csv_file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
