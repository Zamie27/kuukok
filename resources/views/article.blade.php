<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('components.head')

    <!-- Syntax Highlighting (for code blocks) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>


</head>

<body class="bg-base-100 font-sans min-h-screen">

    <!-- Reading Progress Bar -->
    <div class="progress-bar" id="progressBar"></div>

    @include('components.navbar')

    <!-- Breadcrumb -->
    <div class="pt-24 pb-4 px-4 bg-base-200">
        <div class="max-w-7xl mx-auto">
            <div class="text-sm breadcrumbs">
                <ul>
                    <li><a href="{{ route('home') }}" class="text-primary">Home</a></li>
                    <li><a href="{{ route('blog.index') }}" class="text-primary">Blog</a></li>
                    <li>Tutorial</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Article Header -->
    <div class="py-8 px-4 bg-base-200">
        <div class="max-w-4xl mx-auto">
            <!-- Category Badge -->
            <div class="flex gap-2 mb-4">
                <div class="badge badge-primary badge-lg">Tutorial</div>
                <div class="badge badge-outline badge-lg">Featured</div>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight">
                Panduan Lengkap Membuat Website Modern dengan TailwindCSS dan DaisyUI
            </h1>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-6 text-base-content/70 mb-6">
                <div class="flex items-center gap-2">
                    <div class="avatar">
                        <div class="w-10 rounded-full bg-gradient-to-br from-primary to-primary-focus flex items-center justify-center text-white font-bold">
                            AP
                        </div>
                    </div>
                    <div>
                        <p class="font-semibold text-base-content">Andi Pratama</p>
                        <p class="text-xs">Lead Developer</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>8 Desember 2025</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>10 menit baca</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span>1,234 views</span>
                </div>
            </div>

            <!-- Share Buttons -->
            <div class="flex gap-2 mb-6">
                <button class="btn btn-circle btn-sm btn-primary share-button" title="Share on Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                    </svg>
                </button>
                <button class="btn btn-circle btn-sm btn-info share-button" title="Share on Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                    </svg>
                </button>
                <button class="btn btn-circle btn-sm btn-success share-button" title="Share on WhatsApp">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                </button>
                <button class="btn btn-circle btn-sm btn-accent share-button" title="Copy Link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    <div class="px-4 bg-base-200 pb-8">
        <div class="max-w-4xl mx-auto">
            <figure class="rounded-2xl overflow-hidden shadow-2xl h-96 bg-gradient-to-br from-primary to-primary-focus">
                <div class="w-full h-full flex items-center justify-center text-9xl text-white">
                    🚀
                </div>
            </figure>
            <p class="text-center text-sm text-base-content/60 mt-4">
                Ilustrasi: Framework modern untuk web development yang powerful dan efisien
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 px-4 bg-base-100">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <!-- Table of Contents (Sidebar) -->
                <div class="lg:col-span-1 order-2 lg:order-1">
                    <div class="card bg-base-200 shadow-xl toc hidden lg:block">
                        <div class="card-body">
                            <h3 class="font-bold text-lg mb-4">Daftar Isi</h3>
                            <ul class="space-y-2 text-sm">
                                <li><a href="#intro" class="block hover:text-primary">1. Pengenalan</a></li>
                                <li><a href="#apa-itu" class="block hover:text-primary">2. Apa itu TailwindCSS?</a></li>
                                <li><a href="#kenapa-daisyui" class="block hover:text-primary">3. Kenapa DaisyUI?</a></li>
                                <li><a href="#setup" class="block hover:text-primary">4. Setup Project</a></li>
                                <li><a href="#konfigurasi" class="block hover:text-primary">5. Konfigurasi</a></li>
                                <li><a href="#komponen" class="block hover:text-primary">6. Komponen DaisyUI</a></li>
                                <li><a href="#best-practices" class="block hover:text-primary">7. Best Practices</a></li>
                                <li><a href="#kesimpulan" class="block hover:text-primary">8. Kesimpulan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="lg:col-span-3 order-1 lg:order-2">
                    <div class="card bg-base-200 shadow-xl">
                        <div class="card-body article-content">

                            <section id="intro">
                                <p>
                                    Di era modern web development, <strong>efisiensi dan produktivitas</strong> adalah kunci kesuksesan dalam membangun aplikasi web. TailwindCSS dan DaisyUI hadir sebagai solusi yang powerful untuk mempercepat proses development tanpa mengorbankan kualitas dan fleksibilitas.
                                </p>
                                <p>
                                    Dalam tutorial ini, kita akan menjelajahi bagaimana menggunakan kedua framework ini untuk menciptakan website yang <em>beautiful, responsive, dan maintainable</em>.
                                </p>
                            </section>

                            <section id="apa-itu">
                                <h2>Apa itu TailwindCSS?</h2>
                                <p>
                                    <strong>TailwindCSS</strong> adalah utility-first CSS framework yang memberikan low-level utility classes untuk membangun custom designs. Berbeda dengan framework tradisional seperti Bootstrap, Tailwind tidak menyediakan pre-designed components, melainkan building blocks yang fleksibel.
                                </p>

                                <h3>Keunggulan TailwindCSS</h3>
                                <ul>
                                    <li><strong>Highly Customizable</strong> - Dapat disesuaikan dengan kebutuhan project</li>
                                    <li><strong>Small Bundle Size</strong> - Hanya class yang digunakan yang akan masuk ke production</li>
                                    <li><strong>Responsive Design</strong> - Built-in responsive utilities yang powerful</li>
                                    <li><strong>Dark Mode Support</strong> - Native support untuk dark mode</li>
                                    <li><strong>Developer Experience</strong> - IntelliSense dan auto-completion yang excellent</li>
                                </ul>

                                <blockquote>
                                    "TailwindCSS adalah game-changer dalam cara kita menulis CSS. Productivity meningkat drastis tanpa harus menulis custom CSS yang banyak." - Adam Wathan, Creator of TailwindCSS
                                </blockquote>
                            </section>

                            <section id="kenapa-daisyui">
                                <h2>Kenapa Menggunakan DaisyUI?</h2>
                                <p>
                                    <strong>DaisyUI</strong> adalah component library yang dibangun di atas TailwindCSS. Ia menyediakan pre-designed components yang siap pakai sambil tetap mempertahankan fleksibilitas Tailwind.
                                </p>

                                <h3>Manfaat DaisyUI</h3>
                                <ol>
                                    <li><strong>Ready-to-use Components</strong> - Button, Card, Modal, dan 50+ komponen lainnya</li>
                                    <li><strong>Theming System</strong> - Mudah switch antar theme atau buat custom theme</li>
                                    <li><strong>Semantic Class Names</strong> - Class names yang mudah diingat seperti <code>btn</code>, <code>card</code>, <code>modal</code></li>
                                    <li><strong>Lightweight</strong> - Hanya menambah ~2KB ke bundle size</li>
                                    <li><strong>Customizable</strong> - Tetap bisa menggunakan utility classes Tailwind</li>
                                </ol>
                            </section>

                            <section id="setup">
                                <h2>Setup Project</h2>
                                <p>
                                    Mari kita mulai dengan setup project baru. Ada beberapa cara untuk mengintegrasikan TailwindCSS dan DaisyUI ke dalam project Anda.
                                </p>

                                <h3>1. Menggunakan CDN (Cara Tercepat)</h3>
                                <p>
                                    Untuk prototyping cepat atau testing, Anda bisa menggunakan CDN:
                                </p>
                                <pre><code class="language-html">&lt;!-- TailwindCSS + DaisyUI via CDN --&gt;
&lt;link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.19/dist/full.min.css" rel="stylesheet" /&gt;
&lt;script src="https://cdn.tailwindcss.com"&gt;&lt;/script&gt;</code></pre>

                                <h3>2. Menggunakan NPM (Recommended)</h3>
                                <p>
                                    Untuk production project, install via NPM:
                                </p>
                                <pre><code class="language-bash"># Install TailwindCSS
npm install -D tailwindcss
npx tailwindcss init

# Install DaisyUI
npm install -D daisyui@latest</code></pre>

                                <h3>3. Update tailwind.config.js</h3>
                                <p>
                                    Tambahkan DaisyUI ke dalam plugins:
                                </p>
                                <pre><code class="language-javascript">module.exports = {
  content: ["./src/**/*.{html,js}"],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: ["light", "dark", "cupcake"],
  },
}</code></pre>
                            </section>

                            <section id="konfigurasi">
                                <h2>Konfigurasi Custom</h2>
                                <p>
                                    Salah satu kekuatan terbesar dari kombinasi ini adalah kemampuan customization yang luar biasa.
                                </p>

                                <h3>Custom Colors</h3>
                                <p>
                                    Anda bisa define custom color palette sesuai brand identity:
                                </p>
                                <pre><code class="language-javascript">theme: {
  extend: {
    colors: {
      'primary': '#0EA5E9',
      'primary-dark': '#0284C7',
      'secondary': '#64748B',
      'accent': '#FACC15',
    }
  }
}</code></pre>

                                <h3>Custom DaisyUI Theme</h3>
                                <p>
                                    Buat custom theme untuk keseluruhan aplikasi:
                                </p>
                                <pre><code class="language-javascript">daisyui: {
  themes: [
    {
      mytheme: {
        "primary": "#0EA5E9",
        "secondary": "#64748B",
        "accent": "#FACC15",
        "neutral": "#0F172A",
        "base-100": "#F8FAFC",
      },
    },
  ],
}</code></pre>
                            </section>

                            <section id="komponen">
                                <h2>Menggunakan Komponen DaisyUI</h2>
                                <p>
                                    Mari kita lihat beberapa contoh praktis penggunaan komponen DaisyUI.
                                </p>

                                <h3>Button Component</h3>
                                <p>
                                    DaisyUI menyediakan berbagai varian button yang siap pakai:
                                </p>
                                <pre><code class="language-html">&lt;button class="btn btn-primary"&gt;Primary Button&lt;/button&gt;
&lt;button class="btn btn-secondary"&gt;Secondary Button&lt;/button&gt;
&lt;button class="btn btn-accent"&gt;Accent Button&lt;/button&gt;
&lt;button class="btn btn-ghost"&gt;Ghost Button&lt;/button&gt;</code></pre>

                                <div class="alert alert-info my-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span><strong>Pro Tip:</strong> Kombinasikan class DaisyUI dengan utility classes Tailwind untuk customization lebih lanjut!</span>
                                </div>

                                <h3>Card Component</h3>
                                <p>
                                    Card adalah salah satu komponen yang paling sering digunakan:
                                </p>
                                <pre><code class="language-html">&lt;div class="card bg-base-200 shadow-xl"&gt;
  &lt;figure&gt;&lt;img src="image.jpg" alt="Album" /&gt;&lt;/figure&gt;
  &lt;div class="card-body"&gt;
    &lt;h2 class="card-title"&gt;Card Title&lt;/h2&gt;
    &lt;p&gt;Card description here&lt;/p&gt;
    &lt;div class="card-actions"&gt;
      &lt;button class="btn btn-primary"&gt;Action&lt;/button&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                            </section>

                            <section id="best-practices">
                                <h2>Best Practices</h2>
                                <p>
                                    Berikut adalah beberapa best practices yang sebaiknya Anda ikuti:
                                </p>

                                <h3>1. Gunakan @apply untuk Pattern yang Berulang</h3>
                                <p>
                                    Jika Anda menemukan pattern utility classes yang sama berulang kali, extract ke dalam custom class:
                                </p>
                                <pre><code class="language-css">.btn-custom {
  @apply px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-all;
}</code></pre>

                                <h3>2. Manfaatkan Responsive Breakpoints</h3>
                                <p>
                                    Gunakan responsive prefixes untuk different screen sizes:
                                </p>
                                <pre><code class="language-html">&lt;div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"&gt;
  &lt;!-- Content --&gt;
&lt;/div&gt;</code></pre>

                                <h3>3. Optimize untuk Production</h3>
                                <p>
                                    Pastikan untuk purge unused CSS di production:
                                </p>
                                <pre><code class="language-javascript">// tailwind.config.js
module.exports = {
  content: ["./src/**/*.{html,js,jsx,tsx}"],
  // ... rest of config
}</code></pre>

                                <h3>4. Gunakan Dark Mode</h3>
                                <p>
                                    Implement dark mode dengan mudah menggunakan <code>data-theme</code> attribute:
                                </p>
                                <pre><code class="language-javascript">// Toggle dark mode
document.documentElement.setAttribute('data-theme', 'dark');</code></pre>
                            </section>

                            <section id="kesimpulan">
                                <h2>Kesimpulan</h2>
                                <p>
                                    Kombinasi <strong>TailwindCSS dan DaisyUI</strong> memberikan solusi yang sempurna untuk modern web development. Anda mendapatkan fleksibilitas dari utility-first approach Tailwind, sekaligus kecepatan development dari pre-built components DaisyUI.
                                </p>

                                <h3>Key Takeaways</h3>
                                <ul>
                                    <li>TailwindCSS memberikan foundation yang solid dan customizable</li>
                                    <li>DaisyUI mempercepat development dengan ready-to-use components</li>
                                    <li>Kombinasi keduanya menghasilkan code yang maintainable dan scalable</li>
                                    <li>Perfect untuk project kecil hingga enterprise-level</li>
                                </ul>

                                <p>
                                    Selamat mencoba dan happy coding! 🚀
                                </p>
                            </section>

                            <!-- Tags -->
                            <div class="divider my-8"></div>
                            <div class="flex flex-wrap gap-2">
                                <span class="text-sm font-semibold mr-2">Tags:</span>
                                <a href="#" class="badge badge-lg hover:badge-primary transition-colors">TailwindCSS</a>
                                <a href="#" class="badge badge-lg hover:badge-primary transition-colors">DaisyUI</a>
                                <a href="#" class="badge badge-lg hover:badge-primary transition-colors">Frontend</a>
                                <a href="#" class="badge badge-lg hover:badge-primary transition-colors">Tutorial</a>
                                <a href="#" class="badge badge-lg hover:badge-primary transition-colors">Web Development</a>
                            </div>

                        </div>
                    </div>

                    <!-- Author Bio -->
                    <div class="card bg-base-200 shadow-xl mt-8">
                        <div class="card-body">
                            <div class="flex items-start gap-4">
                                <div class="avatar">
                                    <div class="w-20 rounded-full bg-gradient-to-br from-primary to-primary-focus flex items-center justify-center text-3xl text-white font-bold">
                                        AP
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-xl mb-2">Tentang Penulis</h3>
                                    <p class="font-semibold text-primary mb-1">Andi Pratama</p>
                                    <p class="text-base-content/70 text-sm mb-3">Lead Developer at Kuukok</p>
                                    <p class="text-sm mb-4">
                                        Andi adalah full-stack developer dengan pengalaman 5+ tahun dalam web development. Passionate tentang modern web technologies dan senang berbagi knowledge melalui artikel dan tutorial.
                                    </p>
                                    <div class="flex gap-2">
                                        <a href="#" class="btn btn-circle btn-sm btn-ghost">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                            </svg>
                                        </a>
                                        <a href="#" class="btn btn-circle btn-sm btn-ghost">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                            </svg>
                                        </a>
                                        <a href="#" class="btn btn-circle btn-sm btn-ghost">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation (Prev/Next) -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-8">
                        <a href="#" class="btn btn-outline flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <div class="text-left">
                                <div class="text-xs text-base-content/60">Artikel Sebelumnya</div>
                                <div class="font-semibold">Tips Desain UI/UX</div>
                            </div>
                        </a>
                        <a href="#" class="btn btn-outline flex-1">
                            <div class="text-right">
                                <div class="text-xs text-base-content/60">Artikel Selanjutnya</div>
                                <div class="font-semibold">Tren Web 2025</div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <!-- Related Articles -->
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold mb-6">Artikel Terkait</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Related Article 1 -->
                            <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                                <figure class="h-48 bg-gradient-to-br from-accent to-yellow-600">
                                    <div class="w-full h-full flex items-center justify-center text-6xl text-neutral">
                                        💡
                                    </div>
                                </figure>
                                <div class="card-body">
                                    <div class="badge badge-accent mb-2">Tips</div>
                                    <h3 class="card-title text-lg">10 Tips Desain UI/UX untuk Pemula</h3>
                                    <p class="text-sm text-base-content/60">
                                        Temukan prinsip-prinsip dasar desain UI/UX yang akan meningkatkan kualitas produk digital...
                                    </p>
                                    <div class="card-actions mt-4">
                                        <a href="{{ route('blog.show') }}" class="btn btn-ghost btn-sm">Baca Artikel →</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Related Article 2 -->
                            <div class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all duration-300">
                                <figure class="h-48 bg-gradient-to-br from-secondary to-slate-700">
                                    <div class="w-full h-full flex items-center justify-center text-6xl text-white">
                                        📊
                                    </div>
                                </figure>
                                <div class="card-body">
                                    <div class="badge badge-secondary mb-2">Insight</div>
                                    <h3 class="card-title text-lg">Tren Web Development 2025</h3>
                                    <p class="text-sm text-base-content/60">
                                        Simak tren teknologi web terbaru yang akan mendominasi industri di tahun 2025...
                                    </p>
                                    <div class="card-actions mt-4">
                                        <a href="#" class="btn btn-ghost btn-sm">Baca Artikel →</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 px-4 bg-base-200 reveal-on-scroll">
        <div class="max-w-5xl mx-auto">
            <div class="card bg-gradient-to-br from-primary to-primary-focus text-white shadow-2xl">
                <div class="card-body text-center py-16">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Bantuan Membangun Website?</h2>
                    <p class="text-lg mb-6 opacity-90 max-w-2xl mx-auto">
                        Tim kami siap membantu mewujudkan project digital Anda dengan teknologi terkini
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" class="btn btn-accent btn-lg text-neutral font-bold">
                            Konsultasi Gratis
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline text-white border-white hover:bg-white hover:text-primary btn-lg">
                            Baca Artikel Lainnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')

    <!-- Scroll to Top Button -->
    <button id="scrollToTop" class="btn btn-circle btn-primary fixed bottom-8 right-8 z-40 shadow-lg hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>


</body>

</html>
