<!-- <script type="text/javascript" src="<?= base_url() ?>assets/vendor/floating-whatsapp/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/vendor/floating-whatsapp/floating-wpp.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener('scroll', function() {
      if (window.scrollY > 1) {
        document.getElementById('navbarscrl').classList.add('fixed-top');
        // add padding top to show content behind navbar
        navbar_height = document.querySelector('.navbar').offsetHeight;
        document.body.style.paddingTop = navbar_height + 'px';
      } else {
        document.getElementById('navbarscrl').classList.remove('fixed-top');
        // remove padding top from body
        document.body.style.paddingTop = '0';
      }
    });
  });
</script>

<script type="text/javascript">
  // $(function() {
  //   $('#waButton').floatingWhatsApp({
  //     phone: '08080808',
  //     message: "Saya mau sewa ...",
  //     showPopup: true,
  //     popupMessage: 'Hallo, Mau memakai kamera apa hari ini?',
  //     showOnIE: false,
  //     headerTitle: 'Welcome!',
  //     buttonImage: '<img src="<?= base_url() ?>assets/vendor/floating-whatsapp/whatsapp.svg" />'
  //   });
  // });


  // $(function() {

  //   var start = moment().subtract(29, 'days');
  //   var end = moment();

  //   function cb(start, end) {
  //     $('#tangal').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
  //   }

  //   $('#tanggal').daterangepicker({
  //     startDate: start,
  //     endDate: end,
  //     ranges: {
  //       '1 hari': [moment(), moment().startOf('days').add(1, 'days')],
  //       '3 hari': [moment(), moment().startOf('days').add(3, 'days')],
  //       '7 hari': [moment(), moment().startOf('days').add(3, 'days')],
  //     }
  //   }, cb);

  //   cb(start, end);
  // });
</script>