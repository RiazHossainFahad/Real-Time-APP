<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <title>Real-Time Forum</title>
    <script>
            // rename myToken as you like
            window.myToken =  <?php echo json_encode(['csrfToken' => csrf_token(), ]); ?>
    </script>
    
</head>
<body>
    <v-app id="app">
        <app-home></app-home>
    </v-app>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>