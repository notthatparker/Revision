<?php

function call_header()
{

    return '<header class="site-navbar site-navbar-target" role="banner">

    <div class="container">
      <div class="row align-items-center position-relative">

        <div class="col-3 ">
          <div class="site-logo">
            <a href="/" class="font-weight-bold"><img style="width: 15%" src="icons_new/logo/icon1.png"></a>
          </div>
        </div>

        <div class="col-9  text-right">
          

          <span class="d-inline-block d-lg-none"><a href="#" class="text-primary site-menu-toggle js-menu-toggle py-5"><span class="icon-menu h3 text-primary"></span></a></span>

          

          <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
            <ul class="site-menu main-menu js-clone-nav ml-auto ">
              <li><a href="/" class="nav-link">Home</a></li>
              <li><a href="about.html" class="nav-link">Our Story</a></li>
              <li><a href="try.php" class="nav-link">Try Beta</a></li>
            </ul>
          </nav>
        </div>
        
      </div>
    </div>

  </header>';
}

?>