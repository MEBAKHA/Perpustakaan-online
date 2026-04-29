@extends('layouts.main')

@section('konten')
    <h1 class="text-5xl text-bold text-blue-600 font-bold text-shadow-xs text-shadow-blue-400 text-center ">
        {{ $title }} Website LITEMARI</h1>
    <br>
    <h5
        class=" font-mono font-bold rounded-2xl px-6 py-6 text-2xl text-black bg-cyan-200 border-2 border-cyan-500 hover:px-9 hover:py-9 hover:bg-cyan-600 hover:text-white transition-all duration-500">
        <span
            class="text-emerald-400 font-extrabold hover:text-shadow-lg hover:bg-blue-950 hover:text-shadow-blue-50 in-hover:text-shadow-red-400 hover:text-cyan-400 transition-all duration-300">LITEMARI</span>
        <span class=" text-black hover:text-blue-50 hover:bg-black transition-all duration-300 px-2">ini adalah website
        </span>
        <span class=" text-black hover:text-blue-50 hover:bg-black transition-all duration-300">dimana kita bisa berkarya
            sesuka kita,</span>
        dan
        <span class=" text-black hover:text-blue-50 hover:bg-black transition-all duration-300">juga membaca karya dari orang
            lain</span>,
        <span class=" text-black hover:text-blue-50 hover:bg-black transition-all duration-300">kita juga bisa mengekpresikan
            diri kita melalui tulisan,</span>
        <span class=" text-black hover:text-blue-50 hover:bg-black transition-all duration-300">dan membaca baacaan yang kita
            suka yang telah di tulis oleh orang lain di website ini,</span>
        <span
            class=" text-black hover:text-blue-100 hover:bg-emerald-500 hover:text-balance transition-all duration-1000">sebebas
            itu.</span>
    </h5>

    <!-- HEADER -->
    <div class="text-center py-10">
        <h1
            class="text-5xl font-extrabold bg-gradient-to-r from-pink-500 via-purple-400 to-blue-500 bg-clip-text text-transparent">
            VISI & MISI
        </h1>
        <p class="text-gray-300 mt-2">Website Masa Depan 🚀</p>
    </div>

    <!-- VISI MISI -->
    <div class="grid md:grid-cols-2 gap-8 px-10">

        <!-- VISI -->
        <div
            class="bg-white/10 backdrop-blur-lg p-8 rounded-3xl shadow-xl hover:scale-105 transition duration-300 border border-white/20">
            <h2 class="text-3xl font-bold text-black mb-4">✨ Visi</h2>
            <p class="text-black leading-relaxed">
               memabangun website membaca dan berkarya yang inovatif,
               dan memberikan pengalaman user yang unik, dan membangun komunitas yang solid.
            </p>
        </div>

        <!-- MISI -->
        <div
            class="bg-white/10 backdrop-blur-lg p-8 rounded-3xl shadow-xl hover:scale-105 transition duration-300 border border-white/20">
            <h2 class="text-3xl font-bold text-black font-mono text-blue-400 mb-4">🔥 Misi</h2>
            <ul class="list-disc ml-5 space-y-2">
                <li>Mengembangkan fitur digital yang inovatif</li>
                <li>Meningkatkan kreativitas pengguna</li>
                <li>Membangun komunitas yang solid</li>
                <li>Menghadirkan pengalaman user yang unik</li>
            </ul>
        </div>

    </div>

    <!-- DEVELOPER -->
    <div class="mt-20 px-10">
        <h1
            class="text-4xl font-extrabold text-center mb-10 bg-gradient-to-r from-green-400 to-blue-500 bg-clip-text text-transparent font-mono">
            👨‍💻 Developer Profile
        </h1>
        <div class="flex justify-center px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white/10 backdrop-blur-xl p-6 sm:p-8 rounded-3xl shadow-2xl w-full max-w-md text-center 
            hover:scale-105 transition duration-300 border border-white/30 hover:shadow-purple-500/40">

                <!-- FOTO -->
                <div class="relative w-fit mx-auto">
                    <img src="https://gemikit45.netlify.app/assets/devoloper-C6i_YruC.png"
                        class="w-24 h-24 sm:w-32 sm:h-32 mx-auto rounded-full border-4 border-purple-500 shadow-lg mb-4">

                    <!-- efek glow -->
                    <div class="absolute inset-0 rounded-full blur-xl bg-purple-500/30 -z-10"></div>
                </div>

                <!-- NAMA -->
                <h2 class="text-lg sm:text-2xl font-bold text-emerald-400 leading-snug">
                    Rakha Maulana Raziq Tisnanda Siregar
                    <span class="block text-sm sm:text-base text-purple-300">(MeBakha Siregar)</span>
                </h2>

                <!-- ROLE -->
                <p class="text-blacktext-xs sm:text-sm mb-4">
                    Web Developer & Content Creator
                </p>

                <!-- DESKRIPSI -->
                <p class="text-black text-xs sm:text-sm leading-relaxed mb-6">
                    devoloper kelahiran bandung 11 ferbruari 2010 yang ngaku ngaku menemukan penemuan yang lebih canggih
                    dari penemuan nicola tesla katanya.

                </p>

                <!-- SOCIAL -->
                <div class="flex flex-wrap justify-center gap-2 sm:gap-4">
                    <a target="_blank" href="https://github.com/MEBAKHA/Perpustakaan-online.git"
                        class="px-3 sm:px-4 py-2 text-xs sm:text-sm bg-pink-400 rounded-xl hover:bg-pink-600 transition shadow-md">
                        Instagram
                    </a>

                    <a target="_blank" href="https://youtube.com/@mebakhaaja?si=RN-Ybmy9m7cWTwwV"
                        class="px-3 sm:px-4 py-2 text-xs sm:text-sm bg-red-500 text-white rounded-xl hover:bg-red-600 transition shadow-md">
                        YouTube
                    </a>

                    <a target="_blank" href="https://www.tiktok.com/@mebakha_siregar"
                        class="px-3 sm:px-4 py-2 text-xs sm:text-sm bg-black text-white rounded-xl hover:bg-gray-800 transition shadow-md">
                        TikTok
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class=" justify-center items-center py-12">
        <h1 class="text-center text-2xl font-extrabold py-4">CARI KATA KATA YANG BENAR DI DALAM KOTAK INI</h1>
        <div class=" text-black border border-black px-12 py-28 rounded-2xl bg-black">
            <h1 class=" text-7xl font-bold font-mono">
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">"Semakin</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">banyak</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">Anda</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">membaca</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">,</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">semakin</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> banyak</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">hal</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> yang </span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">akan</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">Anda </span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> ketahui.</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">Semakin </span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">banyak</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">Anda</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> belajar</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">,</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">semakin</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> banyak</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500">tempat</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> yang</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> akan</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> Anda</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> kunjungi.</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"—</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> Dr.</span>
                <span class=" hover:bg-amber-300/10  hover:px-9 hover:py-9 hover:text-amber-50 transition-all duration-500"> Seuss</span>
            </h1>

        </div>

    </div>
@endsection
