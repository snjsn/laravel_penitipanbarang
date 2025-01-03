@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Detail Barang</h5>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th class="w-25 bg-light">Nama</th>
                                        <td>{{ $item->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Deskripsi</th>
                                        <td>{{ $item->deskripsi }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Jenis</th>
                                        <td>{{ $item->jenis }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Kondisi</th>
                                        <td>{{ $item->kondisi }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Status</th>
                                        <td>{{ $item->status }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Tanggal Masuk</th>
                                        <td>
                                            @if($item->tanggal_masuk instanceof \DateTime)
                                                {{ $item->tanggal_masuk->format('d M Y H:i') }}
                                            @else
                                                {{ $item->tanggal_masuk }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light">Foto</th>
                                        <td>
                                            @if($item->foto)
                                                <div class="text-center">
                                                    <img src="{{ asset('storage/' . $item->foto) }}?v={{ time() }}" 
                                                         alt="Foto Barang" 
                                                         class="img-fluid rounded"
                                                         style="max-width: 300px;">
                                                </div>
                                            @else
                                                <div class="text-muted">Tidak ada gambar</div>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4 text-end">
                            <a href="{{ route('items.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 8px;
    }
    
    .card-header {
        border-radius: 8px 8px 0 0;
    }
    
    .table th {
        font-weight: 600;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,0.03);
    }
    
    .img-fluid {
        transition: transform 0.3s ease;
    }
    
    .img-fluid:hover {
        transform: scale(1.05);
    }
</style>
@endpush
