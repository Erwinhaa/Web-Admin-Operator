<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <!--Import materialize.css-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
    />
    <!-- Import Own CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <nav>
      <div class="nav-wrapper orange darken-3">
        <a href="/" class="brand-logo">Parkir Online</a>
        <ul id="nav-mobile" class="right">
          <li>
            <a href="/admin/login" class="waves-effect waves-light btn orange darken-1"
              ><i class="material-icons left">person</i> Login as Admin</a
            >
          </li>
          <li>
            <a href="/operator/login" class="waves-effect waves-light btn orange darken-1"
              ><i class="material-icons left">people</i>Login as Operator</a
            >
          </li>
        </ul>
      </div>
    </nav>

    <header>
      <div class="showcase">
        <div class="showcase-content">
          <h1 class="white-text">Manajemen Aplikasi Parkir Online</h1>
         
        </div>
      </div>
    </header>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </body>
</html>
