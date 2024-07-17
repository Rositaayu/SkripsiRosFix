@extends('layouts.main')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah News</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('berita') }}">News</a></li>
        <li class="breadcrumb-item active">Tambah Data</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            Tambah News
        </div>
        <div class="card-body">
            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if (auth()->user()->role == 'super_editor' || auth()->user()->role == 'editor')
                <div class="mb-3">
                    <label for="status_berita" class="form-label">Status Berita</label>
                    <div class="form-check p-0 d-flex
                        @error('status_berita') is-invalid @enderror">
                        <input class="form-check
                            @error('status_berita') is-invalid @enderror" type="radio" name="status_berita"
                            id="status_berita3" value="3" {{ old('status_berita')==3 ? 'checked' : '' }}>
                        <label class="form-check
                            @error('status_berita') is-invalid @enderror" for="status_berita3">
                            Published
                        </label>
                    </div>
                    <div class="form-check p-0 d-flex
                        @error('status_berita') is-invalid @enderror">
                        <input class="form-check
                            @error('status_berita') is-invalid @enderror" type="radio" name="status_berita"
                            id="status_berita2" value="2" {{ old('status_berita')==2 ? 'checked' : '' }}>
                        <label class="form-check
                            @error('status_berita') is-invalid @enderror" for="status_berita2">
                            On Progress
                        </label>
                    </div>
                    <div class="form-check p-0 d-flex
                        @error('status_berita') is-invalid @enderror">
                        <input class="form-check
                            @error('status_berita') is-invalid @enderror" type="radio" name="status_berita"
                            id="status_berita1" value="1" {{ old('status_berita')==1 ? 'checked' : '' }}>
                        <label class="form-check
                            @error('status_berita') is-invalid @enderror" for="status_berita1">
                            Pending
                        </label>
                    </div>
                    <div class="form-check p-0 d-flex
                        @error('status_berita') is-invalid @enderror">
                        <input class="form-check
                            @error('status_berita') is-invalid @enderror" type="radio" name="status_berita"
                            id="status_berita0" value="0" {{ old('status_berita')==0 ? 'checked' : '' }}>
                        <label class="form-check
                            @error('status_berita') is-invalid @enderror" for="status_berita0">
                            Review
                        </label>
                    </div>
                    @error('status_berita')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                @endif

                <div class="mb-3">
                    <label for="id_kategori_berita" class="form-label">Kategori</label>
                    <select class="select2 form-control @error('id_kategori_berita') is-invalid @enderror"
                        id="id_kategori_berita" name="id_kategori_berita">
                        <option selected disabled value="">Pilih Kategori</option>
                        @foreach ($kategori as $item)
                        <option value="{{ $item->id_kategori_berita }}">
                            {{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('id_kategori_berita')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="judul_berita" class="form-label">Judul</label>
                    <input type="text" class="form-control @error('judul_berita') is-invalid @enderror"
                        id="judul_berita" name="judul_berita" value="{{ old('judul_berita') }}">
                    @error('judul_berita')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="foto_berita" class="form-label">Foto</label>
                    <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                    <input type="file" class="form-control @error('foto_berita') is-invalid @enderror" id="foto_berita"
                        name="foto_berita" value="{{ old('foto_berita') }}">
                    @error('foto_berita')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="caption_foto" class="form-label">Caption Foto</label>
                    <input type="text" class="form-control @error('caption_foto') is-invalid @enderror"
                        id="caption_foto" name="caption_foto" value="{{ old('caption_foto') }}">
                    @error('caption_foto')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="artikel_berita" class="form-label">Artikel Berita</label>
                    <textarea class="form-control @error('artikel_berita') is-invalid @enderror"
                        id="artikel_berita_note" name="artikel_berita" rows="3">{{ old('artikel_berita') }}</textarea>
                    <input type="hidden" id="artikel_berita">
                    @error('artikel_berita')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="id_tag" class="form-label">Tag</label>
                    <select multiple class="select2 form-control @error('id_tag') is-invalid @enderror" id="id_tag"
                        name="id_tag[]">
                        @foreach ($tag as $item)
                        <option value="{{ $item->id_tag }}">
                            {{ $item->nama_tag }}</option>
                        @endforeach
                    </select>
                    @error('id_tag')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'classic'
        });

        // Summernote
        $('#artikel_berita_note').summernote({
            height: 200
        });

        $('input[id="foto_berita"]').on('change', function(){
            const image = document.getElementById("foto_berita");
            const imgPreview = document.querySelector(".img-preview");
            
            imgPreview.style.display = "block";
            
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            
            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        });
    });
</script>
@endpush