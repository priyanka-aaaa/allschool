<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright <strong><span>School</span></strong>. All Rights Reserved
  </div>

</footer>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
<script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../assets/vendor/echarts/echarts.min.js"></script>
<script src="../assets/vendor/quill/quill.min.js"></script>
<script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../assets/vendor/php-email-form/validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
<script src="../assets/js/main.js"></script>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
<!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script> -->
<script>
    if (window.history.replaceState) {
      window.history.replaceState(null, null, window.location.href);
    }
  </script>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();
  });
</script>

<script>
  $(document).ready(function() {
    $('.editbtn').click(function() {
      $('#editteacher').modal('show');
      $tr = $(this).closest('tr');
      let data = $tr.children("td").map(function() {
        return $(this).text();
      }).get();

    
      $('#update_id').val(data[0]);
      $('#full-name').val(data[1]);
      $('#email').val(data[2]);
      $('#phone').val(data[3]);
      $('#qualification').val(data[4]);
      $('#speciality').val(data[5]);
      $('#description').val(data[6]);
      $('#joining-date').val(data[7]);
      $('#address').val(data[8]);
    });
  });
</script>
</body>

</html>