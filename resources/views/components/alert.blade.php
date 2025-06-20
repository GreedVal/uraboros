@if (session()->has('success') || session()->has('error') || session()->has('status'))
    <div id="alert-box"
        class="relative w-full max-w-2xl mx-auto p-4 rounded-xl border backdrop-blur-sm shadow-lg
        @if (session('success'))
            bg-green-900/30 border-green-700 text-green-300
        @elseif(session('error'))
            bg-red-900/30 border-red-700 text-red-300
        @else
            bg-blue-900/30 border-blue-700 text-blue-300
        @endif
        transition-all duration-300 ease-in-out">

        <div class="flex items-start">
            {{-- Иконка --}}
            <div class="flex-shrink-0 mr-3 pt-0.5
                @if (session('success')) text-green-400
                @elseif(session('error')) text-red-400
                @else text-blue-400 @endif">
                @if (session('success'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                @elseif(session('error'))
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @endif
            </div>

            {{-- Текст сообщения --}}
            <div class="flex-1">
                <p class="font-medium">
                    {{ session('success') ?? (session('error') ?? session('status')) }}
                </p>
            </div>

            {{-- Кнопка закрытия --}}
            <button type="button"
                class="ml-3 p-1 rounded-full hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-current"
                onclick="fadeOutAlert()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        function fadeOutAlert() {
            const alertBox = document.getElementById('alert-box');
            alertBox.style.opacity = '0';
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 300);
        }

        // Автоматическое скрытие через 5 секунд
        setTimeout(() => {
            if (document.getElementById('alert-box')) {
                fadeOutAlert();
            }
        }, 5000);
    </script>
@endif
