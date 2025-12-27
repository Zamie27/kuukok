<!DOCTYPE html>
<html lang="id" data-theme="light" class="scroll-smooth">

<head>
    @include('components.head', [
    'title' => ($profile->user->name ?? 'Team Member') . ' - ' . ($profile->position ?? 'Member') . ' | Kuukok Team'
    ])
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

    <section class="py-12 px-4 bg-base-200 min-h-screen" x-data="{
        certModalOpen: false,
        certTitle: '',
        certImage: '',
        openCert(title, url, isImage) {
            if (isImage) {
                this.certTitle = title;
                this.certImage = url;
                this.certModalOpen = true;
            } else {
                window.open(url, '_blank');
            }
        }
    }">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-3 gap-8">

                <!-- Sidebar Profile -->
                <div class="lg:col-span-1">
                    <div class="card bg-base-100 shadow-xl sticky top-28">
                        <figure class="px-6 pt-6">
                            @if($profile->avatar)
                            <img src="{{ asset('storage/'.$profile->avatar) }}" alt="{{ $profile->user->name }}" class="rounded-xl w-full aspect-square object-cover shadow-md" />
                            @else
                            <div class="w-full aspect-square bg-neutral text-neutral-content rounded-xl flex items-center justify-center text-6xl font-bold shadow-md">
                                {{ substr($profile->user->name ?? 'U', 0, 1) }}
                            </div>
                            @endif
                        </figure>
                        <div class="card-body text-center">
                            <h1 class="text-2xl font-bold">{{ $profile->user->name ?? 'Nama Belum Diisi' }}</h1>
                            @if($profile->position)
                            <div class="badge badge-primary badge-outline mx-auto mb-2">{{ $profile->position }}</div>
                            @endif

                            @if($profile->quote)
                            <p class="text-base-content/70 text-sm mb-4 italic">
                                "{{ $profile->quote }}"
                            </p>
                            @endif

                            <div class="divider my-2"></div>

                            <div class="flex justify-center gap-4">
                                @if(!empty($profile->social_links))
                                @foreach($profile->social_links as $platform => $url)
                                @if($url)
                                <a href="{{ $url }}" target="_blank" class="btn btn-ghost btn-circle text-base-content/70 hover:text-primary tooltip" data-tip="{{ ucfirst($platform) }}">
                                    <i class="fa-brands fa-{{ strtolower($platform) }} text-xl"></i>
                                </a>
                                @endif
                                @endforeach
                                @endif
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
                            <div class="text-base-content/80 leading-relaxed mb-4 prose max-w-none">
                                {!! $profile->about_me !!}
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Lokasi</div>
                                    <div class="font-medium">
                                        {{ collect([$profile->address_city, $profile->address_province, $profile->address_country])->filter()->join(', ') ?: '-' }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Gender</div>
                                    <div class="font-medium">
                                        {{ $profile->gender == 'male' ? 'Laki-laki' : ($profile->gender == 'female' ? 'Perempuan' : '-') }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Bergabung Sejak</div>
                                    <div class="text-base font-medium">
                                        {{ $profile->joined_at ? $profile->joined_at->translatedFormat('F Y') : '-' }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Email</div>
                                    <div class="text-base font-medium break-all">{{ $profile->user->email ?? '-' }}</div>
                                </div>

                                <div>
                                    <div class="text-xs text-base-content/60 uppercase font-bold">Spesialisasi</div>
                                    <div class="text-base font-medium">
                                        @if(is_array($profile->specializations))
                                        {{ implode(', ', $profile->specializations) }}
                                        @else
                                        {{ $profile->specializations ?? '-' }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tech Stack -->
                    @if($techStacks->count() > 0)
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-6 border-b pb-2 border-base-200">Tech Stack & Keahlian</h2>

                            <div class="space-y-6">
                                @foreach($techStacks as $category => $stacks)
                                <div>
                                    <h3 class="font-bold text-lg mb-3">{{ $category }}</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($stacks as $stack)
                                        <div class="badge badge-lg py-4 px-4 gap-2 border-base-300 bg-base-100 shadow-sm">
                                            @if($stack->logo)
                                            <img src="{{ asset('storage/'.$stack->logo) }}" class="w-5 h-5 object-contain" alt="{{ $stack->name }}">
                                            @else
                                            <div class="w-5 h-5 bg-base-300 rounded-full flex items-center justify-center text-[10px] font-bold text-base-content/70">
                                                {{ substr($stack->name, 0, 1) }}
                                            </div>
                                            @endif
                                            <span class="font-medium">{{ $stack->name }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Sertifikat -->
                    @if($profile->certifications->count() > 0)
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-2xl mb-6 border-b pb-2 border-base-200">Sertifikasi & Penghargaan</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($profile->certifications as $cert)
                                @php
                                $fileUrl = asset('storage/'.$cert->file_path);
                                $isImage = preg_match('/\.(jpg|jpeg|png|webp)$/i', $cert->file_path);
                                @endphp
                                <div class="flex items-start gap-4 p-4 border rounded-xl hover:border-primary transition-colors cursor-pointer group" @click="openCert('{{ addslashes($cert->name) }}', '{{ $fileUrl }}', {{ $isImage ? 'true' : 'false' }})">
                                    <div class="w-12 h-12 bg-base-200 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:bg-primary/10 transition-colors overflow-hidden">
                                        @if($cert->file_path && $isImage)
                                        <img src="{{ $fileUrl }}" class="w-full h-full object-cover" alt="Icon">
                                        @else
                                        <i class="fa-solid fa-certificate text-base-content/70 group-hover:text-primary"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg group-hover:text-primary transition-colors">{{ $cert->name }}</h4>
                                        <p class="text-sm text-base-content/60">{{ $cert->issuer }} • {{ $cert->year }}</p>
                                        @if($cert->credential_id)
                                        <p class="text-xs text-base-content/50 mt-1">ID: {{ $cert->credential_id }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Image Modal -->
        <dialog class="modal modal-bottom sm:modal-middle" :class="{ 'modal-open': certModalOpen }">
            <div class="modal-box p-0 overflow-hidden max-w-4xl bg-base-100">
                <div class="flex justify-between items-center p-4 bg-base-200 border-b border-base-300">
                    <h3 class="font-bold text-lg" x-text="certTitle"></h3>
                    <button class="btn btn-sm btn-circle btn-ghost" @click="certModalOpen = false">✕</button>
                </div>
                <div class="p-4 flex justify-center bg-base-300/50 min-h-[200px]">
                    <img :src="certImage" class="max-h-[80vh] w-auto rounded shadow-lg object-contain" alt="Certificate">
                </div>
            </div>
            <form method="dialog" class="modal-backdrop">
                <button @click="certModalOpen = false">close</button>
            </form>
        </dialog>
    </section>

    @include('components.footer')

</body>

</html>
