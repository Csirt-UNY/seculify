<div class="modal fade" id="editModal{{$test->id}}" tabindex="-1" role="dialog"
    aria-labelledby="editModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit tes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.tests.update', $test)}}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputTitle1">Judul</label>
                        <input type="text" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            id="exampleInputTitle1" placeholder="Masukkan nama lengkap"
                            value="{{ $test->title, old('title') }}" autocomplete="title"
                            required autofocus>
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription1">Deskripsi</label>
                        <textarea name="description"
                            class="form-control @error('description') is-invalid @enderror"
                            id="exampleInputDescription1" placeholder="Masukkan deskripsi"
                            autocomplete="description"
                            required>{{ $test->description, old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLevel1">Gambar</label>
                        <input type="file" name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            id="exampleInputImage1">
                        @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleInputLevel1">Level</label>
                        <select name="level"
                            class="form-control @error('level') is-invalid @enderror"
                            id="exampleInputLevel1" required>
                            <option value="mudah" @if ($test->level == 'mudah') selected
                                @endif>Mudah</option>
                            <option value="sedang" @if ($test->level == 'sedang') selected
                                @endif>Sedang</option>
                            <option value="sulit" @if ($test->level == 'sulit') selected
                                @endif>Sulit</option>
                        </select>
                        @error('level')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
