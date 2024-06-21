<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
       @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-black"><br>
            <br><br><br><br><br><br><br><br><br>
            <h2>ContactListApp is a streamlined contact management application designed to keep all your important contacts organized, accessible, and secure. Whether you're managing personal relationships or business connections, ContactListApp provides an intuitive and efficient way to store, search, and update contact information.</h2>
            <br>
            <button class="mx-auto px-4 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"><a href="login">Proceed</a></button>
        </div>
    </body>
</html>
