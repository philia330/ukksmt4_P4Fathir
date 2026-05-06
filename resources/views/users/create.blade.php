@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
    <h1>Tambah User</h1>
  </div>

  <div class="section-body">
    <div class="card">
      <div class="card-header">
        <h4>Form Tambah User</h4>
      </div>

      <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
          @csrf

          <div class="row">
            <div class="form-group col-6">
              <label>Nama</label>
              <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group col-6">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-6">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group col-6">
              <label>No Telepon</label>
              <input type="text" name="no_tlp" class="form-control" required>
            </div>
          </div>

          <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
          </div>

          <div class="row">
            <div class="form-group col-6">
              <label>Jenis Kelamin</label>
              <select name="jkl" class="form-control">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>

            <div class="form-group col-6">
              <label>Role</label>
              <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
                <option value="anggota">Anggota</option>
              </select>
            </div>
          </div>

          <button class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection