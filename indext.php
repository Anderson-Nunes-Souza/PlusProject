<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <p id="corpo">Body da página</p>
    <script>
        $.ajax({
            url: "./phps/teste.php",
            type: "POST",
            success: function(result) {
                document.write(result);
            },
            error: function() {
                console.log(error);
            }
        })
    
    </script>
</body>

</html>