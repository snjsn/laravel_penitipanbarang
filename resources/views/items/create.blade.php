@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Barang</div>

                    <div class="card-body">
                        <!-- Form untuk menambah item baru -->
                        <form method="POST" action="{{ route('items.store') }}" enctype="multipart/form-data">
                            <!-- Token CSRF untuk keamanan -->
                            @csrf
                            
                            <!-- Form input untuk nama barang -->
                            <div class="form-group">
                                <label for="nama">Nama Barang:</label>
                                <!-- Input teks untuk nama barang, dengan validasi error jika ada -->
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                                
                                <!-- Menampilkan pesan error jika ada kesalahan dalam input nama -->
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Form textarea untuk deskripsi barang -->
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi') }}</textarea>
                                
                                <!-- Menampilkan pesan error jika ada kesalahan dalam input deskripsi -->
                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Form select untuk memilih jenis barang -->
                            <div class="form-group">
                                <label for="jenis">Jenis Barang:</label>
                                <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                                    <!-- Pilihan jenis barang, dengan opsi yang dipilih sebelumnya jika ada -->
                                    <option value="">Pilih Jenis</option>
                                    <option value="pakaian" {{ old('jenis') == 'pakaian' ? 'selected' : '' }}>Pakaian</option>
                                    <option value="elektronik" {{ old('jenis') == 'elektronik' ? 'selected' : '' }}>Elektronik</option>
                                    <option value="dokumen" {{ old('jenis') == 'dokumen' ? 'selected' : '' }}>Dokumen</option>
                                </select>
                                
                                <!-- Menampilkan pesan error jika ada kesalahan dalam memilih jenis barang -->
                                @error('jenis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Form select untuk memilih kondisi barang -->
                            <div class="form-group">
                                <label for="kondisi">Kondisi Barang:</label>
                                <select class="form-control @error('kondisi') is-invalid @enderror" id="kondisi" name="kondisi">
                                    <!-- Pilihan kondisi barang, dengan opsi yang dipilih sebelumnya jika ada -->
                                    <option value="">Pilih Kondisi</option>
                                    <option value="baru" {{ old('kondisi') == 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="bekas" {{ old('kondisi') == 'bekas' ? 'selected' : '' }}>Bekas</option>
                                </select>
                                
                                <!-- Menampilkan pesan error jika ada kesalahan dalam memilih kondisi barang -->
                                @error('kondisi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Form input untuk foto barang -->
                            <div class="form-group">
                                <label for="foto">Foto Barang:</label>
                                <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto">
                                
                                <!-- Menampilkan pesan error jika ada kesalahan dalam mengupload foto -->
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Tombol untuk menyimpan data -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection