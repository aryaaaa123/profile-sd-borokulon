@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nama *</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $staff->name ?? '') }}" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Peran *</label>
    <select name="role" class="form-select" required>
      @foreach($roles as $r)
        <option value="{{ $r }}" {{ old('role', $staff->role ?? 'guru') === $r ? 'selected' : '' }}>
          {{ ucfirst($r) }}
        </option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Mapel (jika Guru)</label>
    <input type="text" name="subject" class="form-control"
           value="{{ old('subject', $staff->subject ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Jabatan (jika Tendik)</label>
    <input type="text" name="position" class="form-control"
           value="{{ old('position', $staff->position ?? '') }}">
  </div>

  <div class="col-md-6">
    <label class="form-label">Foto</label>
    <input type="file" name="photo" class="form-control" accept="image/*">
    <div class="form-text">Maks 2MB. Rasio 1:1 disarankan.</div>

    @isset($staff->photo)
      @if($staff->photo)
        <img src="{{ $staff->photo_url }}" class="mt-2 rounded" style="width:120px;height:120px;object-fit:cover">
      @endif
    @endisset
  </div>
</div>
