
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Droits d'auteur &copy; <a href="https://ouni-chaker-portfolio.netlify.app" target="_blank">Aouni Chaker.</a> {{date('Y')}}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Prêt à partir ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à terminer votre session actuelle.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
          <a class="btn btn-primary" href="login.html">Déconnexion</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script> --}}
  {{-- <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script> --}}

  @stack('scripts')

  <script>
    setTimeout(function(){
      $('.alert').slideUp();
    },4000);

    // Automatic Table Responsiveness Labels
    $(document).ready(function() {
        function applyTableLabels() {
            $('table.table').each(function() {
                var $table = $(this);
                var labels = [];
                
                // Get labels from thead, and handle possible empty headers
                $table.find('thead th').each(function(i) {
                    var label = $(this).text().trim();
                    if (!label && i === 0) label = "ID"; // Fallback for SN
                    labels.push(label);
                });
                
                // Apply to each row's cells
                $table.find('tbody tr').each(function() {
                    $(this).find('td').each(function(index) {
                        if (labels[index]) {
                            $(this).attr('data-label', labels[index]);
                        }
                    });
                });
            });
        }

        // Apply on load and after short delay for dynamic tables
        applyTableLabels();
        setTimeout(applyTableLabels, 500);
        
        // Re-apply when DataTables finishes drawing
        $(document).on('draw.dt', 'table.table', function() {
            applyTableLabels();
        });
        
        // Special handle for window resize to fix any layout shifts
        $(window).on('resize', function() {
            applyTableLabels();
        });
    });
  </script>
