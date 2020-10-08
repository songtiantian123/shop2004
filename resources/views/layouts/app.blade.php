<html>
    <head>
        <title>- @yield('title')</title>
    </head>
    <body>
         @section('sidebar')
             这里是左侧栏
             @show
             <div class="container">
                 @yield('content')
             </div>
    </body>
</html>
