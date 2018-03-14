<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $pagetitle }}</title>
    </head>
    <body>
        <section class="header">
            <ul class="menu">
                <a href="/">
                    <li class="menu__item">
                        Home
                    </li>
                </a>
                <a href="/author">
                    <li class="menu__item">
                        Authors
                    </li>
                </a>
                <a href="/poem">
                    <li class="menu__item">
                        Poems
                    </li>
                </a>
            </ul>
            <div class="pagetitle">
                <h1>{{ $pagetitle }}</h1>
            </div>
        </section>
        <section class="content">
            @section('content')
                This is the master content section.
            @show
        </section>
        <footer>
            This be the footer.
        </footer>
    </body>
</html>
