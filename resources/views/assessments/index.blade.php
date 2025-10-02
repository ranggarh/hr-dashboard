@extends('layouts.app')

@section('title', 'Assessments')

@section('content')
<div class="flex-1 p-6">
    <!-- Header -->
    <div class=" items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Assessments Test</h1>
            <p class="text-gray-600 mt-1">Kelola assessment test untuk kandidat</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-4 flex justify-between">
        <div class="relative w-full max-w-md">
            <input type="text" 
                   placeholder="Find Assessment..." 
                   class="w-full max-w-md px-4 py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
        <button onclick="openCreateModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Tambah Assessment</span>
        </button>
    </div>

    <!-- Content Area -->
    @if(count($assessments) > 0)
        <div class="space-y-4">
            @foreach($assessments as $assessment)
                <div class="bg-white rounded-lg border border-gray-200 p-6 hover:shadow-lg transition-shadow cursor-pointer" 
                     onclick="window.location.href='{{ route('assessments.show', $assessment) }}'">
                    <div class="flex items-center justify-between">
                        <!-- Left Side - Icon and Content -->
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $assessment->title }}</h3>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                        {{ $assessment->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    @if($assessment->type)
                                        <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full capitalize">
                                            {{ $assessment->type }}
                                        </span>
                                    @endif
                                </div>
                                <p class="text-gray-600 text-sm mb-2">{{ $assessment->description ?: 'Tidak ada deskripsi' }}</p>
                                <div class="flex items-center text-xs text-gray-500 space-x-4">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $assessment->questions_count }} pertanyaan
                                    </span>
                                    @if($assessment->duration)
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $assessment->duration }} menit
                                        </span>
                                    @endif
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $assessment->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Actions -->
                        <div class="flex items-center space-x-2">
                            <button onclick="event.stopPropagation(); window.location.href='{{ route('assessments.edit', $assessment) }}'" 
                                    class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button onclick="event.stopPropagation(); deleteAssessment({{ $assessment->id }})" 
                                    class="p-2 text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada assessment yang ditambahkan</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Mulai dengan membuat assessment pertama Anda untuk mengevaluasi kandidat dengan lebih baik.
            </p>
            <button onclick="openCreateModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg inline-flex items-center space-x-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Buat Assessment Pertama</span>
            </button>
        </div>
    @endif
</div>

<!-- Modal Overlay -->
<div id="modalOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden"></div>

<!-- Slide Modal -->
<div id="createModal" class="fixed top-0 right-0 h-full w-full max-w-md bg-white shadow-xl transform translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="flex flex-col h-full">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b">
            <h2 class="text-xl font-semibold text-gray-800">Buat Asesmen Baru</h2>
            <button onclick="closeCreateModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="flex-1 overflow-y-auto p-6">
            <form id="createAssessmentForm" action="{{ route('assessments.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 -mt-2 mb-2">Judul Asesmen *</label>
                    <input type="text" name="title" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan judul assessment">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan deskripsi assessment"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Asesmen</label>
                    <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Tipe</option>
                        <option value="technical">Teknis</option>
                        <option value="personality">Kepribadian</option>
                        <option value="cognitive">Kognitif</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Durasi (menit)</label>
                        <input type="number" name="duration" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="60">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Pertanyaan</label>
                        <input type="number" name="questions_count" min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="10">
                    </div>
                </div>

                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Active</span>
                    </label>
                </div>
            </form>
        </div>
        
        <!-- Modal Footer -->
        <div class="border-t p-6">
            <div class="flex space-x-3">
                <button type="submit" form="createAssessmentForm" 
                        class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                    Create Assessment
                </button>
                <button type="button" onclick="closeCreateModal()"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg transition-colors">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function openCreateModal() {
    const modal = document.getElementById('createModal');
    const overlay = document.getElementById('modalOverlay');
    
    overlay.classList.remove('hidden');
    modal.classList.remove('translate-x-full');
    document.body.style.overflow = 'hidden';
}

function closeCreateModal() {
    const modal = document.getElementById('createModal');
    const overlay = document.getElementById('modalOverlay');
    
    modal.classList.add('translate-x-full');
    overlay.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Reset form
    document.getElementById('createAssessmentForm').reset();
}

function deleteAssessment(id) {
    if (confirm('Apakah Anda yakin ingin menghapus assessment ini?')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/assessments/${id}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Close modal when clicking overlay
document.getElementById('modalOverlay').addEventListener('click', closeCreateModal);

// Close modal with ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCreateModal();
    }
});
</script>
@endpush
@endsection