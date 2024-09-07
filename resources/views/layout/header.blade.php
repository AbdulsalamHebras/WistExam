<head>
    <x-slot name="header">
    </x-slot>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Experience</title>
    <link rel="stylesheet" href="{{ asset('CSS/dashboradStyle.css') }}">
    <!-- <script defer src="script.js"></script> -->
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" height="70px" width="70px">
            </div>
            <nav>
                <ul>
                    <li><a href="dashboard">Home</a></li>
                    <li><a href="about">About</a></li>
                    <li><a href="packages">Packages</a></li>
                    <li><a href="contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
