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
    <h1>Discussion Detail</h1>
    <div class="color-box"></div>

    @if ($forum)
        <div class="forum-info">
            <p>Date: {{ $forum['date'] }}</p>

            <h2>{{ $forum['topic_title'] }}</h2>
            <p>{{ $forum['topic_content'] }}</p>
        </div>
    @endif

    <br>
    <br>

    <h2>Comments</h2>
    <div class="comments">
        @if ($comments)
            @foreach ($comments as $comment)
                <div class="comment">
                    <div class="comment-header">
                        <p>Posted by {{ $comment['user_name'] }} on {{ $comment['timestamp'] }}</p>
                    </div>
                    <div class="comment-content">
                        <p>{{ $comment['cooment_content'] }}</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="new-comment">
        <h2>Add a Comment</h2>
        <form action="{{ url('add-comment/' .$forum['forum_id'])}}" method="POST">
            @csrf
            <div class="form-group2">
                <label for="name">Name:</label>
                <input type="text" id="name" name="user_name" required>
            </div>

            <div class="form-group2">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
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
