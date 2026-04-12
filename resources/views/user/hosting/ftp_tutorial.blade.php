<x-layouts.admin title="Tutorial Penggunaan FTP">
<div class="mx-auto max-w-4xl">
    <div class="mb-8 flex items-center gap-4">
        <a href="{{ route('user.hosting.my-services') }}" class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold">Tutorial Penggunaan FTP</h1>
            <p class="text-base-content/70 dark:text-base-content/90">Panduan menghubungkan hosting Anda menggunakan FTP FileZilla.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-8">
        <!-- Step 1 -->
        <div class="card bg-base-100 shadow border border-base-200">
            <div class="card-body">
                <h2 class="card-title text-primary flex items-center gap-2">
                    <span class="badge badge-primary badge-lg text-white">1</span>
                    Persiapan Aplikasi & Data
                </h2>
                <div class="space-y-4 mt-2">
                    <p>Sebelum memulai, pastikan Anda sudah memiliki hal berikut:</p>
                    <ul class="list-disc list-inside space-y-2 text-base-content/80">
                        <li>Aplikasi FTP Client terinstall (Sangat direkomendasikan: <a href="https://filezilla-project.org/download.php?type=client" target="_blank" class="link link-primary font-bold">FileZilla Client</a>).</li>
                        <li>Data Akses FTP Anda (Dapat dilihat di halaman <a href="{{ route('user.hosting.my-services') }}" class="link link-secondary font-bold">Layanan Saya</a>).</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="card bg-base-100 shadow border border-base-200">
            <div class="card-body">
                <h2 class="card-title text-primary flex items-center gap-2">
                    <span class="badge badge-primary badge-lg text-white">2</span>
                    Cara Menghubungkan (Quickconnect)
                </h2>
                <div class="space-y-4 mt-2">
                    <p>Buka FileZilla dan isi bagian <strong>Quickconnect</strong> di bagian atas dengan detail akses Anda:</p>
                    <div class="bg-base-200 p-4 rounded-lg space-y-2 font-mono text-sm border border-base-300">
                        <p><span class="text-primary font-bold">Host:</span> Masukkan Alamat Host FTP (Contoh: 153.xx.xx.xx)</p>
                        <p><span class="text-primary font-bold">Username:</span> Masukkan Username FTP Anda</p>
                        <p><span class="text-primary font-bold">Password:</span> Masukkan Password FTP Anda</p>
                        <p><span class="text-primary font-bold">Port:</span> 21</p>
                    </div>
                    <p>Klik tombol <strong>Quickconnect</strong>. Jika muncul jendela "Unknown certificate", centang <span class="italic">"Always trust this certificate"</span> lalu klik <strong>OK</strong>.</p>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="card bg-base-100 shadow border border-base-200">
            <div class="card-body">
                <h2 class="card-title text-primary flex items-center gap-2">
                    <span class="badge badge-primary badge-lg text-white">3</span>
                    Mengupload File ke Website
                </h2>
                <div class="space-y-4 mt-2">
                    <p>Setelah status menunjukkan <span class="badge badge-success badge-sm text-white">Logged in</span>, Anda akan melihat dua kolom utama:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-3 bg-secondary/5 border border-secondary/20 rounded-lg">
                            <p class="font-bold text-secondary mb-1">Local Site (Kiri)</p>
                            <p class="text-sm">Berisi file-file yang ada di komputer atau laptop Anda saat ini.</p>
                        </div>
                        <div class="p-3 bg-accent/5 border border-accent/20 rounded-lg">
                            <p class="font-bold text-accent mb-1">Remote Site (Kanan)</p>
                            <p class="text-sm">Berisi file-file di server hosting. Masuk ke folder <code class="bg-base-300 px-1 rounded">public_html</code>.</p>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Cukup <strong>Drag & Drop</strong> file dari panel Kiri ke panel Kanan (ke dalam folder public_html) untuk mulai mengupload.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tips -->
        <div class="card bg-warning/10 border border-warning/30">
            <div class="card-body">
                <h3 class="font-bold text-warning-content flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tips Penting
                </h3>
                <ul class="list-disc list-inside text-sm space-y-1 text-warning-content/80 mt-2">
                    <li>Jangan menghapus folder sistem utama selain isi didalam public_html.</li>
                    <li>Gunakan mode <strong>Site Manager</strong> (Ctrl+S) di FileZilla jika ingin menyimpan data login agar tidak perlu mengetik ulang.</li>
                    <li>Pastikan koneksi internet stabil saat proses upload file berukuran besar.</li>
                </ul>
            </div>
        </div>
    </div>

    </div>

    <!-- Full Source Call to Action -->
    <div class="mt-12 card bg-base-100 shadow border border-base-200">
        <div class="card-body items-center text-center">
            <h3 class="text-xl font-bold mb-2">Masih kesulitan atau butuh panduan lebih detail?</h3>
            <p class="text-base-content/60 mb-6 max-w-lg">Anda dapat melihat panduan resmi yang lebih lengkap langsung dari pusat bantuan Hostinger melalui tombol di bawah ini.</p>
            <a href="https://www.hostinger.com/support/4480505-how-to-connect-to-your-hosting-using-ftp-in-hostinger/" target="_blank" class="btn btn-outline gap-2 px-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                Lihat Panduan Lengkap di Hostinger
            </a>
        </div>
    </div>
</div>
</x-layouts.admin>
