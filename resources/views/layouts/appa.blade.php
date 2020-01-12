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
    <!-- Import own CSS -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <!-- Import PopOver CDN -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css"
    />
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <!-- Navigation Part -->
    <nav>
      <div class="nav-wrapper orange darken-3">
        <a href="#" class="brand-logo left">Parkir Online</a>
        <ul id="nav-mobile" class="left">
          <li>
            <a href="#" class="waves-effect waves-light white-text"
              ><i class="material-icons left">view_comfy</i> Kustomisasi Layout
            </a>
          </li>
          <li>
            <a href="#" class="waves-effect waves-light  white-text"
              ><i class="material-icons left">monetization_on</i>History
              Saldo</a
            >
          </li>
          

          <li>
            <a href="#" class="waves-effect waves-light  white-text"
              ><i class="material-icons left">library_books</i>Laporan
              Keuangan</a
            >
          </li>
          <li>
            <a
              href="#!"
              class="waves-effect waves-light  white-text dropdown-trigger"
              data-target="dropdown1"
              data-beloworigin="true"
              ><i class="material-icons right">arrow_drop_down</i>Detail</a
            >
          </li>
          <!-- Dropdown Content -->
          <ul id="dropdown1" class="dropdown-content">
            <li>
              <a href="#!"
                ><i class="material-icons left">group</i>Detail Operator</a
              >
            </li>
            <li class="divider"></li>
            <li>
              <a href="#!"
                ><i class="material-icons left">face</i>Detail User</a
              >
            </li>
            <li class="divider"></li>
            <li>
              <a href="#!"
                ><i class="material-icons left">confirmation_number</i>Detail
                Ticket</a
              >
            </li>
          </ul>
        </ul>

        <!-- Parkirman -->

        <ul id="nav-mobile" class="right">
          <li>
            <span class="new badge red">2</span
            ><i class="material-icons" id="notif">notifications</i>
          </li>
          <li>
            <a
              href="#!"
              id="logout"
              class="waves-effect waves-light  white-text dropdown-trigger"
              data-target="dropdown2"
              data-beloworigin="true"
              ><i class="material-icons left">account_circle</i>Parkirman</a
            >
          </li>
        </ul>
      </div>
    </nav>


        <main class="py-4">
            @include('inc.message')
            @yield('content')
        </main>
    </div>

</body>
</html>
