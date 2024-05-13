<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DanaBits-Earn Free Dana</title>
    <link rel="stylesheet" href="{{ asset('css/style.css'); }}">

    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body class="silentScrol">
    <nav class="navbar">
      <div class="logo">
        <img src="{{ asset('image/dana.png'); }}" alt="dana_image" />
        <a href="">
          <h2>Dana<span>Bits</span></h2>
        </a>
      </div>
      <div class="loginOrSigup">
        <div class="tombolLogin" onclick="clickLogin()">
          <i class="bx bxs-arrow-to-right"></i>
          <p>Login</p>
        </div>
        <div class="tombolSigup" onclick="clickRegister()">
          <i class="bx bxs-arrow-to-right"></i>
          <p>Sigup</p>
        </div>
      </div>
      <i class="bx bx-menu" id="menu"></i>
    </nav>
    <main>
      <section class="utama">
        <div class="container">
          <div class="formLogin">
            <h1>Member Login</h1>
            <i class="bx bx-x" id="cancel" onclick="cancelX()"></i>
            {!! NoCaptcha::renderJs() !!}
            <form action="/auth/login" method="post">
              <div class="formInput">
                @csrf
                <i class="bx bxs-user" id="user"></i>
                <input
                  type="text"
                  name="LoginUsername"
                  placeholder="Username"
                  class="input"
                />
              </div>
              <div class="formInput">
                <i class="bx bxs-lock-alt" id="gembok"></i>
                <input
                  type="password"
                  name="loginPassword"
                  placeholder="Password"
                  class="input"
                  id="myPassword"
                />
                <i
                  class="bx bxs-show"
                  id="show"
                  onclick="showHidenPassword()"
                ></i>
              </div>
              {!! NoCaptcha::display() !!}
              <input type="checkbox" name="remember"/>
              <span>Keep me logged in for 1 week</span>
              <button type="submit">Login</button>
            </form>
            <div class="forgotPassword">
              <a href="">Forgotten password?</a>
            </div>
          </div>
          <div class="formRegister">
            <h1>Register</h1>
            <i class="bx bx-x" id="cancel" onclick="cancelX()"></i>
            <form action="/auth/register" method="post">
              @csrf
              <div class="formInput">
                <i class="bx bxs-envelope" id="email"></i>
                
                <input
                  type="email"
                  name="registerEmail"
                  placeholder="Email"
                  class="input"
                />
              </div>

              <div class="formInput">
                <i class="bx bxs-user" id="user"></i>
                <input
                  type="text"
                  name="registerUsername"
                  placeholder="Username"
                  class="input"
                />
              </div>

              <div class="formInput">
                <i class="bx bxs-lock-alt" id="gembok"></i>
                <input
                  type="password"
                  name="registerPassword"
                  placeholder="Password"
                  class="input"
                  id="passwordRegister"
                />
                <i
                  class="bx bxs-show"
                  id="showRegister"
                  onclick="showHidenPasswordRegister()"
                ></i>
              </div>

              {!! NoCaptcha::display() !!}

              <input type="checkbox" />
              <span
                >I have read and agree to abide by the Terms of Service and
                Privacy policy
              </span>
              <button type="submit">Register</button>
            </form>
            <div class="forgotPassword">
              <a href="">Forgotten password?</a>
            </div>
          </div>
        </div>

        @include('notification')
        <!-- <div class="container"> -->
        <div class="item">
          <h2 class="textEarn">Earn FREE Dana</h2>
          <p>
            Join the most complex, secure and paying dana faucet & rewards site
            and earn thousands of dana every day.
          </p>
          <button class="join" onclick="clickRegister()">JOIN NOW!</button>
          <h2 class="textLogDana">GET SOME FREE</h2>
          <div class="logDana">
            <img src="{{ asset('image/dana.png'); }}" alt="dana_image" />
            <h1>SALDO DANA</h1>
          </div>
          <div class="workDana">
            <h2 class="textWorkDana">How it works?</h2>
            <div class="rules">
              <div class="rulesEarn">
                <h1>REGISTER</h1>
                <hr class="global" />
                <p>It takes less than a minute to join us!</p>
              </div>
              <div class="rulesEarn">
                <h1>EARN DANA</h1>
                <hr class="global" />
                <p>
                  Claim free Bits every 5 minutes, complete offers and many
                  more!
                </p>
              </div>
              <div class="rulesEarn">
                <h1>Withdraw DANA</h1>
                <hr class="global" />
                <p>We have many withdrawal methods!</p>
              </div>
            </div>
            <h2 class="textWorkDana">What are the withdrawal methods?</h2>
            <div class="walet">
              <div class="waletOne">
                <h1>PAYPAL</h1>
                <hr class="global" />
                <h1>BINANCE</h1>
                <hr class="global" />
                <h1>PAYEER</h1>
                <hr class="global" />
              </div>
              <div class="waletOne">
                <h1>DANA</h1>
                <hr class="global" />
                <h1>OVO</h1>
                <hr class="global" />
                <h1>GOPAy</h1>
                <hr class="global" />
              </div>
              <div class="waletOne">
                <h1>SHOPEE PAY</h1>
                <hr class="global" />
                <h1>LINK AJA</h1>
                <hr class="global" />
                <h1>I-SAKU</h1>
                <hr class="global" />
              </div>
            </div>
          </div>
        </div>
        <!-- </div> -->
        <div class="container-betwen">
          <div class="advertisers">
            <h1>Advertisers</h1>
            <hr class="global" />
            <ul>
              <li>Get referrals or affiliates to any program</li>
              <li>Effortlessly build a massive downline fast</li>
              <li>Generate potential leads, sales or opt-ins</li>
              <li>Get your site or blog known online</li>
            </ul>
          </div>
          <div class="advertisers">
            <h1>Members</h1>
            <hr class="global" />
            <ul>
              <li>Earn up to 40% from your referrals claims</li>
              <li>Earn FREE DANA every 5 minutes</li>
              <li>Fast withdrawal up to 1 day</li>
              <li>Receive into your wallet</li>
            </ul>
          </div>
        </div>
        <div class="blur"></div>
      </section>
    </main>

    <script>
      const loginOrSigup = document.querySelector(".loginOrSigup");
      const login = document.querySelector(".formLogin");
      const register = document.querySelector(".formRegister");
      const blur = document.querySelector(".blur");
      const myPassword = document.getElementById("myPassword");
      const passwordRegister = document.getElementById("passwordRegister");
      const show = document.getElementById("show");
      const menu = document.getElementById("menu");
      const showRegister = document.getElementById("showRegister");

      menu.addEventListener("click", () => {
        menu.classList.toggle("bx-x");
        loginOrSigup.classList.toggle("active");
        login.classList.remove("active");
        blur.classList.remove("active");
        register.classList.remove("active");
      });

      function showHidenPassword() {
        if (show.className == "bx bxs-show") {
          show.className = "bx bxs-low-vision";
          myPassword.type = "text";
        } else if (show.className == "bx bxs-low-vision") {
          show.className = "bx bxs-show";
          myPassword.type = "password";
        }
      }

      function showHidenPasswordRegister() {
        if (showRegister.className == "bx bxs-show") {
          showRegister.className = "bx bxs-low-vision";
          passwordRegister.type = "text";
        } else if (showRegister.className == "bx bxs-low-vision") {
          showRegister.className = "bx bxs-show";
          passwordRegister.type = "password";
        }
      }

      function cancelX() {
        login.classList.remove("active");
        blur.classList.remove("active");
        register.classList.remove("active");
      }

      function clickLogin() {
        blur.classList.toggle("active");
        login.classList.toggle("active");
        register.classList.remove("active");
      }

      function clickRegister() {
        blur.classList.toggle("active");
        login.classList.remove("active");
        register.classList.toggle("active");
      }

      blur.addEventListener("click", () => {
        blur.classList.toggle("active");
        login.classList.remove("active");
        register.classList.remove("active");
      });

      document.addEventListener('DOMContentLoaded', function () {
        let notification = document.getElementById('notification');
        if (notification) {
          setTimeout(function () {
            notification.classList.add('fade-in-out');
            notification.addEventListener('animationend', function() {
              notification.style.display = 'none';
            });
          }, 3000);
        }
      });
    </script>
  </body>
</html>
