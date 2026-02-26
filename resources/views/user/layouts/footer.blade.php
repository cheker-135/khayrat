
      <!-- Footer -->
      <footer class="sticky-footer bg-white shadow-sm border-top">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span class="text-muted">Tous Droits Réservés &copy; <a href="https://github.com/cheker-135" target="_blank" class="text-primary font-weight-bold">Aouni Chaker.</a> {{date('Y')}}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded shadow" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-gradient-primary text-white">
          <h5 class="modal-title" id="exampleModalLabel">Prêt à partir ?</h5>
          <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body p-4 text-center">
            <i class="fas fa-sign-out-alt fa-3x text-gray-300 mb-3"></i>
            <p class="mb-0">Sélectionnez "Déconnexion" ci-dessous si vous êtes prêt à mettre fin à votre session actuelle.</p>
        </div>
        <div class="modal-footer bg-light">
          <button class="btn btn-secondary px-4" type="button" data-dismiss="modal">Annuler</button>
          <a class="btn btn-primary px-4" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
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
  <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script>

  @stack('scripts')

  <script>
    setTimeout(function(){
      $('.alert').slideUp();
    },4000);
  </script>
