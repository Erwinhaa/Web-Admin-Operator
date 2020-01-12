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
        <a href="#" class="brand-logo">Parkir Online</a>
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
    <section>
        @include('inc.message')
      <div class="container">
        <div class="row">
          <div class="col s6 offset-s3">
            <div class="col s12 blue">
              <h5 class="white-text center-align">Admin Login</h5>
            </div>    
            <form method="post" action="{{ route('admin.login.submit') }}">
                {{ csrf_field() }}
            <div class="col s12 white">
              <div class="col s12">
                <form class="col s12">
                  <div class="section"></div>

                  <div class="input-field">
                    <i class="material-icons prefix">mail_outline</i>
                    <input type="email" name="email" id="email" class="validate" required/>
                    <label for="email">E-mail Address</label>
                    <span
                      class="helper-text"
                      data-error="Wrong E-mail Format"
                      data-success=""
                    ></span>
                  </div>

                  <div class="input-field">
                    <i class="material-icons prefix">lock_outline</i>
                    <input type="password" name="password" id="password" class="validate" required/>
                    <label for="password">Password</label>
                  </div>

                  <div class="input-field center-align">
                    <button type="submit" class="btn waves-effect waves-light">Login</button>
                  </div>

                  
                  <div class="section"></div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </body>
</html>
