<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - LKPD App</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
      font-family: 'Poppins', sans-serif;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .gradient-bg-reverse {
      background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    .card-hover {
      transition: all 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .modal-animation {
      animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }
      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    .table-row-hover:hover {
      background-color: #f8fafc;
    }

    .mobile-menu {
      transition: all 0.3s ease;
      max-height: 0;
      overflow: hidden;
    }

    .mobile-menu.open {
      max-height: 500px;
    }

    .dropdown-menu {
      transition: all 0.3s ease;
      opacity: 0;
      transform: translateY(-10px);
      pointer-events: none;
    }

    .dropdown-menu.show {
      opacity: 1;
      transform: translateY(0);
      pointer-events: auto;
    }

    .nav-link {
      position: relative;
      color: white;
      transition: all 0.3s ease;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background: white;
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    .nav-link:hover::after,
    .nav-link.active::after {
      width: 80%;
    }

    .nav-link.active {
      background-color: rgba(255, 255, 255, 0.15);
    }

    .hamburger-line {
      transition: all 0.3s ease;
    }

    .hamburger.active .hamburger-line:nth-child(1) {
      transform: rotate(45deg) translate(6px, 6px);
    }

    .hamburger.active .hamburger-line:nth-child(2) {
      opacity: 0;
    }

    .hamburger.active .hamburger-line:nth-child(3) {
      transform: rotate(-45deg) translate(6px, -6px);
    }

    .notification-badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background: #ef4444;
      color: white;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      font-size: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .search-bar {
      transition: all 0.3s ease;
      width: 200px;
    }

    .search-bar:focus {
      width: 300px;
    }

    .nav-shadow {
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Dashboard Specific Styles */
    .dashboard-card {
      background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
      border: 1px solid rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .dashboard-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(102, 126, 234, 0.15);
    }

    .progress-bar {
      transition: width 1.5s cubic-bezier(0.22, 0.61, 0.36, 1);
    }

    .stats-icon {
      transition: all 0.3s ease;
    }

    .stats-card:hover .stats-icon {
      transform: scale(1.1);
    }

    .quick-action-card {
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .quick-action-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .quick-action-card:hover::before {
      transform: scaleX(1);
    }

    .quick-action-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .activity-item {
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
    }

    .activity-item:hover {
      border-left-color: #667eea;
      background-color: #f8fafc;
    }

    .welcome-section {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      position: relative;
      overflow: hidden;
    }

    .welcome-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .animate-fade-in {
      animation: fadeIn 0.6s ease-in-out;
    }

    .animate-slide-up {
      animation: slideUp 0.5s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body class="bg-gray-50">
  <!-- Navigation -->
  <nav class="gradient-bg nav-shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <!-- Logo & Brand -->
        <div class="flex items-center">
          <div class="flex-shrink-0 flex items-center">
            <div class="bg-white p-2 rounded-lg mr-3">
              <i class="fas fa-book-open text-indigo-600 text-xl"></i>
            </div>
            <span class="text-white font-bold text-xl">LKPD <span class="text-yellow-300">App</span></span>
          </div>

          <!-- Desktop Navigation -->
          <div class="hidden md:ml-10 md:flex md:space-x-1">
            <a href="/" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center active">
              <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            @auth
              @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.laporan.index') }}"
                   class="nav-link flex items-center gap-2 rounded-lg px-4 py-2">
                  <i class="fas fa-file-alt"></i>
                  <span>Semua Laporan</span>
                </a>
              @else
                <a href="{{ route('laporan.index') }}"
                   class="nav-link flex items-center gap-2 rounded-lg px-4 py-2">
                  <i class="fas fa-file-alt"></i>
                  <span>Laporan Saya</span>
                </a>
              @endif
            @endauth

            <a href="{{ route('quiz.index') }}" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center">
              <i class="fas fa-question-circle mr-2"></i> Kuis
            </a>
                     <a href="{{ route('reflections.index') }}" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center">
              <i class="fas fa-lightbulb mr-2"></i> Refleksi
            </a>

            @auth
              @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.users.index') }}" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center">
                  <i class="fas fa-users mr-2"></i> Kelola User
                </a>
                <a href="{{ route('admin.quiz.index') }}" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center">
                  <i class="fas fa-tasks mr-2"></i> Kelola Quiz
                </a>
              @endif
            @endauth
          </div>
        </div>

        <!-- Right Section: Search & User Menu -->
        <div class="flex items-center space-x-4">

          <!-- User Menu -->
          <div class="hidden md:block relative">
            <button id="user-menu-button" class="bg-white/20 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-white/30 transition duration-300 flex items-center">
              <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center mr-2">
                <i class="fas fa-user text-white"></i>
              </div>
              @auth
                {{ Auth::user()->name }}
              @else
                Guest
              @endauth
              <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-300" id="user-arrow"></i>
            </button>

            <!-- Dropdown menu -->
            <div id="user-dropdown" class="dropdown-menu absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-100">
              @auth
                <div class="px-4 py-3 border-b border-gray-100">
                  <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                  <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-200 flex items-center">
                  <i class="fas fa-user-circle mr-3 text-gray-400"></i> Profil Saya
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-200 flex items-center">
                  <i class="fas fa-cog mr-3 text-gray-400"></i> Pengaturan
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition duration-200 flex items-center">
                  <i class="fas fa-bell mr-3 text-gray-400"></i> Notifikasi
                </a>
                <div class="border-t border-gray-100 my-1"></div>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition duration-200 flex items-center">
                    <i class="fas fa-sign-out-alt mr-3"></i> Keluar
                  </button>
                </form>
              @else
                <a href="{{ route('login') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition duration-200 flex items-center">
                  <i class="fas fa-sign-in-alt mr-3 text-gray-400"></i> Masuk
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 transition duration-200 flex items-center">
                  <i class="fas fa-user-plus mr-3 text-gray-400"></i> Daftar
                </a>
              @endauth
            </div>
          </div>

          <!-- Mobile menu button -->
          <div class="md:hidden flex items-center">
            <button id="mobile-menu-button" class="hamburger text-white hover:bg-white/20 p-2 rounded-md transition duration-300 flex flex-col justify-center items-center w-10 h-10">
              <span class="hamburger-line block w-6 h-0.5 bg-white mb-1.5"></span>
              <span class="hamburger-line block w-6 h-0.5 bg-white mb-1.5"></span>
              <span class="hamburger-line block w-6 h-0.5 bg-white"></span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="mobile-menu md:hidden bg-indigo-800 px-4 pt-2 pb-4 space-y-1">

      <a href="/" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center bg-white/20">
        <i class="fas fa-home mr-3 w-5 text-center"></i> Dashboard
      </a>
      <a href="{{ route('laporan.create') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
        <i class="fas fa-file-alt mr-3 w-5 text-center"></i> Laporan
      </a>
      <a href="{{ route('quiz.index') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
        <i class="fas fa-question-circle mr-3 w-5 text-center"></i> Kuis
      </a>
      <a href="{{ route('reflections.index') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
        <i class="fas fa-lightbulb mr-3 w-5 text-center"></i> Refleksi
      </a>
      @auth
        @if(Auth::user()->role == 'admin')
          <a href="{{ route('admin.users.index') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
            <i class="fas fa-users mr-3 w-5 text-center"></i> Kelola User
          </a>
          <a href="{{ route('admin.quiz.index') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
            <i class="fas fa-tasks mr-3 w-5 text-center"></i> Kelola Quiz
          </a>
        @endif
      @endauth

      <div class="pt-4 border-t border-indigo-700 mt-4">
        @auth
          <div class="px-3 py-3 text-white flex items-center">
            <div class="w-8 h-8 bg-white/30 rounded-full flex items-center justify-center mr-3">
              <i class="fas fa-user text-white text-sm"></i>
            </div>
            <div>
              <p class="font-medium">{{ Auth::user()->name }}</p>
              <p class="text-sm text-indigo-200">{{ Auth::user()->email }}</p>
            </div>
          </div>
          <a href="#" class="block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
            <i class="fas fa-user-circle mr-3 w-5 text-center"></i> Profil Saya
          </a>
          <a href="#" class="block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
            <i class="fas fa-cog mr-3 w-5 text-center"></i> Pengaturan
          </a>
          <a href="#" class="block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
            <i class="fas fa-bell mr-3 w-5 text-center"></i> Notifikasi
            <span class="ml-auto bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
              <i class="fas fa-sign-out-alt mr-3 w-5 text-center"></i> Keluar
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
            <i class="fas fa-sign-in-alt mr-3 w-5 text-center"></i> Masuk
          </a>
          {{-- <a href="{{ route('register') }}" class="block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center">
            <i class="fas fa-user-plus mr-3 w-5 text-center"></i> Daftar
          </a> --}}
        @endauth
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Welcome Section -->
    <div class="welcome-section rounded-2xl shadow-xl overflow-hidden mb-8 animate-fade-in relative">
      <div class="absolute top-0 right-0 w-64 h-64 -mt-32 -mr-32 bg-white/10 rounded-full"></div>
      <div class="absolute bottom-0 left-0 w-48 h-48 -mb-24 -ml-24 bg-white/10 rounded-full"></div>

      <div class="relative px-6 py-8 md:py-12 text-center">
        <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold mb-4 text-white">Selamat Datang di <span class="text-yellow-300">LKPD App</span></h1>
        <p class="text-base md:text-lg opacity-90 mb-6 text-white/90 max-w-2xl mx-auto">Platform pembelajaran interaktif untuk siswa RPL dengan fitur laporan, kuis, dan refleksi pembelajaran.</p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
          <a href="{{ route('laporan.create') }}" class="px-6 py-3 bg-white text-indigo-700 font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center hover:scale-105">
            <i class="fas fa-file-alt mr-2"></i> Mulai Laporan
          </a>
          <a href="{{ route('quiz.index') }}" class="px-6 py-3 bg-white/20 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center hover:scale-105 border border-white/30">
            <i class="fas fa-question-circle mr-2"></i> Ikuti Kuis
          </a>
        </div>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
      <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.1s">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-blue-100 rounded-xl p-4 stats-icon">
            <i class="fas fa-file-alt text-blue-600 text-2xl"></i>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm font-medium text-gray-500 truncate">Total Laporan</dt>
              <dd class="text-2xl font-bold text-gray-900">{{ $laporanCount ?? '12' }}</dd>
            </dl>
            <div class="mt-1">
              <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                <i class="fas fa-arrow-up mr-1"></i> 2 baru
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.2s">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-green-100 rounded-xl p-4 stats-icon">
            <i class="fas fa-question-circle text-green-600 text-2xl"></i>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm font-medium text-gray-500 truncate">Hasil Kuis</dt>
              <dd class="text-2xl font-bold text-gray-900">{{ $quizCount ?? '8' }}</dd>
            </dl>
            <div class="mt-1">
              <span class="text-xs font-medium text-blue-500 bg-blue-50 px-2 py-1 rounded-full">
                <i class="fas fa-chart-line mr-1"></i> 85% rata-rata
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.3s">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-purple-100 rounded-xl p-4 stats-icon">
            <i class="fas fa-lightbulb text-purple-600 text-2xl"></i>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm font-medium text-gray-500 truncate">Refleksi</dt>
              <dd class="text-2xl font-bold text-gray-900">{{ $reflectionCount ?? '5' }}</dd>
            </dl>
            <div class="mt-1">
              <span class="text-xs font-medium text-purple-500 bg-purple-50 px-2 py-1 rounded-full">
                <i class="fas fa-pen mr-1"></i> 1 belum dinilai
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.4s">
        <div class="flex items-center">
          <div class="flex-shrink-0 bg-yellow-100 rounded-xl p-4 stats-icon">
            <i class="fas fa-trophy text-yellow-600 text-2xl"></i>
          </div>
          <div class="ml-5 w-0 flex-1">
            <dl>
              <dt class="text-sm font-medium text-gray-500 truncate">Pencapaian</dt>
              <dd class="text-2xl font-bold text-gray-900">7/10</dd>
            </dl>
            <div class="mt-1">
              <span class="text-xs font-medium text-yellow-500 bg-yellow-50 px-2 py-1 rounded-full">
                <i class="fas fa-star mr-1"></i> 70% selesai
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
      <!-- Left Column - Features -->
      <div class="lg:col-span-2">
        <!-- Feature Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <!-- Card Laporan -->
          <div class="dashboard-card rounded-2xl shadow-medium p-6 card-hover animate-slide-up" style="animation-delay: 0.5s">
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-xl mr-4">
                  <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Laporan</h3>
              </div>
              <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">{{ $laporanCount ?? '12' }} data</span>
            </div>
            <p class="text-gray-600 mb-4">Isi form laporan konfigurasi jaringan dengan validasi otomatis dan panduan langkah demi langkah.</p>
            <a href="{{ route('laporan.create') }}" class="inline-flex items-center text-blue-600 font-semibold hover:underline group">
              Isi Laporan
              <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
          </div>

          <!-- Card Kuis -->
          <div class="dashboard-card rounded-2xl shadow-medium p-6 card-hover animate-slide-up" style="animation-delay: 0.6s">
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-xl mr-4">
                  <i class="fas fa-question-circle text-green-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Kuis Online</h3>
              </div>
              <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">{{ $quizCount ?? '8' }} hasil</span>
            </div>
            <p class="text-gray-600 mb-4">Uji pemahaman tentang dynamic routing dengan kuis interaktif dan skor otomatis.</p>
            <a href="{{ route('quiz.index') }}" class="inline-flex items-center text-green-600 font-semibold hover:underline group">
              Ikuti Kuis
              <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
          </div>

          <!-- Card Refleksi -->
          <div class="dashboard-card rounded-2xl shadow-medium p-6 card-hover animate-slide-up" style="animation-delay: 0.7s">
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center">
                <div class="bg-purple-100 p-3 rounded-xl mr-4">
                  <i class="fas fa-lightbulb text-purple-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Refleksi</h3>
              </div>
              <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm font-medium">{{ $reflectionCount ?? '5' }} tulisan</span>
            </div>
            <p class="text-gray-600 mb-4">Tulis pendapat atau refleksi terkait materi routing & web untuk meningkatkan pemahaman.</p>
            <a href="{{ route('reflections.index') }}" class="inline-flex items-center text-purple-600 font-semibold hover:underline group">
              Tulis Refleksi
              <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
          </div>

          <!-- Card Progress -->
          <div class="dashboard-card rounded-2xl shadow-medium p-6 card-hover animate-slide-up" style="animation-delay: 0.8s">
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center">
                <div class="bg-orange-100 p-3 rounded-xl mr-4">
                  <i class="fas fa-chart-line text-orange-600 text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Progress</h3>
              </div>
              <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm font-medium">75%</span>
            </div>
            <p class="text-gray-600 mb-4">Pantau perkembangan belajar Anda dengan statistik dan grafik progress yang detail.</p>
            <a href="#" class="inline-flex items-center text-orange-600 font-semibold hover:underline group">
              Lihat Progress
              <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
          </div>
        </div>

        <!-- Progress Section -->
        <div class="bg-white rounded-2xl shadow-medium p-6 animate-slide-up" style="animation-delay: 0.9s">
          <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-chart-line text-blue-500 mr-3"></i> Progress Pembelajaran
          </h2>

          <div class="space-y-6">
            <div>
              <div class="flex justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Laporan Jaringan</span>
                <span class="text-sm font-medium text-gray-700">75%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full progress-bar" style="width: 75%"></div>
              </div>
            </div>

            <div>
              <div class="flex justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Dynamic Routing</span>
                <span class="text-sm font-medium text-gray-700">60%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-green-600 h-3 rounded-full progress-bar" style="width: 60%"></div>
              </div>
            </div>

            <div>
              <div class="flex justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Konfigurasi Web</span>
                <span class="text-sm font-medium text-gray-700">45%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-purple-600 h-3 rounded-full progress-bar" style="width: 45%"></div>
              </div>
            </div>

            <div>
              <div class="flex justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Troubleshooting</span>
                <span class="text-sm font-medium text-gray-700">30%</span>
              </div>
              <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-yellow-500 h-3 rounded-full progress-bar" style="width: 30%"></div>
              </div>
            </div>
          </div>

          <div class="mt-6 pt-6 border-t border-gray-200">
            <a href="#" class="text-blue-600 font-medium hover:underline flex items-center group">
              Lihat detail progress
              <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- Right Column - Activity & Quick Actions -->
      <div class="space-y-8">
        <!-- Recent Activity -->
        <div class="bg-white rounded-2xl shadow-medium p-6 animate-slide-up" style="animation-delay: 1s">
          <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-history text-green-500 mr-3"></i> Aktivitas Terbaru
          </h2>

          <div class="space-y-4">
            <div class="activity-item p-3 rounded-lg border border-gray-100 hover:shadow-sm transition-all duration-300">
              <div class="flex items-start">
                <div class="bg-blue-100 p-2 rounded-lg mr-3">
                  <i class="fas fa-file-alt text-blue-600"></i>
                </div>
                <div>
                  <p class="font-medium text-gray-800">Laporan konfigurasi router selesai</p>
                  <p class="text-sm text-gray-500">2 jam yang lalu</p>
                </div>
              </div>
            </div>

            <div class="activity-item p-3 rounded-lg border border-gray-100 hover:shadow-sm transition-all duration-300">
              <div class="flex items-start">
                <div class="bg-green-100 p-2 rounded-lg mr-3">
                  <i class="fas fa-check-circle text-green-600"></i>
                </div>
                <div>
                  <p class="font-medium text-gray-800">Kuis Dynamic routing diselesaikan</p>
                  <p class="text-sm text-gray-500">Kemarin, 14:30</p>
                </div>
              </div>
            </div>

            <div class="activity-item p-3 rounded-lg border border-gray-100 hover:shadow-sm transition-all duration-300">
              <div class="flex items-start">
                <div class="bg-purple-100 p-2 rounded-lg mr-3">
                  <i class="fas fa-lightbulb text-purple-600"></i>
                </div>
                <div>
                  <p class="font-medium text-gray-800">Refleksi tentang OSPF dipublikasikan</p>
                  <p class="text-sm text-gray-500">2 hari yang lalu</p>
                </div>
              </div>
            </div>

            <div class="activity-item p-3 rounded-lg border border-gray-100 hover:shadow-sm transition-all duration-300">
              <div class="flex items-start">
                <div class="bg-yellow-100 p-2 rounded-lg mr-3">
                  <i class="fas fa-trophy text-yellow-600"></i>
                </div>
                <div>
                  <p class="font-medium text-gray-800">Mencapai nilai tertinggi di kuis mingguan</p>
                  <p class="text-sm text-gray-500">3 hari yang lalu</p>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-6 pt-6 border-t border-gray-200">
            <a href="#" class="text-green-600 font-medium hover:underline flex items-center group">
              Lihat semua aktivitas
              <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-2xl shadow-medium p-6 animate-slide-up" style="animation-delay: 1.1s">
          <h2 class="text-xl font-bold text-gray-800 mb-6">Aksi Cepat</h2>
          <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('laporan.create') }}" class="quick-action-card p-4 rounded-xl bg-blue-50 flex flex-col items-center justify-center text-center">
              <i class="fas fa-plus-circle text-blue-600 text-2xl mb-2"></i>
              <p class="font-medium text-gray-800 text-sm">Buat Laporan</p>
            </a>

            <a href="{{ route('quiz.index') }}" class="quick-action-card p-4 rounded-xl bg-green-50 flex flex-col items-center justify-center text-center">
              <i class="fas fa-play-circle text-green-600 text-2xl mb-2"></i>
              <p class="font-medium text-gray-800 text-sm">Mulai Kuis</p>
            </a>

            <a href="{{ route('reflections.index') }}" class="quick-action-card p-4 rounded-xl bg-purple-50 flex flex-col items-center justify-center text-center">
              <i class="fas fa-edit text-purple-600 text-2xl mb-2"></i>
              <p class="font-medium text-gray-800 text-sm">Tulis Refleksi</p>
            </a>

            <a href="#" class="quick-action-card p-4 rounded-xl bg-yellow-50 flex flex-col items-center justify-center text-center">
              <i class="fas fa-chart-bar text-yellow-600 text-2xl mb-2"></i>
              <p class="font-medium text-gray-800 text-sm">Lihat Statistik</p>
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-white border-t border-gray-200 mt-12">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <div class="md:flex md:items-center md:justify-between">
        <div class="flex justify-center md:justify-start">
          <div class="flex-shrink-0 flex items-center">
            <i class="fas fa-book-open text-indigo-600 text-xl mr-2"></i>
            <span class="text-gray-800 font-bold">LKPD App</span>
          </div>
        </div>
        <div class="mt-4 md:mt-0 md:order-1">
          <p class="text-center text-sm text-gray-500">
            &copy; 2025 LKPD App. By Ario Adiyoso.
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      const mobileMenu = document.getElementById('mobile-menu');
      const hamburger = document.getElementById('mobile-menu-button');

      mobileMenu.classList.toggle('open');
      hamburger.classList.toggle('active');
    });

    // User dropdown toggle
    document.getElementById('user-menu-button').addEventListener('click', function() {
      const dropdown = document.getElementById('user-dropdown');
      const arrow = document.getElementById('user-arrow');

      dropdown.classList.toggle('show');
      arrow.classList.toggle('rotate-180');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const userMenuButton = document.getElementById('user-menu-button');
      const dropdown = document.getElementById('user-dropdown');

      if (!userMenuButton.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove('show');
        document.getElementById('user-arrow').classList.remove('rotate-180');
      }
    });

    // Highlight active navigation link
    document.addEventListener('DOMContentLoaded', function() {
      const currentPath = window.location.pathname;

      // Desktop links
      const navLinks = document.querySelectorAll('.nav-link');
      navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          link.classList.add('active');
        }
      });

      // Mobile links
      const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
      mobileNavLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          link.classList.add('bg-white/20');
        }
      });

      // Animasi progress bars saat halaman dimuat
      const progressBars = document.querySelectorAll('.progress-bar');
      progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
          bar.style.width = width;
        }, 500);
      });

      // Staggered animation for cards
      const cards = document.querySelectorAll('.animate-slide-up');
      cards.forEach((card, index) => {
        card.style.animationDelay = `${0.1 * index}s`;
      });
    });

    // Add rotation class for Tailwind
    const style = document.createElement('style');
    style.textContent = `
      .rotate-180 {
        transform: rotate(180deg);
      }
    `;
    document.head.appendChild(style);
  </script>

  @yield('scripts')
</body>
</html>
