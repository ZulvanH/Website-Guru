<!DOCTYPE html>
<html>
<head>

	<title>Website Sekolah untuk Guru</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('NavbarStyle.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary navbar-with-shadow">
<div class="logo">
			<img src="{{ asset('logo.jpg') }}" alt="Logo Sekolah">
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
        <br>

       <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-headers">
                        <h4>Edit Courses </h4>
                        <a href="{{ url('Courses')}}" class="btn btn-sm btn-primary float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('update-course/'.$key)}}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- <select class="custom-select" id="kurikulum" name="kurikulum">
                            <option value="" disabled hidden>Kurikulum</option>
                            <option value="Nasional" {{ $editdata['kurikulum'] === 'Nasional' ? 'selected' : '' }}>Nasional</option>
                            <option value="ICGSE" {{ $editdata['kurikulum'] === 'ICGSE' ? 'selected' : '' }}>IGCSE</option>
                            <option value="A Level" {{ $editdata['kurikulum'] === 'A Level' ? 'selected' : '' }}>A Level</option>
                            <option value="Nasional Plus" {{ $editdata['kurikulum'] === 'Nasional Plus' ? 'selected' : '' }}>Nasional Plus</option>
                        </select>

                        <select class="custom-select" id="kelas" name="kelas" value ="{{$editdata['kelas']}}">
                            <option value="" disabled selected hidden>Kelas</option>
                            <option value="SD"  {{ $editdata['kelas'] === 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ $editdata['kelas'] === 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ $editdata['kelas'] === 'SMA' ? 'selected' : '' }}>SMA</option>
                        </select> --}}

                        <select class="custom-select" id="kelas" name="kelas">
                            <option value="" disabled selected hidden>Kelas</option>
                            <option value="1">SD Kelas 1</option>
                            <option value="2">SD Kelas 2</option>
                            <option value="3">SD Kelas 3</option>
                            <option value="4">SD Kelas 4</option>
                            <option value="5">SD Kelas 5</option>
                            <option value="6">SD Kelas 6</option>
                            <option value="7">SMP Kelas 7</option>
                            <option value="8">SMP Kelas 8</option>
                            <option value="9">SMP Kelas 9</option>
                            <option value="10">SMA Kelas 10</option>
                            <option value="11">SMA Kelas 11</option>
                            <option value="12">SMA Kelas 12</option>
                        </select>

                        <div class="form group mb-3">
                            <label>Course Name</label>
                            <input type="text" name="course_name" value ="{{$editdata['name_Course']}}" class="form-control">
                        </div>
                        <div class="form group mb-3">
                            <label>Description</label>
                            <input type="text" name="description" value ="{{$editdata['Course_description']}}" class="form-control">
                        </div>
                        <div class="form group mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        </form>
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
