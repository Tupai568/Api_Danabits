<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DanaBits-Earn Free Dana</title>
    <link rel="stylesheet" href="{{ asset('css/dasboard.css') }}" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
    <nav class="navbar">
      <div class="logo">
        <img src="{{ asset('image/dana.png'); }}" alt="dana_image" />
        <a href="">
          <h2>Dana<span>Bits</span></h2>
        </a>
      </div>
      <div class="navbar-list">
        <div class="list-item">
          <div class="list-judul">
            <i class="bx bx-bitcoin"></i>
            <span>Earn Dana</span>
          </div>
          <ul class="list-content">
            <a href="/"
              ><li><i class="bx bx-bitcoin"></i> <span>Faucet</span></li>
            </a>
            <a href="/shortlink"
              ><li><i class="bx bx-link"></i> <span>Shortlinks</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-send"></i> <span>PTC Ads</span></li>
            </a>
          </ul>
        </div>
        <div class="list-item">
          <div class="list-judul">
            <i class="bx bxs-book-content"></i>
            <span>OfferWalls</span>
          </div>

          <ul class="list-content">
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>Bitlabs</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>CPX Research</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>TimeWall</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>Monlix</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>Wannads</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>WannaSurvey</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>Bitcotask</span></li>
            </a>
            <a href=""
              ><li>
                <i class="bx bx-list-ul"></i> <span>Offerwallmedia</span>
              </li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>Offers4crypto</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>Dripoffers</span></li>
            </a>
            <a href=""
              ><li><i class="bx bx-list-ul"></i> <span>Offerwhales</span></li>
            </a>
          </ul>
        </div>
        <div class="list-item">
          <div class="list-judul">
            <i class="bx bxs-group"></i>
            <span>Refferal</span>
          </div>
        </div>
        <div class="list-item">
          <div class="list-judul">
            <i class="bx bx-menu"></i>
            <span>More</span>
          </div>

          <ul class="list-content">
            <a href=""
              ><li><i class="bx bx-bitcoin"></i> <span>History</span></li>
            </a>
            <a id="setting" href="/setting"
              ><li>
                <i class="bx bxs-cog"></i>
                <span>Setting</span>
              </li>
            </a>
            <a id="logout" href="/logout"
              ><li>
                <i class="bx bx-right-arrow-circle"></i> <span>Logout</span>
              </li>
            </a>
          </ul>
        </div>
      </div>
      <i class="bx bx-menu" id="menu" onclick="navbarClick()"></i>
    </nav>
    @yield('container')