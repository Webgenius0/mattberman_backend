
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }}</title>
    <!-- Bootstrap CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktEnZn1pZIl4smkRL1mYq1w1l9gMR0sA0b5IWuWi0" 
        crossorigin="anonymous">
    <style>
        body {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
            height: 100vh; /* Full viewport height */
            display: flex;
            /*align-items: center;  Vertical centering */
            justify-content: center; /* Horizontal centering */
        }
        .content-box {
            max-width: 1100px;
            padding: 20px;
            background-color: #121212; /* Slightly lighter black for content background */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); /* Subtle shadow */
        }
    </style>
</head>
<body>
    <div class="content-box text-center">
        <h1 class="mb-4">{{ $page->title }}</h1>
        <div>{!! $page->body !!}</div>
    </div>
    <!-- Bootstrap JS (optional) -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76A2b4a1KB9f3Uc+GyA8JqbtFhBOBzeyodFm44WpGmqeI5c/hM86dBhLg5K8Mw3" 
        crossorigin="anonymous"></script>
</body>
</html>
