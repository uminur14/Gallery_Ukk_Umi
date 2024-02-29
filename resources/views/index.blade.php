<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gallery  | Umnry</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class=" navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link"><span class="fas fa-home"></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Selamat Datang {{ Session::get('name') }}</a>
      </li>
     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
   
      <li class="nav-item">
        <a class="nav-link"  href="/logout" role="button">
          
          <button id="delete" class="btn btn-default" onclick="return confirm('Apakah Yakin Mau Logout?')"><i class="fas fa-share"></i> Logout</button>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 
   

  <!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gallery Umnry</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              <button class="btn btn-info" data-toggle="modal" data-target="#baru"><span class="fas fa-image"></span> Baru</button>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div class="alert mr-3 mb-3">
      @if (session('alert'))
        <div class="alert alert-danger" style="font-size: 15px">
        {{ session('alert') }}
        </div>
      @endif
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              @foreach ($galleries as $item)
              <div class="time-label">
                <span class="bg-warning"><i class="nav-icon far fa-calendar-alt"></i> {{ date('d-M-Y',strtotime($item->created_at)) }}</span>
              </div>
             
             
              <!-- /.timeline-label -->
              <!-- timeline item -->
              
              <!-- END timeline item -->
              <!-- timeline item -->
              <div>
                <i class="fa fa-camera bg-danger"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> {{ date('M') }} </span>
                  <h3 class="timeline-header"><a href="#">{{ $item->judul }} </a> {{ $item->deskripsi }}</h3>
                  <div class="timeline-body">
                    <img src="{{ Storage::url($item->photo) }}" alt="..." height="300" width="300">
                  </div>
                  <div class="row mb-3">
                    <a href="" class="btn btn-success mr-3 edit" data-toggle="modal" data-target="#edit{{ $item->id }}"><span class="fas fa-edit"></span></a>
                    <form action="{{ route('gallery.destroy',$item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button id="delete" class="btn btn-danger mr-3" onclick="return confirm('Apakah Mau Dihapus?')"><span class="fas fa-trash can"></span></button>
                    <a href="{{ Storage::url($item->photo) }}" download="photo" class="btn btn-primary mr-3" onclick="return confirm('Apakah Mau Unduh?')"><span class="fas fa-download"></span></a>
                    

                  </div>
                </form>
                  <div class="modal fade" id="edit{{ $item->id }}">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Gallery Edit
                            </h4>
                            <button type="button" class="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{ route('gallery.update',$item->id) }}" method="post" enctype="multipart/form-data" id="formpost">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Isikan Judul Photo" value="{{ $item->judul }}">
                                    <span class="text-danger">
                                        @error('judul')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Isikan Deskripsi Photo" value="{{ $item->deskripsi }}">
                                    <span class="text-danger">
                                        @error('deskripsi')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Photo</label>
                                    <input type="file" name="photo" id="photo" class="form-control" placeholder="Silahkan Upload Photo" value="">
                                    <img src="{{ Storage::url($item->photo) }}" alt="...">
                                    <span class="text-danger">
                                        @error('photo')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fas fa-times"></i></button>
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i></button>
                                    </div>
                            </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
             
              <!-- END timeline item -->
              <!-- timeline time label -->
             
              <!-- /.timeline-label -->
              <!-- timeline item -->
              
              <!-- END timeline item -->
              <!-- timeline item -->
              
              <!-- END timeline item -->
              
            </div>
          </div>
          @endforeach
          <!-- /.col -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="baru">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                Gallery Baru
            </h4>
            <button type="button" class="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{ route('gallery.store') }}" method="post" enctype="multipart/form-data" id="formpost">
            @csrf
            <input type="hidden" name="id" id="id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" placeholder="Isikan Judul Photo" value="">
                    <span class="text-danger">
                        @error('judul')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Isikan Deskripsi Photo" value="">
                    <span class="text-danger">
                        @error('deskripsi')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control" placeholder="Silahkan Upload Photo" value="">
                    <span class="text-danger">
                        @error('photo')
                            {{ $message }}
                        @enderror
                    </span>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
  </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->

</body>
</html>
