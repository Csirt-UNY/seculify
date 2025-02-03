<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Config Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.configs.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Key Input -->
                    <div class="form-group">
                        <label for="exampleInputkey1">Key</label>
                        <input type="text" name="key" class="form-control @error('key') is-invalid @enderror"
                            id="exampleInputkey1" placeholder="Masukkan key" autocomplete="key" required autofocus>
                        @error('key')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Type Select -->
                    <div class="form-group">
                        <label for="valueType">Type</label>
                        <select name="type" class="form-control @error('type') is-invalid @enderror"
                            id="valueType" required>
                            <option value="string">String</option>
                            <option value="upload">Upload</option>
                        </select>
                        @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Value Input for String -->
                    <div class="form-group" id="valueString">
                        <label for="valueString">Value (String)</label>
                        <input type="text" name="value_string"
                            class="form-control @error('value_string') is-invalid @enderror"
                            placeholder="Masukkan value" autocomplete="value_string" autofocus>
                        @error('value_string')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Value Input for Upload -->
                    <div class="form-group" id="valueUpload" style="display: none;">
                        <label for="exampleInputValueFile">Value (Upload)</label>
                        <input type="file" name="value_upload"
                            class="form-control @error('value_upload') is-invalid @enderror" id="exampleInputValueFile"
                            placeholder="Masukkan file" autocomplete="value_upload" autofocus>
                        @error('value_upload')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- Aktif Select -->
                    <div class="form-group">
                        <label for="exampleInputis_active1">Aktif</label>
                        <select name="is_active" class="form-control @error('is_active') is-invalid @enderror"
                            id="exampleInputis_active1" required>
                            <option value="false">Tidak Aktif</option>
                            <option value="true">Aktif</option>
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
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get elements
        var typeSelect = document.getElementById('valueType');
        var textInput = document.getElementById('valueString');
        var fileInputGroup = document.getElementById('valueUpload');

        // Add event listener for change on the select box
        typeSelect.addEventListener('change', function() {
            if (this.value === 'string') {
                textInput.style.display = 'block';  // Show text input
                fileInputGroup.style.display = 'none';  // Hide file input
            } else if (this.value === 'upload') {
                textInput.style.display = 'none';  // Hide text input
                fileInputGroup.style.display = 'block';  // Show file input
            }
        });

        // Trigger change event on page load to set initial state
        typeSelect.dispatchEvent(new Event('change'));
    });
</script>
