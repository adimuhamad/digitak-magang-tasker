@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

    <!-- Main Content goes here -->

    <button type="button" class="btn btn-warning mb-3" data-toggle="modal" data-target="#addModal">
      <i class="fa-solid fa-plus mr-2"></i>
      New User
    </button>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-left-danger" role="alert">
          Failed to add new user, please check the field!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>           
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show border-left-success" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('message2'))
        <div class="alert alert-warning alert-dismissible fade show border-left-warning" role="alert">
            {{ session('message2') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Major</th>
                <th>Education Level</th>
                <th>Start Date</th>
                <th>Finish Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $user->full_name }}</td>
                    <td>{{ $user->jurusan }}</td>
                    <td>{{ $user->tingkat }}</td>
                    <td>{{ $user->tanggal_masuk }}</td>
                    <?php if($user->tanggal_berakhir == null) :?>
                      <td>None</td>
                    <?php else :?>
                      <td>{{ $user->tanggal_berakhir }}</td>
                    @endif
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('magang.show', $user->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fa-solid fa-pen-to-square mr-2"></i>Show</a>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning mr-2"><i class="fa-solid fa-pen-to-square mr-2"></i>Edit</a>
                            <a href="{{ route('magang.skill', $user->id) }}" class="btn btn-sm btn-success mr-2"><i class="fa-solid fa-pen-to-square mr-2"></i>Add Skill</a>
                            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete this?')"><i class="fa-solid fa-trash-can mr-2"></i>Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}

    <!-- End of Main Content -->

    <!-- Modal -->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ route('user.store') }}" method="post">
              @csrf

              <div class="row">
                <div class="col-md-3 mt-1">
                  <label class="form-control-label">First Name</label>
                </div>
                <div class="col-md-9 ms-auto">
                  <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" placeholder="First Name" autocomplete="off" value="{{ old('first_name') }}">
                  @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-3 mt-1">
                  <label class="form-control-label">Last Name</label>
                </div>
                <div class="col-md-9 ms-auto">
                  <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" placeholder="Last Name" autocomplete="off" value="{{ old('last_name') }}">
                  @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-3 mt-1">
                  <label class="form-control-label">E-mail</label>
                </div>
                <div class="col-md-9 ms-auto">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" autocomplete="off" value="{{ old('email') }}">
                  @error('email')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-3 mt-2">
                  <label class="form-control-label">Password</label>
                </div>
                <div class="col-md-9 ms-auto">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" autocomplete="off">
                  @error('password')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-3 mt-2">
                  <label class="form-control-label">Jurusan</label>
                </div>
                <div class="col-md-9 ms-auto">
                  <input type="text" class="form-control @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan" placeholder="Jurusan" autocomplete="off">
                  @error('jurusan')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="row mt-3">
                <div class="col-md-3">
                  <label class="form-control-label">Tingkat</label>
                </div>
                <div class="col-md-9 ms-auto">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat" id="tingkat1" value="Siswa" checked>
                    <label class="form-check-label" for="tingkat1">Siswa</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tingkat" id="tingkat2" value="Mahasiswa">
                    <label class="form-check-label" for="tingkat2">Mahasiswa</label>
                  </div>
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-3 mt-2">
                  <label class="form-control-label">Tanggal Masuk</label>
                </div>
                <div class="col-md-9 ms-auto">
                  <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" name="tanggal_masuk" id="tanggal_masuk" placeholder="Tanggal Masuk" autocomplete="off">
                  @error('tanggal_masuk')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div class="row mt-2">
                <div class="col-md-3">
                  <label class="form-control-label">Durasi Magang (Bulan)</label>
                </div>
                <div class="col-md-7 ms-auto">
                  <input type="number" min='1' value='1' class="form-control @error('durasi') is-invalid @enderror" name="durasi" id="durasi" autocomplete="off">
                  @error('durasi')
                    <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa-solid fa-xmark mr-2"></i>Close</button>
                <button type="submit" class="btn btn-warning"><i class="fa-solid fa-floppy-disk mr-2"></i>Save</button>
              </div>
            </form>
          </div>          
        </div>
      </div>
    </div>
    <!-- End Modal -->

@endsection

@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush
