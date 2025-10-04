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
  </style>
</head>
<body class="bg-gray-50">
  <!-- Navigation -->
  <nav class="gradient-bg shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0 flex items-center">
            <i class="fas fa-book-open text-white text-2xl mr-2"></i>
            <span class="text-white font-bold text-xl">LKPD App</span>
          </div>
          <div class="hidden md:ml-6 md:flex md:space-x-4">
            <a href="/" class="nav-link {{ request()->is('/') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }}">
              <i class="fas fa-home mr-1"></i> Dashboard
            </a>
            <a href="{{ route('laporan.create') }}" class="nav-link {{ request()->is('laporan*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }}">
              <i class="fas fa-file-alt mr-1"></i> Laporan
            </a>
            <a href="{{ route('quiz.index') }}" class="nav-link {{ request()->is('quiz*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }}">
              <i class="fas fa-question-circle mr-1"></i> Kuis
            </a>
            <a href="{{ route('refleksi.index') }}" class="nav-link {{ request()->is('refleksi*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }}">
              <i class="fas fa-lightbulb mr-1"></i> Refleksi
            </a>
            @auth
              @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }}">
                  <i class="fas fa-users mr-1"></i> Kelola User
                </a>
                <a href="{{ route('admin.quiz.index') }}" class="nav-link {{ request()->is('admin/quiz*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }}">
                  <i class="fas fa-tasks mr-1"></i> Kelola Quiz
                </a>
              @endif
            @endauth
          </div>
        </div>

        <!-- Mobile menu button -->
        <div class="md:hidden flex items-center">
          <button id="mobile-menu-button" class="text-white hover:bg-indigo-500 px-3 py-2 rounded-md text-sm font-medium transition duration-300">
            <i class="fas fa-bars"></i>
          </button>
        </div>

        <div class="hidden md:flex items-center">
          <div class="flex-shrink-0 relative">
            <button id="user-menu-button" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition duration-300 flex items-center">
              <i class="fas fa-user mr-1"></i>
              @auth
                {{ Auth::user()->name }}
              @else
                Guest
              @endauth
              <i class="fas fa-chevron-down ml-2 text-xs"></i>
            </button>

            <!-- Dropdown menu -->
            <div id="user-dropdown" class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
              @auth
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-user-circle mr-2"></i> Profil Saya
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-cog mr-2"></i> Pengaturan
                </a>
                <div class="border-t border-gray-200"></div>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                  </button>
                </form>
              @else
                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-sign-in-alt mr-2"></i> Masuk
                </a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                  <i class="fas fa-user-plus mr-2"></i> Daftar
                </a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="mobile-menu md:hidden hidden bg-indigo-800 px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <a href="/" class="mobile-nav-link {{ request()->is('/') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }} block px-3 py-2 rounded-md text-base font-medium text-white">
        <i class="fas fa-home mr-2"></i> Dashboard
      </a>
      <a href="{{ route('laporan.create') }}" class="mobile-nav-link {{ request()->is('laporan*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }} block px-3 py-2 rounded-md text-base font-medium text-white">
        <i class="fas fa-file-alt mr-2"></i> Laporan
      </a>
      <a href="{{ route('quiz.index') }}" class="mobile-nav-link {{ request()->is('quiz*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }} block px-3 py-2 rounded-md text-base font-medium text-white">
        <i class="fas fa-question-circle mr-2"></i> Kuis
      </a>
      <a href="{{ route('refleksi.index') }}" class="mobile-nav-link {{ request()->is('refleksi*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }} block px-3 py-2 rounded-md text-base font-medium text-white">
        <i class="fas fa-lightbulb mr-2"></i> Refleksi
      </a>
      @auth
        @if(Auth::user()->role == 'admin')
          <a href="{{ route('admin.users.index') }}" class="mobile-nav-link {{ request()->is('admin/users*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }} block px-3 py-2 rounded-md text-base font-medium text-white">
            <i class="fas fa-users mr-2"></i> Kelola User
          </a>
          <a href="{{ route('admin.quiz.index') }}" class="mobile-nav-link {{ request()->is('admin/quiz*') ? 'bg-indigo-700' : 'hover:bg-indigo-500' }} block px-3 py-2 rounded-md text-base font-medium text-white">
            <i class="fas fa-tasks mr-2"></i> Kelola Quiz
          </a>
        @endif
      @endauth

      <div class="pt-4 border-t border-indigo-700">
        @auth
          <div class="px-3 py-2 text-white">
            <i class="fas fa-user mr-2"></i> {{ Auth::user()->name }}
          </div>
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-500">
            <i class="fas fa-user-circle mr-2"></i> Profil Saya
          </a>
          <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-500">
            <i class="fas fa-cog mr-2"></i> Pengaturan
          </a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-500">
              <i class="fas fa-sign-out-alt mr-2"></i> Keluar
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-500">
            <i class="fas fa-sign-in-alt mr-2"></i> Masuk
          </a>
          <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-indigo-500">
            <i class="fas fa-user-plus mr-2"></i> Daftar
          </a>
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
            &copy; 2023 LKPD App. All rights reserved.
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      const mobileMenu = document.getElementById('mobile-menu');
      mobileMenu.classList.toggle('hidden');
    });

    // User dropdown toggle
    document.getElementById('user-menu-button').addEventListener('click', function() {
      const dropdown = document.getElementById('user-dropdown');
      dropdown.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const userMenuButton = document.getElementById('user-menu-button');
      const dropdown = document.getElementById('user-dropdown');

      if (!userMenuButton.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.remove('show');
      }
    });

    // Highlight active navigation link
    document.addEventListener('DOMContentLoaded', function() {
      const currentPath = window.location.pathname;

      // Desktop links
      const navLinks = document.querySelectorAll('.nav-link');
      navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          link.classList.add('bg-indigo-700');
        } else {
          link.classList.remove('bg-indigo-700');
        }
      });

      // Mobile links
      const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
      mobileNavLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
          link.classList.add('bg-indigo-700');
        } else {
          link.classList.remove('bg-indigo-700');
        }
      });
    });
  </script>

  @yield('scripts')
</body>
</html>
