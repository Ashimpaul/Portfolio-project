<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Portfolio</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <meta name="turbo-visit-control" content="reload">

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        <style>
            body {
                background-color: #ffffff;
                color: #2d3748;
            }
            .header {
                background-color: #ffffff;
                border-bottom: 1px solid #e2e8f0;
                position: fixed;
                width: 100%;
                z-index: 1000;
            }
            .header a {
                color: #2d3748;
                font-weight: 500;
            }
            .header a:hover {
                color: #ff2d20;
            }
            .hero-section {
                background: linear-gradient(135deg, #f6f8fa 0%, #ffffff 100%);
                min-height: 100vh;
                padding-top: 5rem;
            }
            .btn-primary {
                background-color: #ff2d20;
                color: #fff;
                transition: all 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #e53e3e;
                transform: translateY(-2px);
            }
            .card {
                background-color: #fff;
                border: 1px solid #e2e8f0;
                transition: all 0.3s ease;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }
            .skill-badge {
                background-color: #f7fafc;
                border: 1px solid #e2e8f0;
                padding: 0.5rem 1rem;
                border-radius: 9999px;
            }
            .relative img{
                object-position: center top;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Header -->
        <div class="header py-4">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold">Portfolio</h1>
                @if (Route::has('login'))
                    <nav class="flex space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-md hover:text-gray-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 rounded-md hover:text-gray-300">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-md hover:text-gray-300">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </div>

     <!-- Hero Section -->
<div class="hero-section flex items-center">
    <div class="container mx-auto px-6">
        @php
            $latestFile = isset($files) && $files->isNotEmpty() ? $files->first() : null;
            $isImage = $latestFile && Str::endsWith($latestFile->path, ['.jpg', '.jpeg', '.png', '.gif']);
            $isPdf = $latestFile && Str::endsWith($latestFile->path, ['.pdf']);
            $filePath = $latestFile ? asset($latestFile->path) : asset('Images/front.jpg');
        @endphp

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h1 class="text-5xl font-bold leading-tight">
                    Hello, I'm <span class="text-[#ff2d20]">[Your Name]</span><br>
                    <span class="text-[#ff2d20]">Full Stack Developer</span>
                </h1>
                <p class="text-xl text-gray-600">
                    Computer Science Engineering graduate from Nagaland University (GPA: 7.48) with expertise in Python, 
                    data science, and full-stack web development. Passionate about AI/ML, data analytics, and software engineering.
                </p>
                <div class="flex space-x-4">
                    <a href="#contact" class="btn-primary px-8 py-3 rounded-lg font-semibold">
                        Get in Touch
                    </a>
                    <a href="#projects" class="px-8 py-3 rounded-lg font-semibold border border-gray-300 hover:border-[#ff2d20]">
                        View Projects
                    </a>
                </div>
            </div>

            <div class="relative text-center">
                @if ($isImage)
                    <!-- Profile Image -->
                    <img src="{{ $filePath }}" 
                         alt="Profile Image" 
                         class="rounded-2xl shadow-xl w-full object-cover"
                         style="height: 400px;">
                @elseif ($isPdf)
                    <!-- PDF Viewer -->
                    <iframe src="{{ $filePath }}#toolbar=0" 
                            class="rounded-2xl shadow-xl w-full" 
                            style="height: 400px; border: none;">
                    </iframe>
                @endif

                <!-- Download Button (For Both PDFs & Images) -->
                <div class="mt-4">
                    @foreach ($files as $file)
                        <a href="{{ route('image.download', $file->id) }}" 
                           class="btn-primary px-8 py-3 rounded-lg font-semibold mt-2 inline-block">
                            Download File
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



        <!-- Skills Section -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12">Technical Skills</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="skill-badge text-center">Python</div>
                    <div class="skill-badge text-center">JavaScript</div>
                    <div class="skill-badge text-center">React</div>
                    <div class="skill-badge text-center">Laravel</div>
                    <div class="skill-badge text-center">Data Science</div>
                    <div class="skill-badge text-center">Machine Learning</div>
                    <div class="skill-badge text-center">SQL</div>
                    <div class="skill-badge text-center">Git</div>
                </div>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-12">Featured Projects</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Project Cards -->
                    <div class="card rounded-xl overflow-hidden">
                        <img src="{{ asset('Images/project1.jpg') }}" alt="Project 1" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">Project Name</h3>
                            <p class="text-gray-600 mb-4">Detailed description of the project and the technologies used.</p>
                            <div class="flex space-x-2">
                                <span class="text-sm bg-gray-100 px-3 py-1 rounded-full">React</span>
                                <span class="text-sm bg-gray-100 px-3 py-1 rounded-full">Node.js</span>
                            </div>
                        </div>
                    </div>
                    <!-- Add more project cards similarly -->
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-center mb-12">Get in Touch</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div>
                            <h3 class="text-xl font-semibold mb-4">Contact Information</h3>
                            <div class="space-y-4">
                                <p class="flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    your.email@example.com
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Your Location
                                </p>
                            </div>
                            <div class="mt-8 flex space-x-4">
                                <!-- Add your social media links -->
                                <a href="#" class="text-gray-600 hover:text-[#ff2d20]">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-600 hover:text-[#ff2d20]">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <!-- Existing contact form with enhanced styling -->
                        <form class="space-y-6">
                            <!-- ... existing form fields with enhanced styling ... -->
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-6 text-center">
                <p class="text-gray-400">© {{ date('Y') }} Your Name. All rights reserved.</p>
                <p class="mt-2 text-sm text-gray-500">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </p>
            </div>
        </footer>
    </body>
</html>
