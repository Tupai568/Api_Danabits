@extends('header/header')
@section('container')
<main>
  <section>
    @include('notification')
    <div id="content">
      <div class="container-hasil">
        <div class="cild-container-hasil">
          <div class="info-profil">
            <div class="info-notif">
              <i class="bx bxs-bell" id="notif"></i>
            </div>
            <div class="info-user">
              <h3>{{ $saldo[0]['user']['name'] }}</h3>
              <div class="info-seting">
                <div class="item-seting">
                  <i class="bx bxs-cog"></i>
                  <span onclick="klikPadaSetting()">Account Setting</span>
                </div>
                <span>|</span>
                <div class="item-seting">
                  <i class="bx bx-right-arrow-circle"></i>
                  <span onclick="klikPadaSpan()">Logout</span>
                </div>
              </div>
            </div>
          </div>
          <div class="info-hasil">
            <!-- info rupiah -->
            <div class="list-hasil">
              <i class="bx bxs-shield-alt-2" style="color: #007bff"></i>
              <div class="cild-list">
                <h3>Account Balance</h3>
                <p style="color: #007bff">{{ number_format($saldo[0]['saldo'], 0, '.', ',') }} IDR</p>
              </div>
            </div>
            <!-- info dollar -->
            <div class="list-hasil">
              <i class="bx bx-dollar" style="color: green"></i>
              <div class="cild-list">
                <h3>Current $ Value</h3>
                <p style="color: green">${{ $usd }}</p>
              </div>
            </div>

            <!-- info member -->
            <div class="list-hasil">
              <i class="bx bxs-star" style="color: green"></i>
              <div class="cild-list">
                <h3>Membership</h3>
                <p style="color: green">Basic</p>
              </div>
            </div>

            <!-- info time -->
            <div class="list-hasil">
              <i class="bx bx-time-five" style="color: #007bff"></i>
              <div class="cild-list">
                <h3>Valid until</h3>
                <p style="color: #007bff">Forever</p>
              </div>
            </div>
          </div>
          <button class="withdraw">WITHDRAW</button>
        </div>
        <div class="cild-container-hasil">
          <div class="bonus-level">
            <h3>Level {{ $level[1] }} <span>/ Level 30</span></h3>
            <p class="multi">Faucet Multiplier x1.00</p>
            <div class="claim-level">
              <p>{{ $level[0] }} claims you level {{ $level[1] }}</p>
            </div>
            <p>Your Total Claim: <span>{{ $total['total_claim'] }} claims</span></p>
            <a href="" type="button"> Faucet Level</a>
          </div>
        </div>
      </div>
      <div class="container-faucet">
        <div class="cild-faucet">
          <div class="roll-faucet">
            <table>
              <thead>
                <tr>
                  <th scope="col">Lucky Number</th>
                  <th scope="col">Reward</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Roll 1 to 89,999</td>
                  <th scope="row">20 IDR</th>
                </tr>
                <tr>
                  <td>Roll 90,000 to 94,999</td>
                  <th scope="row">30 IDR</th>
                </tr>
                <tr>
                  <td>Roll 95,000 to 99,499</td>
                  <th scope="row">40 IDR</th>
                </tr>
                <tr>
                  <td>Roll 99,500 to 99,996</td>
                  <th scope="row">50 IDR</th>
                </tr>
                <tr>
                  <td>Roll 99,997 to 99,998</td>
                  <th scope="row">60 IDR</th>
                </tr>
              </tbody>
            </table>
            <div class="jackpot">
              <h3>99,999 = Jackpot of RP: 1000!</h3>
            </div>
          </div>
        </div>

        <div class="cild-faucet">
          <div class="spin-faucet">
            <h3>Claim FREE Dana every 5 minutes</h3>
            <div id="timer">
            </div>
            {!! NoCaptcha::renderJs() !!}
            <form action="auth/claim" method="post" class="form-run">
              @csrf
              {!! NoCaptcha::display() !!}
              <button type="submit">ROLL NOW</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@include('footer.footer_dasboard')
@endsection




