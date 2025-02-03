<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah pertanyaan tes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('creator.quests.store', ['test' => $test])}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputTitle1">Judul</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            id="exampleInputTitle1" placeholder="Masukkan judul pertanyaan" autocomplete="title"
                            required autofocus value="{{ old('title') }}">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription1">Deskripsi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                            id="exampleInputDescription1" placeholder="Masukkan deskripsi" autocomplete="description"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLevel1">Phising</label>
                        <select name="is_phising" class="form-control @error('is_phising') is-invalid @enderror"
                            id="exampleInputLevel1" required>
                            <option value="true">Iya</option>
                            <option value="false">Tidak</option>
                        </select>
                        @error('is_phising')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="summernote">Isi Soal</label>
                        <textarea class="summern form-control @error('question_content') is-invalid @enderror"
                            name="question_content" required id="summernote">{{ old('question_content') }}</textarea>
                        @error('question_content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputproof1">Jawaban</label>
                        <textarea name="proof" class="form-control @error('proof') is-invalid @enderror"
                            id="exampleInputproof1" placeholder="Masukkan jawaban" autocomplete="proof"
                            required>{{ old('proof') }}</textarea>
                        @error('proof')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="exampleInputLevel1">Gambar</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                            id="exampleInputImage1">
                        @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div> --}}
                    <div class="form-group">
                        <label for="exampleInputLevel1">Kategori</label>
                        <select name='category_id' class="form-control @error('category_id') is-invalid @enderror"
                            id="exampleInputLevel1" required>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>