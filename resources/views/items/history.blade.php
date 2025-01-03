@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Histori Barang Yang Diambil</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Kondisi</th>
                                    <th>Gambar</th>
                                    <th>Status</th>
                                    <th>Tanggal Diambil</th>
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
                                            <span class="badge bg-success">{{ ucfirst($item->status) }}</span>
                                        </td>
                                        <td>{{ $item->updated_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">Belum ada barang yang diambil</div>
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
