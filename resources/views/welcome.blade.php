<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Library App</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* ! tailwindcss v3.4.1 | MIT License | https://tailwindcss.com */
            *,
            ::after,
            ::before {
                box-sizing: border-box;
                border-width: 0;
                border-style: solid;
                border-color: #e5e7eb;
            }
            ::after,
            ::before {
                --tw-content: '';
            }
            html {
                line-height: 1.5;
                -webkit-text-size-adjust: 100%;
                -moz-tab-size: 4;
                tab-size: 4;
                font-family: Figtree, sans-serif;
                font-feature-settings: normal;
            }
            body {
                margin: 0;
                line-height: inherit;
            }
            .relative {
                position: relative;
            }
            .mx-auto {
                margin-left: auto;
                margin-right: auto;
            }
            .mt-16 {
                margin-top: 4rem;
            }
            .flex {
                display: flex;
            }
            .scale-100 {
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
            }
            .grid {
                display: grid;
            }
            .max-w-7xl {
                max-width: 80rem;
            }
            .flex-col {
                flex-direction: column;
            }
            .gap-4 {
                gap: 1rem;
            }
            .gap-8 {
                gap: 2rem;
            }
            .p-6 {
                padding: 1.5rem;
            }
            .px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }
            .py-16 {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }
            .text-center {
                text-align: center;
            }
            .text-gray-200 {
                --tw-text-opacity: 1;
                color: rgb(229 231 235 / var(--tw-text-opacity));
            }
            .text-gray-300 {
                --tw-text-opacity: 1;
                color: rgb(209 213 219 / var(--tw-text-opacity));
            }
            .text-gray-500 {
                --tw-text-opacity: 1;
                color: rgb(107 114 128 / var(--tw-text-opacity));
            }
            .text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity));
            }
            .bg-gray-800 {
                --tw-bg-opacity: 1;
                background-color: rgb(31 41 55 / var(--tw-bg-opacity));
            }
            .bg-white {
                --tw-bg-opacity: 1;
                background-color: rgb(255 255 255 / var(--tw-bg-opacity));
            }
            .from-gray-700\/50 {
                --tw-gradient-from: rgb(55 65 81 / 0.5);
                --tw-gradient-to: rgb(55 65 81 / 0);
                --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
            }
            .via-transparent {
                --tw-gradient-to: rgb(0 0 0 / 0);
                --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to);
            }
            .bg-gradient-to-br {
                background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
            }
            .min-h-screen {
                min-height: 100vh;
            }
            .shadow-xl {
                --tw-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
                --tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            }
            .shadow-gray-500\/20 {
                --tw-shadow-color: rgb(107 114 128 / 0.2);
                --tw-shadow: var(--tw-shadow-colored);
            }
            .ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
            }
            .ring-gray-900\/5 {
                --tw-ring-color: rgb(17 24 39 / 0.05);
            }
            @media (prefers-color-scheme: dark) {
                .dark\:bg-gray-900 {
                    --tw-bg-opacity: 1;
                    background-color: rgb(17 24 39 / var(--tw-bg-opacity));
                }
                .dark\:bg-white\/5 {
                    background-color: rgb(255 255 255 / 0.05);
                }
                .dark\:text-gray-400 {
                    --tw-text-opacity: 1;
                    color: rgb(156 163 175 / var(--tw-text-opacity));
                }
                .dark\:text-white {
                    --tw-text-opacity: 1;
                    color: rgb(255 255 255 / var(--tw-text-opacity));
                }
                .dark\:ring-white\/10 {
                    --tw-ring-color: rgb(255 255 255 / 0.1);
                }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-gray-100 dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex justify-center">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Library Management System</h1>
                </div>

                <div class="mt-16">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Welcome to Library App</h2>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    A comprehensive library management system for managing books, members, and borrowings.
                                </p>
                            </div>
                        </div>

                        <div class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Get Started</h2>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Login or register to access the library management system and start managing your library resources.
                                </p>
                                <div class="mt-4 flex gap-4">
                                    <a href="{{ route('login') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Login
                                    </a>
                                    <a href="{{ route('register') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Register
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
