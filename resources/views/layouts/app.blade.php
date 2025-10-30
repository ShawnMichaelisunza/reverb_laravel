<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="student-id" content="{{ Auth::user()->id }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const studentId = document.querySelector('meta[name="student-id"]').content;
            const absentsStudent = document.getElementById('absents');
            const presentsStudent = document.getElementById('presents');
            const studentStatus = document.getElementById('studentStatus');

            window.Echo.private(`notification-student.${studentId}`)
                .listen('.notification-received-student', (event) => {
                    console.log('Notification received:', event);

                    absentsStudent.textContent = event.absents;
                    presentsStudent.textContent = event.presents;
                    studentStatus.textContent = event.studentStatus;
                });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const studentId = document.querySelector('meta[name="student-id"]').content;
            const absentsStudent = document.getElementById('absents');
            const presentsStudent = document.getElementById('presents');
            const studentStatus = document.getElementById('studentStatus');

            window.Echo.private(`notification-student.${studentId}`)
                .listen('.notification-received-student', (event) => {
                    console.log('Notification received:', event);

                    absentsStudent.textContent = event.absents;
                    presentsStudent.textContent = event.presents;
                    // If multiple students, update the specific student status
                    if (event.studentStatus) {
                        Object.entries(event.studentStatus).forEach(([id, status]) => {
                            const el = document.querySelector(`#studentStatus-${id}`);
                            if (el) el.textContent = status;
                        });
                    }
                });
        });
    </script>

</body>

</html>
