<html>
     <head>
        <title>@yield('title', 'Mi App')</title>
        @vite('resources/css/app.css')
     </head>
     <body class="bg-gray-100 font-sans">
      <main class="container mx-auto p-6">
         <aside>
        @section('sidebar')
            Este es mi master sidebar.
        @show
         </aside>
         <div>
            @yield('content')
        </div>
      </main>
     </body>
  </html>