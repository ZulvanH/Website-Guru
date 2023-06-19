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
		<!-- <td><h1>Dashboard</h1></td> -->



        @if(session('status'))
        <h4 class="alert alert-success alert-custom mb-2">{{session('status')}}</h4>
        @endif

        <br>

        <h1></h1>
        <h1></h1>
        <div class="con">
        <div class="text-box">
            <p class="centered-text">New Article / Announcement</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam rutrum odio sit amet felis condimentum, eu elementum leo fringilla. Vivamus in nulla vel lectus ultrices pellentesque. Suspendisse aliquet tellus at nisl consequat tristique.</p>
</div>
</div>
<br>
<br>
<div class="con">
        <div class="text-box">
            <p class="centered-text">Upcoming Teaching Class Session</p>
            @php $i=1; @endphp
            @if ($schedule)
            @foreach ($schedule as $schedules)
  <p>{{$i++}}. {{ $schedules['schedule_title'] }} {{ $schedules['date'] }} {{ $schedules['StartTime'] }}</p>
  @endforeach
  @endif
</div>
</div>
<br>
<br>

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
