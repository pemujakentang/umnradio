<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UMN Radio</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        div::-webkit-scrollbar {
            display: none;
            /* for Chrome, Safari, and Opera */
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
</head>

<body class="h-full bg-white">
    {{-- NAVBAR --}}
    <div x-data="{ isOpen: false }" class="fixed w-full flex justify-between p-3 z-40 bg-[#021f3a] lg:p-4">
        <a class="flex items-center" href="/">
            <img class="h-10 md:h-16 w-auto" src="{{ asset('images/logowhite.webp') }}" alt="">
        </a>

        <div class="flex items-center justify-between">
            <button @click="isOpen = !isOpen" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white lg:hidden" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="pr-4 hidden space-x-6 lg:inline-block">
                <a href="/" class="font-poppins text-base text-white no-underline">Home</a>
                <!-- <a href="#" class="font-poppins text-base text-white no-underline">About</a>
                    <a href="#" class="font-poppins text-base text-white no-underline">Programs</a> -->
                <a href="/articles" class="font-poppins text-base text-white underline-offset-4">Articles</a>
                <a href="/oprec" class="font-poppins text-base text-white underline-offset-4" hidden>OPREC</a>
            </div>

            <div class="mobile-navbar">
                <div class="fixed left-0 w-full h-48 p-5 bg-white rounded-lg shadow-xl top-16" x-show="isOpen"
                    @click.away=" isOpen = false">
                    <div class="flex flex-col space-y-6">
                        <a href="/" class="font-poppins -sm text-black">Home</a>
                        <!-- <a href="#" class="font-poppins text-sm text-black">About</a> -->
                        <a href="/articles" class="text-sm text-black">Articles</a>
                        <a href="/oprec" class="text-sm text-black" hidden>OPREC</a>
                        <!-- <a href="#" class="text-sm text-black">Podcasts</a> -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SHOW PROGRAM DETAILS HERE --}}
    <div class="w-full h-full overflow-scroll pt-16">
        <div class="font-poppins text-black relative flex justify-center">
            <img class="w-full h-40 md:h-80 object-top object-cover brightness-50"
                src="{{ asset('storage/' . $programdetail->image) }}" alt="">
            <div class="text-white absolute h-full text-center mt-8 md:mt-32 px-2">
                <h1 class="text-3xl md:text-[40px] font-bold" style="">
                    {{ $programdetail->program_name }}
                </h1>
                <div class="md:text-xl pt-2">{{ $programdetail->short_desc }}</div>
            </div>
        </div>
        <div class="py-4 px-4 md:px-48 flex justify-center flex-wrap">
            <img class="md:h-full w-[75%] md:w-[30%] object-cover pb-8" src="{{ asset('storage/' . $programdetail->image) }}"
                alt="">
            <div class="flex flex-col md:px-16 md:w-fit justify-center">
                <h3 class="text-xl">Program</h3>
                <h2 class="text-3xl font-bold">{{ $programdetail->program_name }}</h2>
                <p class="py-2 text-lg">{{ $programdetail->description }}</p>
                <br>
                <p class="py-1 text-lg"><strong>U-nnouncers :</strong> {{ $programdetail->penyiar }}</p>
                @if ($programdetail->producer)
                    <p class="py-1 text-lg"><strong>Producer :</strong> {{ $programdetail->producer }}</p>
                @endif
                @if ($programdetail->visual_creative)
                    <p class="py-1 text-lg"><strong>Visual Creative :</strong> {{ $programdetail->visual_creative }}
                    </p>
                @endif
                @if ($programdetail->audio_creative)
                    <p class="py-1 text-lg"><strong>Audio Creative :</strong> {{ $programdetail->audio_creative }}</p>
                @endif
                @if ($programdetail->media_affairs)
                    <p class="py-1 text-lg"><strong>Media Affairs :</strong> {{ $programdetail->media_affairs }}</p>
                @endif
                @if ($programdetail->music_director)
                    <p class="py-1 text-lg"><strong>Music Director :</strong> {{ $programdetail->music_director }}</p>
                @endif
            </div>
        </div>
        <div class="w-full px-4 md:px-48 pb-24 flex justify-center flex-wrap">
            <div class="swiper w-full" style= "--swiper-pagination-color: #021f3a; --swiper-pagination-bullet-inactive-color: #999999; --swiper-pagination-bullet-inactive-opacity: 1;--swiper-pagination-bullet-horizontal-gap: 6px;
            --swiper-theme-color: #ffffff;">
                <h1 class="font-poppins text-[#021f3a] font-bold text-center my-2 text-xl">Podcasts</h1>
                <div class="swiper-wrapper">
                    @foreach ($podcasts as $podcast)
                        @if ($podcast->program_id == $programdetail->id)
                            <div class="swiper-slide max-w-[400px]">{!! $podcast->embed_code !!}</div>
                        @endif
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>


    {{-- AUDIO --}}
    <footer id="audiosticky"
        class="fixed bottom-0 w-full z-40 h-16 bg-[#021f3a] flex flex-row gap-16 justify-center items-center transition-all duration-500">
        <button id="buttonplay2"><svg xmlns="http://www.w3.org/2000/svg" height="2em"
                viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path
                    d="M73 39c-14.8-9.1-33.4-9.4-48.5-.9S0 62.6 0 80V432c0 17.4 9.4 33.4 24.5 41.9s33.7 8.1 48.5-.9L361 297c14.3-8.7 23-24.2 23-41s-8.7-32.2-23-41L73 39z" />
            </svg></button>
        <button id="buttonpause2" class="hidden"><svg xmlns="http://www.w3.org/2000/svg" height="2em"
                viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <style>
                    svg {
                        fill: #ffffff
                    }
                </style>
                <path
                    d="M48 64C21.5 64 0 85.5 0 112V400c0 26.5 21.5 48 48 48H80c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H48zm192 0c-26.5 0-48 21.5-48 48V400c0 26.5 21.5 48 48 48h32c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48H240z" />
            </svg></button>
        <audio id="player">
            <source src='https://i.klikhost.com/8374/' />
        </audio>
    </footer>

    <script>
        var button3 = document.getElementById("buttonplay2");
        var button4 = document.getElementById("buttonpause2");
        var audio = document.getElementById("player");

        button3.addEventListener("click", function() {
            if (audio.paused) {
                audio.play();
                button3.classList.add('hidden');
                button4.classList.remove('hidden');
            } else {
                audio.pause();
                button4.classList.add('hidden');
                button3.classList.remove('hidden');
            }
        });

        button4.addEventListener("click", function() {
            if (audio.paused) {
                audio.play();
                button3.classList.add('hidden');
                button4.classList.remove('hidden');
            } else {
                audio.pause();
                button4.classList.add('hidden');
                button3.classList.remove('hidden');
            }
        });
    </script>
    <script src="{{ asset('js/attachments.js') }}"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".swiper", {
            slidesPerView: 'auto',
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>

    <!-- Demo styles -->
    <style>

    </style>
</body>

</html>