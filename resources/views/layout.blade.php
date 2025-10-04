<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'LKPD App')</title>
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
            <a href="/" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center {{ request()->is('/') ? 'active' : '' }}">
              <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            @auth
              @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.laporan.index') }}"
                   class="nav-link flex items-center gap-2 rounded-lg px-4 py-2 {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                  <i class="fas fa-file-alt"></i>
                  <span>Semua Laporan</span>
                </a>
              @else
                <a href="{{ route('laporan.index') }}"
                   class="nav-link flex items-center gap-2 rounded-lg px-4 py-2 {{ request()->is('laporan*') ? 'active' : '' }}">
                  <i class="fas fa-file-alt"></i>
                  <span>Laporan Saya</span>
                </a>
              @endif
            @endauth


            <a href="{{ route('quiz.index') }}" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center {{ request()->is('quiz*') ? 'active' : '' }}">
              <i class="fas fa-question-circle mr-2"></i> Kuis
            </a>
                     <a href="{{ route('reflections.index') }}" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center {{ request()->is('reflections*') ? 'active' : '' }}">
              <i class="fas fa-lightbulb mr-2"></i> Refleksi
            </a>


            @auth
              @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.users.index') }}" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center {{ request()->is('admin/users*') ? 'active' : '' }}">
                  <i class="fas fa-users mr-2"></i> Kelola User
                </a>
                <a href="{{ route('admin.quiz.index') }}" class="nav-link px-4 py-2 rounded-md text-sm font-medium transition duration-300 flex items-center {{ request()->is('admin/quiz*') ? 'active' : '' }}">
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

      <a href="/" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center {{ request()->is('/') ? 'bg-white/20' : '' }}">
        <i class="fas fa-home mr-3 w-5 text-center"></i> Dashboard
      </a>
      <a href="{{ route('laporan.create') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center {{ request()->is('laporan*') ? 'bg-white/20' : '' }}">
        <i class="fas fa-file-alt mr-3 w-5 text-center"></i> Laporan
      </a>
      <a href="{{ route('quiz.index') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center {{ request()->is('quiz*') ? 'bg-white/20' : '' }}">
        <i class="fas fa-question-circle mr-3 w-5 text-center"></i> Kuis
      </a>
      <a href="{{ route('reflections.index') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center {{ request()->is('refleksi*') ? 'bg-white/20' : '' }}">
        <i class="fas fa-lightbulb mr-3 w-5 text-center"></i> Refleksi
      </a>
      @auth
        @if(Auth::user()->role == 'admin')
          <a href="{{ route('admin.users.index') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center {{ request()->is('admin/users*') ? 'bg-white/20' : '' }}">
            <i class="fas fa-users mr-3 w-5 text-center"></i> Kelola User
          </a>
          <a href="{{ route('admin.quiz.index') }}" class="mobile-nav-link block px-3 py-3 rounded-lg text-base font-medium text-white hover:bg-white/10 transition duration-200 flex items-center {{ request()->is('admin/quiz*') ? 'bg-white/20' : '' }}">
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
    @yield('content')
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
