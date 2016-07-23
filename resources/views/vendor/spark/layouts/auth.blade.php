<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>The Bloggerlist</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield('scripts', '')

    <script>
        window.Spark = <?php echo json_encode(array_merge(
            Spark::scriptVariables(), []
        )); ?>;
    </script>
</head>

<body class="gray-bg">

    <div id="spark-app">
        @yield('content')
    </div>

    <!-- Mainly scripts -->
    <script src="/js/app.js"></script>
</body>
</html>