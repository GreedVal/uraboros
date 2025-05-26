@if (session()->has('success') || session()->has('error') || session()->has('status'))
    <div id="alert-box"
        class="relative p-6 mb-6 rounded-xl shadow-lg
        @if (session('success')) text-green-700 bg-green-100 dark:bg-green-900 dark:text-green-300
        @elseif(session('error')) text-red-700 bg-red-100 dark:bg-red-900 dark:text-red-300
        @else text-blue-700 bg-blue-100 dark:bg-blue-900 dark:text-blue-300 @endif">

        {{-- Alert Message --}}
        <p class="text-lg font-semibold">
            {{ session('success') ?? (session('error') ?? session('status')) }}
        </p>

        {{-- Close Button --}}
        <button type="button"
            class="absolute top-3 right-3 text-2xl font-bold text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none"
            onclick="document.getElementById('alert-box').style.display='none';">
            &times;
        </button>
    </div>
@endif
