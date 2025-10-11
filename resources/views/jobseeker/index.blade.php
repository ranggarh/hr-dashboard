@extends('layouts.app')

@section('title', 'Daftar Jobseeker')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Daftar Jobseeker</h2>
    <div class="overflow-x-auto bg-white rounded-md shadow">
        <table id="jobseeker-table" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-blue-600">
                <tr>
                    <th class="px-4 py-2 text-left font-semibold text-white">No</th>
                    <th class="px-4 py-2 text-left font-semibold text-white">Nama</th>
                    <th class="px-4 py-2 text-left font-semibold text-white">Email</th>
                    <th class="px-4 py-2 text-left font-semibold text-white">Nomor HP</th>
                    <th class="px-4 py-2 text-left font-semibold text-white">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($jobseekers as $i => $user)
                <tr class="hover:bg-blue-50 transition">
                    <td class="px-4 py-2">{{ $i+1 }}</td>
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->phone }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <!-- Detail Icon -->
                        <a href="{{ route('jobseekers.show', $user->id) }}" class="text-blue-600 hover:text-blue-800" title="Detail">
                            <x-lucide-book-user class="w-5 h-5 inline" />
                        </a>
                        <!-- Delete Icon -->
                        <form action="{{ route('jobseekers.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                <x-lucide-trash-2 class="w-5 h-5 inline" />
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#jobseeker-table').DataTable({
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "›",
                "previous": "‹"
            },
            "zeroRecords": "Data tidak ditemukan"
        }
    });
});
</script>
@endpush