@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Barang Yang Di Titipkan</h5>
                    <div>
                        <a href="{{ route('items.history') }}" class="btn btn-secondary">
                            <i class="fas fa-history"></i> Histori
                        </a>
                        <a href="{{ route('items.create') }}" class="btn btn-light">
                            <i class="fas fa-plus"></i> Tambah Barang
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.index') }}" method="GET" class="mb-4">
                        <div class="input-group">
<input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ $search ?? '' }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Cari
                            </button>
                            @if(isset($search))
                                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            @endif
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Kondisi</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th width="200">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ ucfirst($item->jenis) }}</td>
                                        <td>{{ ucfirst($item->kondisi) }}</td>
                                        <td>
                                            @if($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Barang" width="200" class="img-thumbnail">
                                            @else
                                                <div class="text-muted">Tidak ada gambar</div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $item->status == 'tersedia' ? 'success' : 'warning' }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('items.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="btn btn-success btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menandai barang ini sebagai diambil?')">
                                                        <i class="fas fa-check"></i> Selesai
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">Belum ada data barang</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($items->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $items->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
    vertical-align: middle;
}
.btn-group .btn {
    margin: 0 2px;
}
</style>
@endpush