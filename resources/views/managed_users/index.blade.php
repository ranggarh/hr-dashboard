@extends('layouts.app')
@section('title', 'Kelola Users')

@section('content')
    <div class="container mx-auto py-8 px-8">
        <div class="mb-8 flex items-center space-x-4">
        <a href="{{ route('assessments.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold">Kelola Users untuk assessment: {{ $assessment->title ?? 'assessment' }}</h1>
        </div>
        <!-- Tombol trigger modal -->
        <button onclick="openUserModal()"
            class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah User
        </button>
        @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif
        @if ($managedUsers->count())
            <table class="min-w-full bg-white rounded shadow">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nama</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Nomor HP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($managedUsers as $mu)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $mu->user->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $mu->user->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $mu->user->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-gray-600 mt-4">Belum ada yang didaftarkan.</div>
        @endif

        <!-- Modal Overlay -->
        <div id="userModalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>
        <!-- Slide Modal -->
        <div id="userModal"
            class="fixed top-0 right-0 h-full w-full max-w-md bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
            <div class="flex flex-col h-full">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Pilih Jobseeker</h2>
                    <button onclick="closeUserModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="flex-1 overflow-y-auto p-6">
                    <form id="addUserForm" method="POST" action="{{ route('managed-users.store', $assessment) }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-2 text-gray-700">Pilih Jobseeker</label>
                            <select name="user_id" required class="w-full border rounded px-3 py-2">
                                <option value="">-- Pilih Jobseeker --</option>
                                @foreach ($jobseekers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex space-x-3 mt-6">
                            <button type="submit"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition-colors">
                                Tambah
                            </button>
                            <button type="button" onclick="closeUserModal()"
                                class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function openUserModal() {
                document.getElementById('userModal').classList.remove('translate-x-full');
                document.getElementById('userModalOverlay').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeUserModal() {
                document.getElementById('userModal').classList.add('translate-x-full');
                document.getElementById('userModalOverlay').classList.add('hidden');
                document.body.style.overflow = 'auto';
                document.getElementById('addUserForm').reset();
            }
            // Close modal when clicking overlay
            document.getElementById('userModalOverlay').addEventListener('click', closeUserModal);
            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeUserModal();
                }
            });
        </script>
    @endpush
@endsection
