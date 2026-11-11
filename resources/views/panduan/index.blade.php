<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan — IKAMAS STAIMAS Wonogiri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes wiggle {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(-10deg); }
            75% { transform: rotate(10deg); }
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        
        .animate-bounce-slow {
            animation: bounce 2s ease-in-out infinite;
        }
        
        .animate-wiggle {
            animation: wiggle 1s ease-in-out infinite;
        }
        
        .animate-pulse-slow {
            animation: pulse 2s ease-in-out infinite;
        }
        
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink {
            50% { border-color: transparent }
        }
        
        .typing-text {
            overflow: hidden;
            border-right: 3px solid #1B5E20;
            white-space: nowrap;
            animation: typing 3.5s steps(40, end), blink .75s step-end infinite;
            display: inline-block;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-50 via-blue-50 to-green-50 min-h-screen flex items-center justify-center p-4">
    
    <div class="max-w-2xl w-full">
        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-[#1B5E20] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="text-sm font-medium">Kembali</span>
            </a>
        </div>

        {{-- Main Card --}}
        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 relative overflow-hidden">
            
            {{-- Decorative circles --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-100 to-green-100 rounded-full opacity-20 -mr-32 -mt-32 animate-pulse-slow"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-green-100 to-blue-100 rounded-full opacity-20 -ml-24 -mb-24 animate-float"></div>
            
            {{-- Content --}}
            <div class="relative z-10 text-center">
                
                {{-- Animated Icon --}}
                <div class="mb-8 flex justify-center">
                    <div class="relative">
                        <div class="w-32 h-32 bg-gradient-to-br from-yellow-400 to-orange-400 rounded-full flex items-center justify-center animate-bounce-slow shadow-lg">
                            <svg class="w-16 h-16 text-white animate-wiggle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        {{-- Sparkles --}}
                        <div class="absolute -top-2 -right-2 w-8 h-8 text-yellow-400 animate-ping">✨</div>
                        <div class="absolute -bottom-2 -left-2 w-8 h-8 text-blue-400 animate-ping" style="animation-delay: 0.5s;">✨</div>
                    </div>
                </div>

                {{-- Logo STAIMAS --}}
                <div class="mb-6 flex justify-center">
                    <img src="{{ asset('assest/LOGO STAIMAS 2.png') }}" alt="STAIMAS Logo" class="h-20 animate-float">
                </div>

                {{-- Title --}}
                <h1 class="text-3xl md:text-4xl font-bold text-[#8B7355] mb-3">
                    Panduan IKAMAS
                </h1>
                
                <p class="text-sm text-slate-500 uppercase tracking-widest mb-8">STAIMAS Wonogiri</p>

                {{-- Typing Animation Message --}}
                <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-2xl p-8 mb-6 border-2 border-[#1B5E20] border-opacity-20">
                    <div class="text-2xl md:text-3xl font-bold text-[#1B5E20] mb-4">
                        <span class="typing-text">Panduan masih dalam proses pembuatan...</span>
                    </div>
                    
                    <div class="flex justify-center gap-2 my-6">
                        <div class="w-3 h-3 bg-[#1B5E20] rounded-full animate-bounce"></div>
                        <div class="w-3 h-3 bg-[#1B5E20] rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                        <div class="w-3 h-3 bg-[#1B5E20] rounded-full animate-bounce" style="animation-delay: 0.4s;"></div>
                    </div>
                    
                    <p class="text-slate-600 text-base leading-relaxed">
                        Tim kami sedang menyusun panduan lengkap untuk membantu Anda menggunakan sistem IKAMAS dengan lebih mudah.
                    </p>
                </div>

                {{-- Fun Icons --}}
                <div class="flex justify-center gap-6 mb-8 text-4xl">
                    <span class="animate-bounce" style="animation-delay: 0s;">📚</span>
                    <span class="animate-bounce" style="animation-delay: 0.1s;">✏️</span>
                    <span class="animate-bounce" style="animation-delay: 0.2s;">📖</span>
                    <span class="animate-bounce" style="animation-delay: 0.3s;">🎓</span>
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6">
                    <p class="text-sm text-slate-700">
                        <span class="font-semibold">💡 Sementara ini:</span> Jika Anda memerlukan bantuan, silakan hubungi administrator IKAMAS.
                    </p>
                </div>

                {{-- Button --}}
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#1B5E20] text-white rounded-xl font-semibold hover:bg-[#145018] transition-all transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Halaman Sebelumnya
                    </a>
                    
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 border-[#1B5E20] text-[#1B5E20] rounded-xl font-semibold hover:bg-[#1B5E20] hover:text-white transition-all transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Ke Halaman Login
                    </a>
                </div>

            </div>
        </div>

        {{-- Footer --}}
        <div class="text-center mt-6 text-xs text-slate-500">
            <p>&copy; {{ date('Y') }} IKAMAS STAIMAS Wonogiri. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
