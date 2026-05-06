@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit User</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Form Edit User</h4>
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
          @csrf
          @method('PUT')

          <div class="row">
            <div class="form-group col-6">
              <label>Nama</label>
              <input type="text" name="name" class="form-control"
                     value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group col-6">
              <label>Email</label>
              <input type="email" name="email" class="form-control"
                     value="{{ old('email', $user->email) }}" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-6">
              <label>Password <small>(Kosongkan jika tidak diubah)</small></label>
              <input type="password" name="password" class="form-control">
            </div>

            <div class="form-group col-6">
              <label>No Telepon</label>
              <input type="text" name="no_tlp" class="form-control"
                     value="{{ old('no_tlp', $user->no_tlp) }}" required>
            </div>
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ old('alamat', $user->alamat) }}</textarea>
          </div>

          <div class="row">
            <div class="form-group col-6">
              <label>Jenis Kelamin</label>
              <select name="jkl" class="form-control">
                <option value="L" {{ $user->jkl == 'L' ? 'selected' : '' }}>Laki-laki</option>
                <option value="P" {{ $user->jkl == 'P' ? 'selected' : '' }}>Perempuan</option>
              </select>
            </div>

            <div class="form-group col-6">
              <label>Role</label>
              <select name="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="anggota" {{ $user->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
              </select>
            </div>
          </div>

          <button class="btn btn-primary">Update</button>
          <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>

        </form>
      </div>
    </div>
  </div>
</section>
@endsection