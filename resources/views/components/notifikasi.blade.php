<!-- Notifikasi Session Component -->
<div id="notification-container" class="fixed top-4 right-4 z-50 space-y-3 w-96 max-w-full">
    <!-- Template untuk Success Notification -->
    <div id="success-notification-template" class="hidden">
        <div class="notification-card bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 shadow-lg rounded-xl p-4 transform transition-all duration-500 ease-in-out hover:shadow-xl">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-green-800 notification-title">Success</p>
                    <p class="mt-1 text-sm text-green-700 notification-message">Your action was completed successfully.</p>
                </div>
                <button type="button" class="ml-auto flex-shrink-0 inline-flex text-green-400 hover:text-green-600 focus:outline-none focus:text-green-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Progress Bar -->
            <div class="mt-2 w-full bg-green-200 rounded-full h-1">
                <div class="bg-green-500 h-1 rounded-full progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <!-- Template untuk Error Notification -->
    <div id="error-notification-template" class="hidden">
        <div class="notification-card bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 shadow-lg rounded-xl p-4 transform transition-all duration-500 ease-in-out hover:shadow-xl">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-red-800 notification-title">Error</p>
                    <p class="mt-1 text-sm text-red-700 notification-message">Something went wrong. Please try again.</p>
                </div>
                <button type="button" class="ml-auto flex-shrink-0 inline-flex text-red-400 hover:text-red-600 focus:outline-none focus:text-red-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Progress Bar -->
            <div class="mt-2 w-full bg-red-200 rounded-full h-1">
                <div class="bg-red-500 h-1 rounded-full progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <!-- Template untuk Warning Notification -->
    <div id="warning-notification-template" class="hidden">
        <div class="notification-card bg-gradient-to-r from-amber-50 to-orange-50 border-l-4 border-amber-500 shadow-lg rounded-xl p-4 transform transition-all duration-500 ease-in-out hover:shadow-xl">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-amber-800 notification-title">Warning</p>
                    <p class="mt-1 text-sm text-amber-700 notification-message">Please check your input and try again.</p>
                </div>
                <button type="button" class="ml-auto flex-shrink-0 inline-flex text-amber-400 hover:text-amber-600 focus:outline-none focus:text-amber-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Progress Bar -->
            <div class="mt-2 w-full bg-amber-200 rounded-full h-1">
                <div class="bg-amber-500 h-1 rounded-full progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <!-- Template untuk Info Notification -->
    <div id="info-notification-template" class="hidden">
        <div class="notification-card bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 shadow-lg rounded-xl p-4 transform transition-all duration-500 ease-in-out hover:shadow-xl">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-blue-800 notification-title">Information</p>
                    <p class="mt-1 text-sm text-blue-700 notification-message">Here's some important information for you.</p>
                </div>
                <button type="button" class="ml-auto flex-shrink-0 inline-flex text-blue-400 hover:text-blue-600 focus:outline-none focus:text-blue-600 transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Progress Bar -->
            <div class="mt-2 w-full bg-blue-200 rounded-full h-1">
                <div class="bg-blue-500 h-1 rounded-full progress-bar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>

<!-- Error Validation Display -->
@if ($errors->any())
<div id="error-validation" class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 w-96 max-w-full">
    <div class="bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 shadow-2xl rounded-2xl p-6 transform transition-all duration-500 ease-out">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <div class="ml-4 flex-1">
                <h3 class="text-lg font-semibold text-red-800 mb-2">Validation Error</h3>
                <div class="space-y-1 max-h-32 overflow-y-auto pr-2">
                    @foreach ($errors->all() as $error)
                    <div class="flex items-start text-sm text-red-700">
                        <span class="flex-shrink-0 w-2 h-2 bg-red-500 rounded-full mt-2 mr-2"></span>
                        <span>{{ $error }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <button type="button" onclick="closeErrorValidation()" class="ml-4 flex-shrink-0 inline-flex text-red-400 hover:text-red-600 focus:outline-none focus:text-red-600 transition-colors duration-200 p-1 rounded-full hover:bg-red-100">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <!-- Progress Bar -->
        <div class="mt-4 w-full bg-red-200 rounded-full h-1.5">
            <div id="validation-progress" class="bg-red-500 h-1.5 rounded-full transition-all duration-5000 ease-linear" style="width: 100%"></div>
        </div>
    </div>
</div>
@endif

<style>
    /* Animasi untuk notifikasi */
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-100%) translateX(-50%);
        }
        to {
            opacity: 1;
            transform: translateY(0) translateX(-50%);
        }
    }

    @keyframes slideOutUp {
        from {
            opacity: 1;
            transform: translateY(0) translateX(-50%);
        }
        to {
            opacity: 0;
            transform: translateY(-100%) translateX(-50%);
        }
    }

    .notification-slide-in {
        animation: slideInRight 0.5s ease-out forwards;
    }

    .notification-slide-out {
        animation: slideOutRight 0.5s ease-in forwards;
    }

    .validation-slide-in {
        animation: slideInDown 0.5s ease-out forwards;
    }

    .validation-slide-out {
        animation: slideOutUp 0.5s ease-in forwards;
    }

    /* Custom scrollbar untuk error list */
    .overflow-y-auto::-webkit-scrollbar {
        width: 4px;
    }

    .overflow-y-auto::-webkit-scrollbar-track {
        background: #fecaca;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #f87171;
        border-radius: 10px;
    }

    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #ef4444;
    }
</style>

<script>
    // Fungsi untuk menampilkan notifikasi
    function showNotification(type, title, message, duration = 5000) {
        const container = document.getElementById('notification-container');
        const template = document.getElementById(`${type}-notification-template`);

        if (!template) return;

        // Clone template
        const notification = template.cloneNode(true);
        notification.id = '';
        notification.classList.remove('hidden');

        // Set content
        notification.querySelector('.notification-title').textContent = title;
        notification.querySelector('.notification-message').textContent = message;

        // Add close functionality
        const closeButton = notification.querySelector('button');
        closeButton.addEventListener('click', function() {
            removeNotification(notification);
        });

        // Add to container
        container.appendChild(notification);

        // Trigger animation
        setTimeout(() => {
            notification.querySelector('.notification-card').classList.add('notification-slide-in');
        }, 10);

        // Auto remove after duration
        if (duration > 0) {
            // Animate progress bar
            const progressBar = notification.querySelector('.progress-bar');
            progressBar.style.transition = `width ${duration}ms linear`;
            setTimeout(() => {
                progressBar.style.width = '0%';
            }, 10);

            setTimeout(() => {
                removeNotification(notification);
            }, duration);
        }
    }

    // Fungsi untuk menghapus notifikasi
    function removeNotification(notification) {
        const card = notification.querySelector('.notification-card');
        card.classList.remove('notification-slide-in');
        card.classList.add('notification-slide-out');

        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 500);
    }

    // Fungsi untuk menutup error validation
    function closeErrorValidation() {
        const errorValidation = document.getElementById('error-validation');
        if (errorValidation) {
            errorValidation.classList.add('validation-slide-out');
            setTimeout(() => {
                errorValidation.remove();
            }, 500);
        }
    }

    // Auto close error validation setelah 8 detik
    document.addEventListener('DOMContentLoaded', function() {
        const errorValidation = document.getElementById('error-validation');
        if (errorValidation) {
            // Animate progress bar
            const progressBar = document.getElementById('validation-progress');
            if (progressBar) {
                progressBar.style.transition = 'width 8000ms linear';
                setTimeout(() => {
                    progressBar.style.width = '0%';
                }, 10);
            }

            // Auto close setelah 8 detik
            setTimeout(() => {
                closeErrorValidation();
            }, 8000);
        }

        // Tambahkan event listener untuk close button pada error validation
        const closeBtn = document.querySelector('#error-validation button');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeErrorValidation);
        }
    });

    // Handle session notifications dari Laravel
    document.addEventListener('DOMContentLoaded', function() {
        // Success message
        @if(session('success'))
            showNotification('success', 'Success!', '{{ session('success') }}', 5000);
        @endif

        // Error message
        @if(session('error'))
            showNotification('error', 'Error!', '{{ session('error') }}', 5000);
        @endif

        // Warning message
        @if(session('warning'))
            showNotification('warning', 'Warning!', '{{ session('warning') }}', 5000);
        @endif

        // Info message
        @if(session('info'))
            showNotification('info', 'Information', '{{ session('info') }}', 5000);
        @endif
    });
</script>
