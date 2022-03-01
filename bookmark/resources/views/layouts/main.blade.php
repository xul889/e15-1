<!doctype html>
<html lang='en'>
<head>
    <title>@yield('title', 'Bookmark')</title>
    <meta charset='utf-8'>
    <link href='/css/bookmark.css' type='text/css' rel='stylesheet'>

    @yield('head')
</head>
<body>

    <header>
        <a href='/'><img src='/images/bookmark-logo@2x.png' id='logo' alt='Bookmark Logo'></a>
    </header>

    <section>
        @yield('content')
    </section>

    <footer>
        &copy; Bookmark, Inc.
    </footer>

</body>
</html>