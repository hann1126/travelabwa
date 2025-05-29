<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('output.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="font-poppins text-black">
  <section id="content" class="max-w-[640px] w-full mx-auto bg-[#F9F2EF] min-h-screen">
    <div class="w-full min-h-screen flex flex-col items-center justify-center py-[46px] px-4 gap-8">

      <!-- Background Image -->
      <div class="w-[calc(100%-26px)] rounded-[20px] overflow-hidden relative">
        <img src="{{ asset('assets/backgrounds/Asset.png') }}" class="w-full h-full object-contain" alt="background">
      </div>

      <!-- Login Form -->
      <form method="POST" action="{{ route('login') }}" class="flex flex-col w-full bg-white p-6 gap-8 rounded-[22px] items-center">
        @csrf

        <div class="flex flex-col gap-1 text-center">
          <h1 class="font-semibold text-2xl leading-[42px]">Sign In</h1>
          <p class="text-sm leading-[25px] tracking-[0.6px] text-darkGrey">Welcome Back! Enter your valid data</p>
        </div>

        <div class="flex flex-col gap-4 w-full max-w-[311px]">

          <!-- Email Field -->
          <div class="flex flex-col gap-1 w-full">
            <label class="font-semibold">Email</label>
            <div class="flex items-center gap-3 p-4 border border-[#BFBFBF] rounded-xl focus-within:border-[#4D73FF] transition-all duration-300">
              <div class="w-4 h-4">
                <img src="{{ asset('assets/icons/sms.svg') }}" alt="email icon">
              </div>
              <input type="email" name="email" required class="w-full outline-none text-sm placeholder-[#BFBFBF]" placeholder="Your email address">
            </div>
          </div>

          <!-- Password Field -->
          <div class="flex flex-col gap-1 w-full">
            <label class="font-semibold">Password</label>
            <div class="flex items-center gap-3 p-4 border border-[#BFBFBF] rounded-xl focus-within:border-[#4D73FF] transition-all duration-300">
              <div class="w-4 h-4">
                <img src="{{ asset('assets/icons/password-lock.svg') }}" alt="password icon">
              </div>
              <input type="password" name="password" required class="w-full outline-none text-sm placeholder-[#BFBFBF]" placeholder="Enter your password">
            </div>
          </div>

        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-[#4D73FF] px-6 py-4 w-full max-w-[311px] rounded-[10px] text-white font-semibold hover:bg-[#06C755] transition-all duration-300">
          Sign In
        </button>

        <p class="text-sm text-center text-darkGrey">Don’t have an account? 
          <a href="{{route('register')}}" class="text-[#4D73FF] font-semibold">Sign Up</a>
        </p>

      </form>
    </div>
  </section>
</body>
</html>
