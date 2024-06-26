<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-white">

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
    {{-- <script src="https://kit.fontawesome.com/667eb529ec.js" crossorigin="anonymous"></script> --}}
</head>

<body class="composer h-full bg-white">
    <x-internal-nav></x-internal-nav>

    {{-- POST FORM --}}
    <div class="pt-10 mx-6 md:mx-48 font-poppins text-black pb-24">
        <h1 class="pt-12 md:pt-24 text-center font-bold mb-6">Add Song to Chart</h1>
        <div class="w-full flex justify-center">
            <a href="/charts/new" class="px-2">
                <button
                    class="bg-green-500 hover:bg-green-400 text-white font-bold py-1 px-2 border-b-4 border-green-700 hover:border-green-500 rounded">
                    New Chart
                </button>
            </a>
            <a href="/songs/new" class="px-2">
                <button
                    class="bg-green-500 hover:bg-green-400 text-white font-bold py-1 px-2 border-b-4 border-green-700 hover:border-green-500 rounded">
                    New Song
                </button>
            </a>
        </div>
        <div class="w-full flex justify-center">

            <form id="junctionForm" class="w-fit flex justify-center flex-col flex-wrap"
                action="/charts/add-song/store" enctype="multipart/form-data" method="post">
                @csrf
                <!-- Prevent implicit submission of the form -->
                <button type="submit" disabled style="display: none" aria-hidden="true"></button>
                <div class="my-2 w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="chart_name">
                        Select Chart
                    </label>
                    <select name="chart_id" id="chart_select"
                        class="py-2 px-3 text-lg font-poppins border rounded-lg mt-1 shadow w-full">
                        <option disabled selected value> -- select chart -- </option>
                        @foreach ($charts as $chart)
                            <option value="{{ $chart->id }}">{{ $chart->chart_name }}</option>
                        @endforeach
                    </select>
                    @error('chart_id')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-2 w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="">
                        Select Song
                    </label>
                    <select name="song_id" id="song_select"
                        class="py-2 px-3 text-lg font-poppins border rounded-lg mt-1 shadow w-full">
                        <option disabled selected value> -- select song -- </option>
                        @foreach ($songs as $song)
                            <option value="{{ $song->id }}">{{ $song->title }}</option>
                        @endforeach
                    </select>
                    @error('song_id')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="my-2 w-full">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="position">
                        Song Position in Chart
                    </label>
                    <input data-index='3' min="0"
                        class="@error('position') border-red-500 @enderror shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline w-full"
                        name="position" id="position" type="number" placeholder="0" value="{{ old('position') }}">
                    @error('position')
                        <div class="text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>
                <div class="">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Confirm
                    </button>
                </div>
            </form>
        </div>

    </div>
    <script src="{{ asset('js/attachments.js') }}"></script>
</body>

<script>
    $('#junctionForm').on('keydown', 'input', function(event) {
        if (event.which == 13) {
            event.preventDefault();
            var $this = $(event.target);
            var index = parseFloat($this.attr('data-index'));
            $('[data-index="' + (index + 1).toString() + '"]').focus();
        }
    });
</script>

<style>
    .attachment img {
        height: 400px;
        width: auto;
    }

    .attachment {
        display: flex;
        justify-content: center;
    }
</style>

</html>
