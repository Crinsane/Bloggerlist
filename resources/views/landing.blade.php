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

<body id="page-top" class="landing-page">
    <div id="spark-app">
        @include('landing.navigation')
        @include('landing.slideshow')
        @include('landing.features-1')
        @include('landing.features-2')
        @include('landing.team')
        @include('landing.features-3')
        @include('landing.timeline')
        @include('landing.testimonials')
        @include('landing.comments')
        @include('landing.features-4')
        @include('landing.pricing')
        @include('landing.contact')
    </div>

    <!-- Mainly scripts -->
    <script src="/js/app.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/js/plugins/wow.min.js"></script>
    <script src="/js/landing.js"></script>

</body>
</html>