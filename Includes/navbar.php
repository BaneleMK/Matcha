<?php 
      $location = getcwd();
      //$loc = end(explode( '\\' , $location));
      $loc = end(explode( '/' , $location));
      $folders = array('login', 'signup', 'user');
      $arr = in_array($loc, $folders);

        if (!$arr) {
          echo '
          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Matcher</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent" >
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="/'.$loc.'/user/profile.php">User <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/'.$loc.'/user/chatselect.php">Chat</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/'.$loc.'/user/socialtab.php">Social tab</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/'.$loc.'/user/match-me-settings.php">Match-Me-Now</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Account
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    if (isset($_SESSION['id'])) {
                      echo '<a class="dropdown-item" href="/'.$loc.'/login/logout.php">Log out</a>';
                    } else {
                      echo '<a class="dropdown-item" href="/'.$loc.'/login/login.php">Log in</a>
                      <a class="dropdown-item" href="/'.$loc.'/signup/signup.php">Sign up</a>
                      <a class="dropdown-item" href="/'.$loc.'/signup/forgotpasswordinfo.php">forgot password</a>';
                    }
                  echo '</div>
                </li>
              </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContenti" >
            </div>
          </nav>';
          } else {
          echo '
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <a class="navbar-brand" href="../index.php">Matcher</a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                      </button>
                    
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                          <li class="nav-item active">
                            <a class="nav-link" href="../user/profile.php">User <span class="sr-only">(current)</span></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../user/chatselect.php">Chat</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../user/socialtab.php">Social tab</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="../user/match-me-settings.php">Match-Me-Now</a>
                          </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Account
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">';

                              if (isset($_SESSION['id'])) {
                                echo '<a class="dropdown-item" href="../login/logout.php">Log out</a>';
                              } else {
                                echo '<a class="dropdown-item" href="../login/login.php">Log in</a>
                                <a class="dropdown-item" href="../signup/signup.php">Sign up</a>
                                <a class="dropdown-item" href="../signup/forgotpasswordinfo.php">forgot password</a>';
                              }

                          echo  '</div>
                          </li>
                        </ul>
                      </div>
                    </nav>';
              }