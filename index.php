<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index HTML</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="content"></div>
    <script>
        $(document).ready(function() {
            $('#content').load('home.php');
        });
    </script>
</body>
</html>
