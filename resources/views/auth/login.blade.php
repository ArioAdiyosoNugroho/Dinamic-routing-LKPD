<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - LKPD App</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#667eea',
            secondary: '#764ba2',
          },
          animation: {
            'pulse-delay-2000': 'pulse 2s ease-in-out 2s infinite',
            'pulse-delay-4000': 'pulse 2s ease-in-out 4s infinite',
          }
        }
      }
    }
  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    * {
      font-family: 'Inter', sans-serif;
    }

    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .gradient-text {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .floating {
      animation: floating 6s ease-in-out infinite;
    }

    @keyframes floating {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .pulse-glow {
      animation: pulse-glow 2s ease-in-out infinite alternate;
    }

    @keyframes pulse-glow {
      from { box-shadow: 0 0 20px rgba(102, 126, 234, 0.5); }
      to { box-shadow: 0 0 30px rgba(102, 126, 234, 0.8); }
    }

    .slide-in {
      animation: slideIn 0.8s ease-out forwards;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .typewriter {
      overflow: hidden;
      border-right: .15em solid #667eea;
      white-space: nowrap;
      margin: 0 auto;
      animation:
        typing 3.5s steps(40, end),
        blink-caret .75s step-end infinite;
    }

    @keyframes typing {
      from { width: 0 }
      to { width: 100% }
    }

    @keyframes blink-caret {
      from, to { border-color: transparent }
      50% { border-color: #667eea; }
    }

    .input-focus:focus {
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-hover {
      transition: all 0.3s ease;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .btn-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }
  </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center py-8 px-4">
  <!-- Background Elements -->
  <div class="fixed inset-0 overflow-hidden -z-10">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-indigo-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse-delay-2000"></div>
    <div class="absolute top-40 left-1/2 w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse-delay-4000"></div>
  </div>

  <!-- Main Content -->
  <div class="relative z-10 w-full max-w-6xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

      <!-- Left Side - Welcome & Motivation -->
      <div class="text-center lg:text-left space-y-6 lg:space-y-8">
        <!-- Logo & App Name -->
        <div class="flex items-center justify-center lg:justify-start space-x-3 mb-6 lg:mb-8">
          <div class="w-12 h-12 gradient-bg rounded-xl flex items-center justify-center shadow-lg">
            <i class="fas fa-graduation-cap text-white text-xl"></i>
          </div>
          <h1 class="text-2xl lg:text-3xl font-bold gradient-text">LKPD App</h1>
        </div>

        <!-- Welcome Message -->
        <div class="space-y-4">
          <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-gray-800 leading-tight">
            Selamat Datang di
            <span class="gradient-text">Platform Belajar Interaktif</span>
          </h2>
          <p class="text-lg lg:text-xl text-gray-600 max-w-lg mx-auto lg:mx-0">
            Mari mulai perjalanan belajar yang menyenangkan dengan quiz, refleksi, dan materi pembelajaran yang menarik.
          </p>
        </div>

        <!-- Features List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-md mx-auto lg:mx-0">
          <div class="flex items-center space-x-3 p-3 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
              <i class="fas fa-brain text-green-600"></i>
            </div>
            <span class="text-gray-700 font-medium">Quiz Interaktif</span>
          </div>
          <div class="flex items-center space-x-3 p-3 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
              <i class="fas fa-chart-line text-blue-600"></i>
            </div>
            <span class="text-gray-700 font-medium">Track Progress</span>
          </div>
          <div class="flex items-center space-x-3 p-3 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
              <i class="fas fa-trophy text-purple-600"></i>
            </div>
            <span class="text-gray-700 font-medium">Achievements</span>
          </div>
          <div class="flex items-center space-x-3 p-3 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
              <i class="fas fa-users text-indigo-600"></i>
            </div>
            <span class="text-gray-700 font-medium">Komunitas</span>
          </div>
        </div>

        <!-- Motivational Quote -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl p-4 lg:p-6 text-white shadow-xl mt-6 lg:mt-8">
          <div class="flex items-start space-x-4">
            <div class="flex-shrink-0 w-10 h-10 lg:w-12 lg:h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
              <i class="fas fa-quote-left text-white text-lg"></i>
            </div>
            <div>
              <p class="text-base lg:text-lg font-medium italic">
                "Pendidikan adalah senjata paling ampuh yang bisa kamu gunakan untuk mengubah dunia."
              </p>
              <p class="text-indigo-100 mt-2">- Nelson Mandela</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Side - Login Form -->
      <div class="flex justify-center lg:justify-end">
        <div class="w-full max-w-md">
          <div class="bg-white rounded-2xl lg:rounded-3xl shadow-lg lg:shadow-2xl p-6 lg:p-8 border border-gray-100 transform hover:scale-105 transition-all duration-500 slide-in">
            <!-- Form Header -->
            <div class="text-center mb-6 lg:mb-8">
              <h3 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Masuk ke Akun Anda</h3>
              <p class="text-gray-600 text-sm lg:text-base">Silakan masuk untuk melanjutkan pembelajaran</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.post') }}" class="space-y-4 lg:space-y-6" id="loginForm">
              @csrf

              <!-- Username Field -->
              <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 flex items-center">
                  <i class="fas fa-user mr-2 text-indigo-500"></i>
                  Nama Pengguna
                </label>
                <div class="relative">
                  <input
                    type="text"
                    name="name"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 input-focus"
                    placeholder="Masukkan nama pengguna"
                    id="username"
                  >
                  <div class="absolute right-3 top-3 text-gray-400">
                    <i class="fas fa-check-circle hidden text-green-500" id="username-valid"></i>
                  </div>
                </div>
              </div>

              <!-- Password Field -->
              <div class="space-y-2">
                <label class="text-sm font-medium text-gray-700 flex items-center">
                  <i class="fas fa-lock mr-2 text-indigo-500"></i>
                  Kata Sandi
                </label>
                <div class="relative">
                  <input
                    type="password"
                    name="password"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 input-focus"
                    placeholder="Masukkan kata sandi"
                    id="password"
                  >
                  <button type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600" id="togglePassword">
                    <i class="fas fa-eye"></i>
                  </button>
                </div>
              </div>

              <!-- Remember Me & Forgot Password -->
              <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-2 sm:space-y-0">
                <div class="flex items-center">
                  <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                  <label for="remember" class="ml-2 text-sm text-gray-700">Ingat saya</label>
                </div>
                <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">Lupa kata sandi?</a>
              </div>

              <!-- Submit Button -->
              <button
                type="submit"
                class="w-full py-3 px-4 text-white font-semibold rounded-xl shadow-lg btn-hover transition-all duration-300 transform hover:scale-105 flex items-center justify-center"
                id="loginButton"
              >
                <i class="fas fa-sign-in-alt mr-2"></i>
                <span>Masuk</span>
                <i class="fas fa-spinner fa-spin ml-2 hidden" id="loadingIcon"></i>
              </button>

              <!-- Divider -->
              <div class="relative flex items-center justify-center my-4 lg:my-6">
                <div class="border-t border-gray-300 w-full"></div>
                <span class="absolute bg-white px-3 text-sm text-gray-500">atau</span>
              </div>

              <!-- Demo Account Info -->
              <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                <div class="flex items-start space-x-3">
                  <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                  <div>
                    <h4 class="text-blue-800 font-medium text-sm">Akun Demo</h4>
                    <p class="text-blue-700 text-xs mt-1">
                      Gunakan akun demo: <span class="font-mono">admin / password</span>
                    </p>
                  </div>
                </div>
              </div>
            </form>

            <!-- Registration Prompt -->
            <div class="text-center mt-4 lg:mt-6 pt-4 lg:pt-6 border-t border-gray-200">
              <p class="text-gray-600 text-sm">
                Belum punya akun?
                <a href="#" class="text-indigo-600 font-medium hover:text-indigo-500 ml-1">Daftar sekarang</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Floating Elements -->
  <div class="fixed bottom-10 left-4 lg:left-10 floating hidden sm:block">
    <div class="w-16 h-16 lg:w-20 lg:h-20 bg-yellow-100 rounded-2xl flex items-center justify-center shadow-lg">
      <i class="fas fa-lightbulb text-yellow-500 text-xl lg:text-2xl"></i>
    </div>
  </div>

  <div class="fixed top-10 right-4 lg:right-10 floating hidden sm:block" style="animation-delay: 2s">
    <div class="w-14 h-14 lg:w-16 lg:h-16 bg-pink-100 rounded-2xl flex items-center justify-center shadow-lg">
      <i class="fas fa-rocket text-pink-500 text-lg lg:text-xl"></i>
    </div>
  </div>

  <!-- Notification Toast -->
  <div id="toast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300 z-50">
    <div class="flex items-center space-x-2">
      <i class="fas fa-check-circle"></i>
      <span>Login berhasil! Mengarahkan...</span>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Elements
      const loginForm = document.getElementById('loginForm');
      const usernameInput = document.getElementById('username');
      const passwordInput = document.getElementById('password');
      const togglePasswordBtn = document.getElementById('togglePassword');
      const loginButton = document.getElementById('loginButton');
      const loadingIcon = document.getElementById('loadingIcon');
      const usernameValidIcon = document.getElementById('username-valid');
      const toast = document.getElementById('toast');

      // Toggle password visibility
      togglePasswordBtn.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
      });

      // Username validation
      usernameInput.addEventListener('input', function() {
        if (this.value.length >= 3) {
          usernameValidIcon.classList.remove('hidden');
          usernameValidIcon.classList.add('fa-check-circle', 'text-green-500');
        } else {
          usernameValidIcon.classList.add('hidden');
        }
      });

      // Form submission with animation
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Show loading state
        loginButton.disabled = true;
        loadingIcon.classList.remove('hidden');
        loginButton.querySelector('span').textContent = 'Memproses...';

        // Simulate API call delay
        setTimeout(() => {
          // Show success toast
          toast.classList.remove('translate-x-full');

          // Redirect after a delay
          setTimeout(() => {
            // In a real app, this would be the form submission
            // For demo, we'll just show a message
            loginForm.submit();
          }, 1500);
        }, 1500);
      });

      // Add interactive effects to inputs
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('ring-2', 'ring-indigo-200');
        });

        input.addEventListener('blur', function() {
          this.parentElement.classList.remove('ring-2', 'ring-indigo-200');
        });
      });

      // Add particle effect on button hover
      loginButton.addEventListener('mouseenter', function() {
        createParticles(this);
      });

      // Create particles effect
      function createParticles(button) {
        const particles = 8;
        for (let i = 0; i < particles; i++) {
          const particle = document.createElement('div');
          particle.className = 'absolute w-2 h-2 bg-white rounded-full opacity-70';
          particle.style.left = `${Math.random() * 100}%`;
          particle.style.top = `${Math.random() * 100}%`;
          button.appendChild(particle);

          // Animate particle
          const animation = particle.animate([
            { transform: 'scale(1)', opacity: 0.7 },
            { transform: `scale(0) translate(${Math.random() * 100 - 50}px, ${Math.random() * 100 - 50}px)`, opacity: 0 }
          ], {
            duration: 600,
            easing: 'ease-out'
          });

          animation.onfinish = () => particle.remove();
        }
      }

      // Add typewriter effect to welcome message
      const welcomeText = document.querySelector('.gradient-text');
      const originalText = welcomeText.textContent;
      welcomeText.textContent = '';
      welcomeText.classList.add('typewriter');

      setTimeout(() => {
        welcomeText.textContent = originalText;
        welcomeText.classList.remove('typewriter');
        welcomeText.style.borderRight = 'none';
      }, 3500);
    });
  </script>
</body>
</html>
