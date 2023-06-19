<!DOCTYPE html>
<html>
<head>
	<title>Website Sekolah untuk Guru</title>
	<link rel="stylesheet" type="text/css" href="NavbarStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-with-shadow">
<div class="logo">
			<img src="logo.jpg" alt="Logo Sekolah">
		</div>
  <div class="container-fluid">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Courses">Courses</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Assignment">Assignment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Exam">Exam</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Discussion">Discussion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Report">Report</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/Schedule">Schedule</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
     <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profile
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="/Beranda">Dashboard</a></li>
            <li><a class="dropdown-item ml-auto" href="/updateprofile">Change Password</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/index">Log Out</a></li>
          </ul>
          </ul>
    </div>

  </div>
</nav>
	<main>
        <br>


        <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                <h4 class="alert alert-warning mb-2">{{session('status')}}</h4>
                @endif

                <form action="{{ url('searchAssignment')}}" method="GET">
                    <div class="search-container float-end">
                        <input type="text" name="query" placeholder="Search..." enctype="multipart/form-data">
                        <button class="btn btn-sm btn-primary" type="submit">Search</button>
                    </div>
                </form>
                <br>
                <br>

                <div class="card">
                    <div class="card-headers">
                        <h4>Assignment List</h4>
                        <a href="add-assignment" class="btn btn-sm btn-primary float-end">Add Assignment</a>
                    </div>
                    <div class="card-body">
                       <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Jenis Assignment</th>
                                <th>Kelas</th>
                                <th>File Soal</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @forelse ($Assignment as $key => $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item['name']}}</td>
                                    <td>
                                        @if (array_key_exists('kelas', $item))
                                          {{$item['kelas']}}
                                        @else
                                            Kelas is Empty
                                        @endif
                                    </td>
                                    <td>
                                        @if (array_key_exists('SoalUrl', $item))
                                            <a href="{{$item['SoalUrl']}}" target="_blank" class="btn-view">View</a>
                                        @else
                                            File not available
                                        @endif
                                    </td>
                                    <td><a href="{{ url('edit-assignment/'.$key) }}" class="btn btn-sm btn-success">Edit</a></td>
                                    <td><a href="{{ url('delete-assignment/'.$key) }}" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                       </table>
                    </div>
                </div>
            </div>
        </div>
       </div>
        <h1></h1>
        <h1></h1>
        <footer>
            <div class="container">
                <div class="row">
            <div class="copy">
                <div class="container">
                    <div class="row">
                        <div class="col-20">
                            <p>&copy; 2023 Sekolah.com | All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
	</main>


</body>
</html>
