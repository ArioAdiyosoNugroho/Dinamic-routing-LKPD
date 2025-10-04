@extends('layout')

@section('title', 'Manajemen User - LKPD App')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="mb-8 animate-fade-in">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <div class="w-12 h-12 flex items-center justify-center bg-gradient-to-b from-indigo-400 to-purple-500 rounded-xl shadow-md mr-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <span>Manajemen User</span>
                </h1>
                <p class="mt-2 text-lg text-gray-600 max-w-2xl">
                    Kelola semua pengguna aplikasi LKPD dengan antarmuka yang intuitif
                </p>
            </div>
            <div class="mt-4 md:mt-0 flex space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Cari user..."
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <button type="button" onclick="openCreateModal()"
                        class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center hover:scale-105">
                    <i class="fas fa-user-plus mr-2"></i>
                    Tambah User Baru
                </button>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <x-notifikasi />

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.1s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-indigo-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-users text-indigo-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ count($users) }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-indigo-500 bg-indigo-50 px-2 py-1 rounded-full">
                            <i class="fas fa-cubes mr-1"></i> Semua user
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.2s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-user-shield text-green-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Admin Users</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $users->where('role', 'admin')->count() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-check mr-1"></i> Administrator
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.3s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-blue-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-user text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Regular Users</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $users->where('role', 'user')->count() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-blue-500 bg-blue-50 px-2 py-1 rounded-full">
                            <i class="fas fa-user-graduate mr-1"></i> Siswa
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-card rounded-2xl shadow-soft p-6 card-hover animate-slide-up" style="animation-delay: 0.4s">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-purple-100 rounded-xl p-4 stats-icon">
                    <i class="fas fa-user-clock text-purple-600 text-2xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Aktif Bulan Ini</dt>
                        <dd class="text-2xl font-bold text-gray-900">{{ $users->count() }}</dd>
                    </dl>
                    <div class="mt-1">
                        <span class="text-xs font-medium text-purple-500 bg-purple-50 px-2 py-1 rounded-full">
                            <i class="fas fa-chart-line mr-1"></i> Pengguna aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User List -->
    <div class="bg-white rounded-2xl shadow-large overflow-hidden animate-slide-up" style="animation-delay: 0.5s">
        <!-- Table Header -->
        <div class="px-6 py-5 bg-gradient-to-r from-indigo-500 to-purple-600">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-medium text-white">Daftar Semua Pengguna</h3>
                    <p class="mt-1 text-sm text-indigo-100">
                        Kelola informasi dan akses pengguna di aplikasi LKPD
                    </p>
                </div>
                <div class="mt-3 sm:mt-0 flex items-center space-x-2">
                    <span class="text-indigo-100 text-sm">Total: {{ count($users) }} user</span>
                </div>
            </div>
        </div>

        @if($users->isEmpty())
        <div class="px-4 py-16 sm:px-6 text-center animate-pulse">
            <div class="bg-gray-100 p-6 rounded-full inline-flex mb-4">
                <i class="fas fa-users text-gray-300 text-4xl"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-900 mb-2">Belum ada user</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai dengan menambahkan user pertama Anda</p>
            <button type="button" onclick="openCreateModal()"
                    class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center hover:scale-105 inline-flex">
                <i class="fas fa-user-plus mr-2"></i>
                Tambah User Pertama
            </button>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kelas & NIS
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="table-row-hover">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-r from-indigo-400 to-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->role == 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800 shadow-sm">
                                <i class="fas fa-user-shield mr-1.5" style="font-size: 10px;"></i>
                                Admin
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 shadow-sm">
                                <i class="fas fa-user mr-1.5" style="font-size: 10px;"></i>
                                User
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->role == 'user')
                                <div class="space-y-1">
                                    <div class="flex items-center text-sm text-gray-900">
                                        <i class="fas fa-users mr-2 text-blue-500 text-xs"></i>
                                        <span class="font-medium">Kelas:</span>
                                        <span class="ml-1">{{ $user->kelas ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-id-card mr-2 text-green-500 text-xs"></i>
                                        <span class="font-medium">NIS:</span>
                                        <span class="ml-1">{{ $user->nis ?? '-' }}</span>
                                    </div>
                                </div>
                            @else
                                <span class="text-sm text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 shadow-sm">
                                <i class="fas fa-circle text-green-500 mr-1.5" style="font-size: 6px;"></i>
                                Aktif
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <button onclick="openEditModal({{ $user->id }})"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 transition-all duration-200 hover:shadow-md shadow-sm">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </button>
                                <button onclick="openDeleteModal({{ $user->id }}, '{{ addslashes($user->name) }}')"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition-all duration-200 hover:shadow-md shadow-sm">
                                    <i class="fas fa-trash mr-1"></i>
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<!-- Create User Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-white modal-animation">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-t-xl flex justify-between items-center">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-user-plus mr-2"></i> Tambah User Baru
            </h3>
            <button onclick="closeCreateModal()" class="text-white hover:text-gray-200 transition duration-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200" required>
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" id="role"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                        onchange="toggleKelasNIS()">
                    <option value="admin">Admin</option>
                    <option value="user" selected>User</option>
                </select>
            </div>

            <!-- Fields for Kelas and NIS - initially visible for user role -->
            <div id="kelasNISFields">
                <div class="mb-4">
                    <label for="kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                    <input type="text" name="kelas" id="kelas" placeholder="Masukkan kelas (contoh: X IPA 1)"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                </div>
                <div class="mb-6">
                    <label for="nis" class="block text-sm font-medium text-gray-700 mb-2">NIS (Nomor Induk Siswa)</label>
                    <input type="text" name="nis" id="nis" placeholder="Masukkan NIS"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeCreateModal()"
                        class="flex-1 inline-flex justify-center items-center px-4 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 inline-flex justify-center items-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-save mr-2"></i>
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit User Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-white modal-animation">
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-t-xl flex justify-between items-center">
            <h3 class="text-lg font-semibold text-white flex items-center">
                <i class="fas fa-user-edit mr-2"></i> Edit User
            </h3>
            <button onclick="closeEditModal()" class="text-white hover:text-gray-200 transition duration-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="editForm" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="edit-name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="edit-name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200" required>
            </div>
            <div class="mb-4">
                <label for="edit-password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="edit-password" placeholder="(Kosongkan jika tidak diubah)"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
            </div>
            <div class="mb-4">
                <label for="edit-role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" id="edit-role"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                        onchange="toggleEditKelasNIS()">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <!-- Fields for Kelas and NIS -->
            <div id="edit-kelasNISFields" class="hidden">
                <div class="mb-4">
                    <label for="edit-kelas" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                    <input type="text" name="kelas" id="edit-kelas" placeholder="Masukkan kelas (contoh: X IPA 1)"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                </div>
                <div class="mb-6">
                    <label for="edit-nis" class="block text-sm font-medium text-gray-700 mb-2">NIS (Nomor Induk Siswa)</label>
                    <input type="text" name="nis" id="edit-nis" placeholder="Masukkan NIS"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200">
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeEditModal()"
                        class="flex-1 inline-flex justify-center items-center px-4 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 inline-flex justify-center items-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 hidden transition-opacity duration-300">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-2xl rounded-2xl bg-white modal-animation">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus User</h3>
            <div class="mt-2 px-4 py-3">
                <p class="text-sm text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus user <span class="font-semibold text-gray-900" id="deleteUserName"></span>?
                </p>
                <p class="text-xs text-red-500 bg-red-50 p-3 rounded-lg">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tindakan ini tidak dapat dibatalkan dan semua data user akan dihapus permanen.
                </p>
            </div>
            <div class="flex items-center justify-center gap-3 px-4 py-4 border-t border-gray-200">
                <button id="cancelDelete"
                    class="flex-1 inline-flex justify-center items-center px-4 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-3 border border-transparent text-sm font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 transition-all duration-200 hover:shadow-md">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
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

    .card-hover {
        transition: all 0.3s ease;
    }

    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .table-row-hover:hover {
        background-color: #f8fafc;
    }

    .stats-icon {
        transition: all 0.3s ease;
    }

    .stats-card:hover .stats-icon {
        transform: scale(1.1);
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

    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    .animate-slide-up {
        animation: slideUp 0.5s ease-out;
    }

    .modal-animation {
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
</style>

<script>
    // Modal Functions
    function openCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        // Reset form fields
        document.getElementById('role').value = 'user';
        toggleKelasNIS();
    }

    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function openEditModal(userId) {
        // Fetch user data and populate form
        fetch(`/admin/users/${userId}/edit`)
            .then(response => response.json())
            .then(user => {
                document.getElementById('edit-name').value = user.name;
                document.getElementById('edit-role').value = user.role;
                document.getElementById('edit-kelas').value = user.kelas || '';
                document.getElementById('edit-nis').value = user.nis || '';

                // Set form action
                document.getElementById('editForm').action = `/admin/users/${userId}`;

                // Toggle kelas and NIS fields
                toggleEditKelasNIS();

                // Show modal
                document.getElementById('editModal').classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal memuat data user');
            });
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function openDeleteModal(userId, userName) {
        document.getElementById('deleteUserName').textContent = userName;
        document.getElementById('deleteForm').action = `/admin/users/${userId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Toggle visibility of kelas and NIS fields based on role selection in create modal
    function toggleKelasNIS() {
        const role = document.getElementById('role').value;
        const kelasNISFields = document.getElementById('kelasNISFields');

        if (role === 'user') {
            kelasNISFields.classList.remove('hidden');
            // Make kelas and NIS required for users
            document.getElementById('kelas').required = true;
            document.getElementById('nis').required = true;
        } else {
            kelasNISFields.classList.add('hidden');
            // Remove required for admin
            document.getElementById('kelas').required = false;
            document.getElementById('nis').required = false;
        }
    }

    // Toggle visibility of kelas and NIS fields based on role selection in edit modal
    function toggleEditKelasNIS() {
        const role = document.getElementById('edit-role').value;
        const kelasNISFields = document.getElementById('edit-kelasNISFields');

        if (role === 'user') {
            kelasNISFields.classList.remove('hidden');
            // Make kelas and NIS required for users
            document.getElementById('edit-kelas').required = true;
            document.getElementById('edit-nis').required = true;
        } else {
            kelasNISFields.classList.add('hidden');
            // Remove required for admin
            document.getElementById('edit-kelas').required = false;
            document.getElementById('edit-nis').required = false;
        }
    }

    // Event Listeners
    document.getElementById('cancelDelete').addEventListener('click', closeDeleteModal);

    // Close modals when clicking outside
    document.getElementById('createModal').addEventListener('click', function(e) {
        if (e.target === this) closeCreateModal();
    });

    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });

    // Staggered animation for cards
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.animate-slide-up');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${0.1 * index}s`;
        });

        // Initialize on page load
        toggleKelasNIS();
    });
</script>
@endsection
