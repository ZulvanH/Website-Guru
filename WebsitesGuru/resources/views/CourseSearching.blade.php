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
        <br>


       <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                <h4 class="alert alert-warning mb-2">{{session('status')}}</h4>
                @endif


        {{-- <div class="input-group mb-3"> --}}
            <form action="{{ url('search')}}" method="GET">
            {{-- <select class="custom-select" id="subject" name="subject">
                <option value="" disabled selected hidden>Mata Pelajaran</option>
                <option value="Pendidikan Agama">Pendidikan Agama</option>
                <option value="PKN">PKN</option>
                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                <option value="Pendidikan Jasmani Olahraga">Olahraga</option>
                <option value="Bahasa Inggris">Bahasa Inggris</option>
                <option value="Matematika">Matematika</option>
                <option value="Fisika">Fisika</option>
                <option value="Kimia">Kimia</option>
                <option value="Biologi">Biologi</option>
                <option value="Geografi">Geografi</option>
                <option value="Ekonomi">Ekonomi</option>
                <option value="Sosiologi">Sosiologi</option>
                <option value="Seni Budaya">Seni Budaya</option>
                <option value="Sejarah">Sejarah</option>
                <option value="Teknologi dan Informasi">Teknologi dan Informasi</option>
            </select> --}}
            {{-- </div> --}}

            {{-- <select class="custom-select" id="kelas" name="kelas">
                <option value="" disabled selected hidden>Kelas</option>
                <option value="SD Kelas 1">SD Kelas 1</option>
                <option value="SD Kelas 2">SD Kelas 2</option>
                <option value="SD Kelas 3">SD Kelas 3</option>
                <option value="SD Kelas 4">SD Kelas 4</option>
                <option value="SD Kelas 5">SD Kelas 5</option>
                <option value="SD Kelas 6">SD Kelas 6</option>
                <option value="SMP Kelas 7">SMP Kelas 7</option>
                <option value="SMP Kelas 8">SMP Kelas 8</option>
                <option value="SMP Kelas 9">SMP Kelas 9</option>
                <option value="SMA Kelas 10">SMA Kelas 10</option>
                <option value="SMA Kelas 11">SMA Kelas 11</option>
                <option value="SMA Kelas 12">SMA Kelas 12</option>
            </select> --}}


            {{-- <select class="custom-select" id="subject" name="subject">
                <option value="" disabled selected hidden>Level</option>
                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>
            </select> --}}

            <div class="search-container">
            <input type="text"  class =" float-end" name="query" placeholder="Search..." enctype="multipart/form-data">
            <button class ="btn btn-sm btn-primary float-end" type="submit">Search</button>
        </div>
    </form>

        <div class="wrapper">
                <div class="card">
                    <div class="card-headers">
                        <h4>Courses List</h4>
                        <a href="add-course" class="btn btn-sm btn-primary float-end">Add Course</a>
                    </div>
                    <div class="card-body">
                       <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>View</th>
                                {{-- <th>Kelas</th>
                                <th>Mata Pelajaran</th>

                                <th>File</th>
                                <th>Thumbnail</th>
                                <th>YoutubeUrl</th> --}}
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @forelse ($results as $key => $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item['name_Course']}}</td>
                                    <td>{{$item['Course_description']}}</td>
                                    <td><a href="{{ url('CourseDetail/'.$item['course_id']) }}" target="_blank" class="btn-view">View</a></td>
                                    <td><a href="{{ url('edit-course/'.$item['course_id']) }}" class="btn btn-sm btn-success">Edit</a></td>
                                    <td><a href="{{ url('delete-course/'.$item['course_id']) }}" class="btn btn-sm btn-danger">Delete</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No Record Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                       </table>
                    </div>
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
