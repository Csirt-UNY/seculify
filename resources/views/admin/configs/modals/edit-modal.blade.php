<div class="modal fade" id="editModal{{$config->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Config</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.configs.update', $config)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- Key Input -->
                    <div class="form-group">
                        <label for="editInputKey{{$config->id}}">Key</label>
                        <input type="text" name="key" class="form-control @error('key') is-invalid @enderror"
                            id="editInputKey{{$config->id}}" placeholder="Masukkan key"
                            value="{{ old('key', $config->key) }}" autocomplete="key" required autofocus>
                        @error('key')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Type Select -->
                    <div class="form-group" id="editInputType{{$config->id}}">
                        <label for="editInputType{{$config->id}}">Type</label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror">
                            <option value="{{$config->type}}" selected>{{$config->type}}</option>
                        </select>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @if ($config->type == 'string')
                    <!-- Value Input for String -->
                    <div class="form-group" id="editTextValueGroup{{$config->id}}">
                        <label for="editInputValueText{{$config->id}}">Value (String)</label>
                        <input type="text" name="value_string"
                            class="form-control @error('value_string') is-invalid @enderror"
                            id="editInputValueText{{$config->id}}" placeholder="Masukkan value"
                            value="{{ old('value', $config->value) }}" autocomplete="value">
                        @error('value_string')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @elseif ($config->type == 'upload')
                    <!-- Value Input for Upload -->
                    <div class="form-group" id="editFileValueGroup{{$config->id}}">
                        <label for="editInputValueFile{{$config->id}}">Value (Upload)</label>
                        <input type="file" name="value_upload"
                            class="form-control @error('value_upload') is-invalid @enderror"
                            id="editInputValueFile{{$config->id}}">
                        @error('value_upload')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif

                    <!-- Aktif Select -->
                    <div class="form-group">
                        <label for="editInputIsActive{{$config->id}}">is_active</label>
                        <select name="is_active" class="form-control @error('is_active') is-invalid @enderror"
                            id="editInputIsActive{{$config->id}}" required>
                            <option value="false" @if($config->is_active == 0) selected @endif>Tidak Aktif</option>
                            <option value="true" @if($config->is_active == 1) selected @endif>Aktif</option>
                        </select>
                        @error('is_active')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
