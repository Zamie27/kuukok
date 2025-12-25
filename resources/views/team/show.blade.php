<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahmad Rizky - Lead Developer | Kuukok Team</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-base-100 font-sans text-base-content antialiased">

    @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="bg-base-200 px-4 pt-24 pb-4">
        <div class="mx-auto max-w-7xl">
            <div class="breadcrumbs text-sm">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary hover:underline">Home</a></li>
                    <li><a href="{{ route('about.index') }}" class="text-primary hover:underline">Tentang Kami</a></li>
                    <li>Detail Anggota</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="py-12 px-4 bg-base-200 min-h-screen">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-3 gap-8">
                
                <!-- Sidebar Profile -->
                <div class="lg:col-span-1">
                    <div class="card bg-base-100 shadow-xl sticky top-28">
                        <figure class="px-6 pt-6">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1887&auto=format&fit=crop" alt="Ahmad Rizky" class="rounded-xl w-full aspect-square object-cover shadow-md" />
                        </figure>
                        <div class="card-body text-center">
                            <h1 class="text-2xl font-bold">Ahmad Rizky</h1>
                            <div class="badge badge-primary badge-outline mx-auto mb-2">Lead Developer</div>
                            
                            <p class="text-base-content/70 text-sm mb-4">
                                "Code is poetry, and I write poems that build the future."
                            </p>

                            <div class="divider my-2"></div>

                            <div class="flex justify-center gap-4">
                                <a href="#" class="btn btn-ghost btn-circle text-base-content/70 hover:text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                                </a>
                                <a href="#" class="btn btn-ghost btn-circle text-base-content/70 hover:text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                </a>
                                <a href="#" class="btn btn-ghost btn-circle text-base-content/70 hover:text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Biodata -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-4 border-b pb-2 border-base-200">Tentang Saya</h2>
                            <p class="text-base-content/80 leading-relaxed mb-4">
                                Halo! Saya Ahmad Rizky, seorang Full Stack Developer dengan pengalaman lebih dari 5 tahun dalam membangun aplikasi web yang scalable dan performant. Saya memiliki ketertarikan mendalam pada arsitektur perangkat lunak dan clean code.
                            </p>
                            <p class="text-base-content/80 leading-relaxed">
                                Di Kuukok Creative Agency, saya bertanggung jawab memimpin tim teknis, memastikan setiap baris kode yang kami tulis memenuhi standar kualitas tinggi, dan menerjemahkan kebutuhan klien menjadi solusi teknis yang efisien.
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Lokasi</div>
                                    <div class="text-base font-medium">Bandung, Indonesia</div>
                                </div>
                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Bergabung Sejak</div>
                                    <div class="text-base font-medium">Januari 2020</div>
                                </div>
                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Email</div>
                                    <div class="text-base font-medium">ahmad@kuukok.test</div>
                                </div>
                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Spesialisasi</div>
                                    <div class="text-base font-medium">Web Development, System Design</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tech Stack -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-6 border-b pb-2 border-base-200">Tech Stack & Keahlian</h2>
                            
                            <div class="space-y-6">
                                <div>
                                    <h3 class="font-bold text-lg mb-3">Backend Development</h3>
                                    <div class="flex flex-wrap gap-2">
                                        <div class="badge badge-lg p-4 gap-2 border-base-300">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png" class="w-5 h-5" alt="Laravel">
                                            Laravel
                                        </div>
                                        <div class="badge badge-lg p-4 gap-2 border-base-300">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/2560px-PHP-logo.svg.png" class="w-5 h-5" alt="PHP">
                                            PHP 8.2
                                        </div>
                                        <div class="badge badge-lg p-4 gap-2 border-base-300">
                                            <img src="https://nodejs.org/static/images/logo.svg" class="w-5 h-5" alt="Node.js">
                                            Node.js
                                        </div>
                                        <div class="badge badge-lg p-4 gap-2 border-base-300">
                                            <img src="https://www.mysql.com/common/logos/logo-mysql-170x115.png" class="w-5 h-5" alt="MySQL">
                                            MySQL
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="font-bold text-lg mb-3">Frontend Development</h3>
                                    <div class="flex flex-wrap gap-2">
                                        <div class="badge badge-lg p-4 gap-2 border-base-300">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Vue.js_Logo_2.svg/1184px-Vue.js_Logo_2.svg.png" class="w-5 h-5" alt="Vue.js">
                                            Vue.js
                                        </div>
                                        <div class="badge badge-lg p-4 gap-2 border-base-300">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg" class="w-5 h-5" alt="Tailwind">
                                            Tailwind CSS
                                        </div>
                                        <div class="badge badge-lg p-4 gap-2 border-base-300">
                                            <img src="https://alpinejs.dev/alpine_long.svg" class="w-5 h-5" alt="Alpine.js">
                                            Alpine.js
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="font-bold text-lg mb-3">Tools & DevOps</h3>
                                    <div class="flex flex-wrap gap-2">
                                        <div class="badge badge-outline badge-lg">Git & GitHub</div>
                                        <div class="badge badge-outline badge-lg">Docker</div>
                                        <div class="badge badge-outline badge-lg">AWS EC2</div>
                                        <div class="badge badge-outline badge-lg">Linux Administration</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sertifikat -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-6 border-b pb-2 border-base-200">Sertifikasi & Penghargaan</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Cert Item -->
                                <div class="flex items-start gap-4 p-4 border rounded-xl hover:border-primary transition-colors cursor-pointer group">
                                    <div class="w-12 h-12 bg-base-200 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary/10 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-base-content/70 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg group-hover:text-primary transition-colors">Laravel Certified Developer</h4>
                                        <p class="text-sm text-base-content/60">Issued by Laravel • 2023</p>
                                        <p class="text-xs text-base-content/50 mt-1">ID: LAR-8839201</p>
                                    </div>
                                </div>

                                <!-- Cert Item -->
                                <div class="flex items-start gap-4 p-4 border rounded-xl hover:border-primary transition-colors cursor-pointer group">
                                    <div class="w-12 h-12 bg-base-200 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary/10 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-base-content/70 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg group-hover:text-primary transition-colors">AWS Certified Cloud Practitioner</h4>
                                        <p class="text-sm text-base-content/60">Issued by Amazon Web Services • 2022</p>
                                        <p class="text-xs text-base-content/50 mt-1">ID: AWS-992811</p>
                                    </div>
                                </div>

                                <!-- Cert Item -->
                                <div class="flex items-start gap-4 p-4 border rounded-xl hover:border-primary transition-colors cursor-pointer group">
                                    <div class="w-12 h-12 bg-base-200 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary/10 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-base-content/70 group-hover:text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg group-hover:text-primary transition-colors">Professional Scrum Master I</h4>
                                        <p class="text-sm text-base-content/60">Issued by Scrum.org • 2021</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('components.footer')

</body>
</html>