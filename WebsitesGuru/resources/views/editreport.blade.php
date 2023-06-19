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
                            <h4>Grading Student Work</h4>
                            <a href="Report" class="btn btn-sm btn-primary float-end">Back</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('update-report/'.$key)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form group mb-3">
                                    <p><strong>Assignment Name:</strong></p>
                                    {{$editdata['name']}}

                                </div>
                                <div class="form group mb-3">
                                    <p><strong>Description</strong></p>
                                    @if (isset($editdata['description']))
                                    {{$editdata['description']}}
                                @else
                                    empty
                                @endif
                                </div>
                                <div class="form group mb-3">
                                    <p><strong>Soal</strong></p>
                                <a href="{{$editdata['SoalUrl']}}" target="_blank" class="btn-viewedit">View</a>
                            </div>
                                <div class="form group mb-3">
                                    <p><strong>Jawaban</strong></p>
                                <a href="{{$editdata['fileUrl']}}" target="_blank" class="btn-viewedit">View</a>
                            </div>
                            <div class="form group mb-3">
                                <p><strong>Score</strong></p>
                                @if (isset($editdata['score']))
                            <input type="text" name="score"  value ="{{$editdata['score']}}" class="form-control">
                            @else
                            <input type="text" name="score"  class="form-control">
                            @endif
                        </div>
                        <div class="form group mb-3">
                            <p><strong>Comment</strong></p>
                            @if (isset($editdata['comment']))
                        <input type="text" name="comment" value ="{{$editdata['comment']}}" class="form-controldescription">
                        @else
                        <input type="text" name="comment"  class="form-controldescription">
                        @endif
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
