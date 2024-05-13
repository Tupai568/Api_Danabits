<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<script>
    const navbar = document.querySelector(".navbar .navbar-list");
    const listItem = document.querySelectorAll(
      ".navbar .navbar-list .list-item"
    );
    const allContent = document.querySelectorAll(
      ".navbar .navbar-list .list-item .list-content"
    );
    const menu = document.getElementById("menu");

    listItem.forEach((item) => {
      item.addEventListener("click", () => {
        const listContent = item.querySelector(".list-content");
        listContent.classList.toggle("active");
      });
    });

    function navbarClick() {
      menu.classList.toggle("bx-x");
      navbar.classList.toggle("active");
      allContent.forEach((deleteContent) => {
        deleteContent.classList.remove("active");
      });
    }

    function klikPadaSpan() {
        // Men-trigger klik pada tombol lain
        document.getElementById('logout').click();
    }

    function klikPadaSetting() {
        // Men-trigger klik pada tombol lain
        document.getElementById('setting').click();
    }

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


    $.ajax({
      type: 'GET',
      url: '/time/claim',
      success: function(response) {
          
        if (response) {
            const formattedTime = response.replace(/-/g, '/') + ' UTC';
            const startTimeFromServer = new Date(formattedTime).getTime(); // Sesuaikan dengan format yang diharapkan
            const waitTime = 5 * 60 * 1000;
            const endTime = startTimeFromServer + waitTime;

            let countdownInterval;
            function updateCountdown() {
                const currentTime = new Date().getTime();
                const timeDifference = endTime - currentTime;
                const timer = $('#timer')[0];
                const spanElement = $(timer).html();
                const claim = $('.form-run')[0];

                if (timeDifference <= 0) {
                    timer.style.display = 'none';
                    claim.style.display = 'flex';
                    clearInterval(countdownInterval); // Hentikan interval jika waktu tunggu selesai
                  } else {
                    const minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);
                    timer.style.display = 'block';
                    claim.style.display = 'none';
                    $('#timer').html(`<span>waiting ${minutes} menit ${seconds} detik</span>`);
                }
            }

            // Pertama kali, panggil fungsi untuk menginisialisasi tampilan countdown
            updateCountdown();

            // Kemudian, atur interval untuk memperbarui countdown setiap detik
            countdownInterval = setInterval(updateCountdown, 1000);
        }
      },
      error: function(error) {
          console.log('gagal request');
      }
    });


  </script>
</body>
</html>