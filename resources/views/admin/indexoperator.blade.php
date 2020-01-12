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
    <link rel="stylesheet" href="css/style.css" />
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
    <!-- End of Nav -->

    <section>
      <div class="row">
        <div class="col s12 red">
          <p><i class="material-icons left">report_problem</i>Sook ma deek</p>
        </div>
      </div>

      <div class="container">
        <div class="row">
          
            <div class="row">
              <div class="col s6 white">
                <div class="row">
                  <div class="col s12 blue white-text">
                    <h5>Lantai 1</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col s1 grey offset-s3">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                </div>
                <div class="row">
                  <div class="col s1 grey offset-s3">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                </div>
                <div class="row">
                  <div class="col s1 grey offset-s3">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                </div>
                <div class="row">
                  <div class="col s1 grey offset-s3">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                  <div class="col s1 grey offset">1</div>
                </div>
              </div>
              <div class="col s6 white offset-s1"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="fixed-action-btn">
      <a class="btn-floating btn-large red">
        <i class="large material-icons">mode_edit</i>
      </a>
      <ul>
        <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
        <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
        <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
        <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
      </ul>
    </div>

    <!-- PopOver Content -->
    <div id="logout-container" class="webui-popover-content">
      <a href="#">Logout</a>
    </div>

    <div id="notif-container" class="webui-popover-content">
      <div class="section"><a href="#">Lorem ipsum dolor sit amet.</a></div>

      <div class="divider"></div>
      <div class="section"><a href="#">Lorem ipsum dolor sit amet.</a></div>
    </div>
    <!--JavaScript at end of body for optimized loading-->
    <script
      src="https://code.jquery.com/jquery-3.4.1.min.js"
      integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
      crossorigin="anonymous"
    ></script>
    <!-- Materialize CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <!-- PopOver CDN -->
    <script src="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.js"></script>
    <script>
      (function($) {
        //Start of doc ready
        $(function() {
          $('.dropdown-trigger').dropdown({
            inDuration: 300,
            outDuration: 225,
            hover: true, // Activate on hover
            coverTrigger: false, // Displays dropdown below the button
            alignment: 'center' // Displays dropdown with edge aligned to the left of button
          });
        }); // End Document Ready
        $('#logout').webuiPopover({
          url: '#logout-container',
          trigger: 'hover',
          animation: 'pop'
        });
        $('#notif').webuiPopover({
          url: '#notif-container',
          trigger: 'hover',
          animation: 'pop'
        });
        $('.fixed-action-btn').floatingActionButton();
      })(jQuery); // End of jQuery name space
    </script>
  </body>
</html>
