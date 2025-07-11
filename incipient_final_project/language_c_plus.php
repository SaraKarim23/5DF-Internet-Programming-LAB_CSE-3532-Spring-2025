<?php
  session_start();
  if (!isset($_SESSION['username'])) {
    $username = "";
  } else {
    $username = htmlspecialchars($_SESSION['username']);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Instructors | INCIPIENT</title>
  <link rel="icon" type="image/jpeg" href="images/incipientlogo.jpeg">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

  <style>
    body {
      background-color: #000;
      font-family: 'Roboto', sans-serif;
      color: #fff;
      line-height: 1.6;
    }

    .navbar .nav-link, .navbar .btn {
      color: white !important;
      font-weight: 500;
    }

    .navbar-brand span {
      color: #0d6efd;
    }

    h4.a1 {
      color: #1ab2ff;
      margin-top: 30px;
      margin-bottom: 15px;
    }

    .pp1, .explanation {
      font-size: 1rem;
      color: #f0f0f0;
    }

    .code-box {
      background-color: #272822;
      color: #f8f8f2;
      padding: 15px;
      border-radius: 6px;
      font-family: monospace;
      white-space: pre-wrap;
      margin: 15px 0;
    }

    .a21 {
      margin-top: 10px;
    }

    footer {
      padding: 30px 0;
      text-align: center;
      color: white;
      border-top: 1px solid #666;
      margin-top: 40px;
    }

    .dropdown-menu {
      background-color: #222;
    }

    .dropdown-menu a {
      color: #fff;
    }

    .dropdown-menu a:hover {
      background-color: #0d6efd;
    }

    .form-control, .btn-outline-success {
      border-radius: 20px;
    }

    .btn-outline-primary:hover,
    .btn-outline-danger:hover {
      background-color: #0d6efd;
      color: #fff;
    }

    section {
      background-color: rgba(255, 255, 255, 0.05);
      padding: 25px;
      border-radius: 12px;
      margin-bottom: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    ul li {
      margin-bottom: 5px;
    }

    @media (max-width: 768px) {
      .navbar .btn {
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>

  <!-- Main Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark p-3">
    <div class="container-fluid">
      <a class="navbar-brand fs-1" href="index.php"><span>I</span>ncipient</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-2">
          <?php if ($username): ?>
            <li class="nav-item"><a class="btn btn-outline-primary" href="instractor.php">Our Instructor</a></li>
            <li class="nav-item"><a class="btn btn-outline-primary" href="langeluage_c.php">C</a></li>
            <li class="nav-item"><a class="btn btn-outline-primary" href="language_c_plus.php">C++</a></li>
            <li class="nav-item text-white mt-2">Hello, <?php echo $username; ?></li>
            <li class="nav-item"><a class="btn btn-outline-danger" href="logout.php">Logout</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="btn btn-outline-primary" href="login.php">Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Secondary Navbar -->
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent2">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="#">Back</a></li>
          <li class="nav-item"><a class="nav-link active" href="string.html">Next</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Topics
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#intro">Introduction</a></li>
              <li><a class="dropdown-item" href="#syn">Syntax & Statement</a></li>
              <li><a class="dropdown-item" href="#cmnt">Comment</a></li>
              <li><a class="dropdown-item" href="#vari">Variable & Data Type</a></li>
              <li><a class="dropdown-item" href="string.html">String</a></li>
              <li><a class="dropdown-item" href="if-else.html">If-Else, Switch-Case</a></li>
              <li><a class="dropdown-item" href="loop.html">Loop</a></li>
              <li><a class="dropdown-item" href="Array.html">Array</a></li>
              <li><a class="dropdown-item" href="function.html">Function</a></li>
              <li><a class="dropdown-item" href="classes.html">C++ Classes</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <div class="container my-5">
    <section id="intro">
      <h4 class="a1">C++ Introduction</h4>
      <p class="pp1">C++ is a widely-used programming language that builds on the foundation of C. It was introduced by Bjarne Stroustrup in the 1980s to support both procedural and object-oriented programming...</p>
      <p>To start C++, you need:</p>
      <ul>
        <li>A text editor like Notepad</li>
        <li>A compiler like GCC</li>
      </ul>
    </section>

    <section id="syn">
      <h4 class="a1">Syntax</h4>
      <p>Example Code:</p>
      <div class="code-box">
#include &lt;iostream&gt;
using namespace std;

int main() {
  cout &lt;&lt; "Hello World!";
  return 0;
}
      </div>
      <h5>Explanation</h5>
      <ul>
        <li><strong>#include &lt;iostream&gt;</strong>: includes standard I/O library</li>
        <li><strong>using namespace std</strong>: avoids typing std:: every time</li>
        <li><strong>int main()</strong>: program’s entry point</li>
        <li><strong>cout</strong>: prints text</li>
        <li><strong>return 0</strong>: exits the program</li>
      </ul>
    </section>

    <section id="cmnt">
      <h4 class="a1">Comment</h4>
      <p class="pp1">Comments help explain your code.</p>
      <p>Types:</p>
      <ul>
        <li><strong>// Single-line</strong></li>
        <li><strong>/* Multi-line */</strong></li>
      </ul>
      <div class="code-box">// This is a comment
cout << "Hello World";</div>
      <div class="code-box">/* This is a
multi-line comment */
cout << "Hello World";</div>
    </section>

    <section id="vari">
      <h4 class="a1">Variable & Data Type</h4>
      <h5>Variable:</h5>
      <p class="pp1">A variable is a named container for data in memory.</p>
      <div class="code-box">int age = 20;</div>
      <ul>
        <li><strong>int</strong>: type</li>
        <li><strong>age</strong>: name</li>
        <li><strong>20</strong>: value</li>
      </ul>
      <h5>Common Data Types</h5>
      <ul>
        <li><strong>int</strong> – whole numbers</li>
        <li><strong>float/double</strong> – decimal numbers</li>
        <li><strong>char</strong> – single character</li>
        <li><strong>string</strong> – text (needs <code>#include &lt;string&gt;</code>)</li>
        <li><strong>bool</strong> – true/false</li>
      </ul>
    </section>
  </div>

  <footer>
    &copy; 2025 INCIPIENT. All rights reserved.
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
