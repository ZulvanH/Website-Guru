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
        @if(session('success'))
        <h4 class="alert alert-warning mb-2">{{session('success')}}</h4>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-6">
                <main class="form-register">
                    <form action="/update" method="post">
                        @method('put')
                        @csrf
                         <h1 class="h3 mb-3 fw-normal">Change Password</h1>
                         <div class="form-floating">
                            <input type="text" name="name" value ="{{$user['username']}}" class="form-control">
                             <label for="name">User Name</label>
                             @error('name')
                                 <div class="invalid-feedback">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>
                         <br>
                         <div class="form-floating">
                             <input type="password" name="password" class="form-control" >
                             <label for="password">Password</label>
                             @error('password')
                                 <div class="invalid-feedback">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>
                         <br>
                         <div class="form-floating">
                             <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror mt-2" id="password_confirmation" placeholder="Confirm Password" required>
                             <label for="password_confirmation">Confirm Password</label>
                             @error('password')
                                 <div class="invalid-feedback">
                                     {{ $message }}
                                 </div>
                             @enderror
                         </div>
                         <br>
                         <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>
                    </form>
                </main>
            </div>
        </div>
        <br><br>
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
