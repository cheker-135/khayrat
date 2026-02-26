<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Chrome, Firefox OS and Opera -->
  <meta name="theme-color" content="#333844">
  <!-- Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#333844">
  <!-- iOS Safari -->
  <meta name="apple-mobile-web-app-status-bar-style" content="#333844">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <title>{{ trans('laravel-filemanager::lfm.title-page') }}</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('vendor/laravel-filemanager/img/72px color.png') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/cropper.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/dropzone.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/laravel-filemanager/css/mime-icons.min.css') }}">
  <style>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/css/lfm.css')) !!}</style>
  <style>
    /* Premium Theme Overrides for KHAYRAT Admin */
    :root {
      --primary-color: #38bdf8;
      --secondary-color: #64748b;
      --success-color: #22c55e;
      --bg-light: #f8fafc;
      --text-dark: #1e293b;
      --border-color: #e2e8f0;
      --card-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
      --radius-lg: 20px;
      --radius-md: 12px;
    }

    body {
      background-color: var(--bg-light) !important;
      font-family: 'Nunito', sans-serif !important;
      color: var(--text-dark);
    }

    #nav {
      background: #ffffff !important;
      border-bottom: 1px solid var(--border-color) !important;
      padding: 0.75rem 1.5rem !important;
      box-shadow: 0 2px 10px rgba(0,0,0,0.02) !important;
    }

    #nav .navbar-brand {
      color: var(--text-dark) !important;
      font-weight: 800;
      letter-spacing: -0.02em;
    }

    #nav .nav-link {
      color: var(--secondary-color) !important;
      font-weight: 700;
      padding: 0.5rem 1rem !important;
      border-radius: var(--radius-md);
      transition: all 0.3s ease;
    }

    #nav .nav-link:hover {
      background: var(--bg-light);
      color: var(--primary-color) !important;
    }

    #tree {
      background: #ffffff !important;
      border-right: 1px solid var(--border-color) !important;
      padding: 20px !important;
      min-width: 250px;
    }

    #main {
      padding: 25px !important;
      background: var(--bg-light);
    }

    .breadcrumb {
      background: transparent !important;
      padding: 0 !important;
      margin-bottom: 25px !important;
    }

    .breadcrumb-item a {
      color: var(--secondary-color);
      font-weight: 600;
      text-decoration: none;
    }

    .breadcrumb-item.active {
      color: var(--text-dark);
      font-weight: 800;
    }

    /* Grid Items Styling */
    .clickable {
      border: 1px solid var(--border-color) !important;
      border-radius: var(--radius-md) !important;
      background: #ffffff !important;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
      margin: 10px !important;
      overflow: hidden;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05) !important;
    }

    .clickable:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
      border-color: var(--primary-color) !important;
    }

    .clickable .square {
      border-bottom: 1px solid var(--border-color) !important;
    }

    .clickable .info {
      padding: 12px !important;
      background: #ffffff !important;
    }

    .clickable .item_name {
      font-weight: 700 !important;
      color: var(--text-dark) !important;
      font-size: 0.9rem !important;
    }

    /* Modal Styling */
    .modal-content {
      border: none !important;
      border-radius: var(--radius-lg) !important;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
    }

    .modal-header {
      border-bottom: 1px solid var(--border-color) !important;
      padding: 1.5rem !important;
    }

    .modal-title {
      font-weight: 800 !important;
      color: var(--text-dark) !important;
    }

    .modal-footer {
      border-top: 1px solid var(--border-color) !important;
      padding: 1.5rem !important;
      gap: 10px;
    }

    .btn {
      border-radius: var(--radius-md) !important;
      padding: 10px 20px !important;
      font-weight: 700 !important;
      transition: all 0.3s ease !important;
    }

    .btn-primary {
      background: linear-gradient(135deg, #38bdf8 0%, #0284c7 100%) !important;
      border: none !important;
      box-shadow: 0 4px 12px rgba(56, 189, 248, 0.2) !important;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(56, 189, 248, 0.3) !important;
    }

    /* Dropzone Styling */
    .dropzone {
      border: 2px dashed var(--border-color) !important;
      border-radius: var(--radius-md) !important;
      background: var(--bg-light) !important;
      transition: all 0.3s ease !important;
      padding: 40px !important;
    }

    .dropzone:hover {
      border-color: var(--primary-color) !important;
      background: #f0f9ff !important;
    }

    #fab {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
      box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.4) !important;
      width: 56px !important;
      height: 56px !important;
      border-radius: 50% !important;
      bottom: 30px !important;
      right: 30px !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      color: white !important;
      font-size: 20px !important;
      cursor: pointer !important;
      transition: all 0.3s ease !important;
    }

    #fab:hover {
      transform: scale(1.1) rotate(90deg);
      box-shadow: 0 20px 25px -5px rgba(16, 185, 129, 0.5) !important;
    }

    /* Folder list overrides */
    #tree .nav-link {
      border: none !important;
      margin-bottom: 5px !important;
      border-radius: var(--radius-md) !important;
      font-weight: 700 !important;
      color: var(--secondary-color) !important;
      transition: all 0.2s ease !important;
      padding: 10px 15px !important;
    }

    #tree .nav-link:hover {
      background: var(--bg-light) !important;
      color: var(--primary-color) !important;
      transform: translateX(5px);
    }

    #tree .nav-link.active {
      background: #f0f9ff !important;
      color: var(--primary-color) !important;
      box-shadow: 0 4px 12px rgba(56, 189, 248, 0.1) !important;
    }

    #tree .nav-item.sub-item {
      padding-left: 15px;
    }

    #actions {
      background: #ffffff !important;
      border-top: 1px solid var(--border-color) !important;
      padding: 15px 30px !important;
      box-shadow: 0 -4px 12px rgba(0,0,0,0.05) !important;
      display: flex !important;
      justify-content: flex-end !important;
      gap: 15px;
    }

    #actions a {
      border-radius: var(--radius-md) !important;
      padding: 10px 25px !important;
      font-weight: 700 !important;
      font-size: 0.9rem !important;
      display: inline-flex !important;
      align-items: center !important;
      cursor: pointer !important;
      transition: all 0.3s ease !important;
      border: 1px solid var(--border-color) !important;
      background: #ffffff !important;
      color: var(--secondary-color) !important;
      text-decoration: none !important;
    }

    #actions a[data-action="use"] {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
      color: white !important;
      border: none !important;
      box-shadow: 0 4px 15px rgba(34, 197, 94, 0.25) !important;
    }

    #actions a:hover {
      transform: translateY(-2px);
    }

    #actions a i {
      margin-right: 8px;
    }
  </style>
</head>
<body>
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark" id="nav">
    <a class="navbar-brand invisible-lg d-none d-lg-inline" id="to-previous">
      <i class="fas fa-arrow-left fa-fw"></i>
      <span class="d-none d-lg-inline">{{ trans('laravel-filemanager::lfm.nav-back') }}</span>
    </a>
    <a class="navbar-brand d-block d-lg-none" id="show_tree">
      <i class="fas fa-bars fa-fw"></i>
    </a>
    <a class="navbar-brand d-block d-lg-none" id="current_folder"></a>
    <a id="loading" class="navbar-brand"><i class="fas fa-spinner fa-spin"></i></a>
    <div class="ml-auto px-2">
      <a class="navbar-link d-none" id="multi_selection_toggle">
        <i class="fa fa-check-double fa-fw"></i>
        <span class="d-none d-lg-inline">{{ trans('laravel-filemanager::lfm.menu-multiple') }}</span>
      </a>
    </div>
    <a class="navbar-toggler collapsed border-0 px-1 py-2 m-0" data-toggle="collapse" data-target="#nav-buttons">
      <i class="fas fa-cog fa-fw"></i>
    </a>
    <div class="collapse navbar-collapse flex-grow-0" id="nav-buttons">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-display="grid">
            <i class="fas fa-th-large fa-fw"></i>
            <span>{{ trans('laravel-filemanager::lfm.nav-thumbnails') }}</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-display="list">
            <i class="fas fa-list-ul fa-fw"></i>
            <span>{{ trans('laravel-filemanager::lfm.nav-list') }}</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-sort fa-fw"></i>{{ trans('laravel-filemanager::lfm.nav-sort') }}
          </a>
          <div class="dropdown-menu dropdown-menu-right border-0"></div>
        </li>
      </ul>
    </div>
  </nav>

  <nav class="bg-light fixed-bottom border-top d-none" id="actions">
    <a data-action="open" data-multiple="false"><i class="fas fa-folder-open"></i>{{ trans('laravel-filemanager::lfm.btn-open') }}</a>
    <a data-action="preview" data-multiple="true"><i class="fas fa-images"></i>{{ trans('laravel-filemanager::lfm.menu-view') }}</a>
    <a data-action="use" data-multiple="true"><i class="fas fa-check"></i>{{ trans('laravel-filemanager::lfm.btn-confirm') }}</a>
  </nav>

  <div class="d-flex flex-row">
    <div id="tree"></div>

    <div id="main">
      <div id="alerts"></div>

      <nav aria-label="breadcrumb" class="d-none d-lg-block" id="breadcrumbs">
        <ol class="breadcrumb">
          <li class="breadcrumb-item invisible">Home</li>
        </ol>
      </nav>

      <div id="empty" class="d-none">
        <i class="far fa-folder-open"></i>
        {{ trans('laravel-filemanager::lfm.message-empty') }}
      </div>

      <div id="content"></div>
      <div id="pagination"></div>

      <a id="item-template" class="d-none">
        <div class="square"></div>

        <div class="info">
          <div class="item_name text-truncate"></div>
          <time class="text-muted font-weight-light text-truncate"></time>
        </div>
      </a>
    </div>

    <div id="fab"></div>
  </div>

  <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">{{ trans('laravel-filemanager::lfm.title-upload') }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aia-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('unisharp.lfm.upload') }}" role='form' id='uploadForm' name='uploadForm' method='post' enctype='multipart/form-data' class="dropzone">
            <div class="form-group" id="attachment">
              <div class="controls text-center">
                <div class="input-group w-100">
                  <a class="btn btn-primary w-100 text-white" id="upload-button">{{ trans('laravel-filemanager::lfm.message-choose') }}</a>
                </div>
              </div>
            </div>
            <input type='hidden' name='working_dir' id='working_dir'>
            <input type='hidden' name='type' id='type' value='{{ request("type") }}'>
            <input type='hidden' name='_token' value='{{csrf_token()}}'>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">{{ trans('laravel-filemanager::lfm.btn-close') }}</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="notify" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">{{ trans('laravel-filemanager::lfm.btn-close') }}</button>
          <button type="button" class="btn btn-primary w-100" data-dismiss="modal">{{ trans('laravel-filemanager::lfm.btn-confirm') }}</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="dialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">{{ trans('laravel-filemanager::lfm.btn-close') }}</button>
          <button type="button" class="btn btn-primary w-100" data-dismiss="modal">{{ trans('laravel-filemanager::lfm.btn-confirm') }}</button>
        </div>
      </div>
    </div>
  </div>

  <div id="carouselTemplate" class="d-none carousel slide bg-light" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#previewCarousel" data-slide-to="0" class="active"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <a class="carousel-label"></a>
        <div class="carousel-image"></div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#previewCarousel" role="button" data-slide="prev">
      <div class="carousel-control-background" aria-hidden="true">
        <i class="fas fa-chevron-left"></i>
      </div>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#previewCarousel" role="button" data-slide="next">
      <div class="carousel-control-background" aria-hidden="true">
        <i class="fas fa-chevron-right"></i>
      </div>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js"></script>
  <script src="{{ asset('vendor/laravel-filemanager/js/cropper.min.js') }}"></script>
  <script src="{{ asset('vendor/laravel-filemanager/js/dropzone.min.js') }}"></script>
  <script>
    var lang = {!! json_encode(trans('laravel-filemanager::lfm')) !!};
    var actions = [
      // {
      //   name: 'use',
      //   icon: 'check',
      //   label: 'Confirm',
      //   multiple: true
      // },
      {
        name: 'rename',
        icon: 'edit',
        label: lang['menu-rename'],
        multiple: false
      },
      {
        name: 'download',
        icon: 'download',
        label: lang['menu-download'],
        multiple: true
      },
      // {
      //   name: 'preview',
      //   icon: 'image',
      //   label: lang['menu-view'],
      //   multiple: true
      // },
      {
        name: 'move',
        icon: 'paste',
        label: lang['menu-move'],
        multiple: true
      },
      {
        name: 'resize',
        icon: 'arrows-alt',
        label: lang['menu-resize'],
        multiple: false
      },
      {
        name: 'crop',
        icon: 'crop',
        label: lang['menu-crop'],
        multiple: false
      },
      {
        name: 'trash',
        icon: 'trash',
        label: lang['menu-delete'],
        multiple: true
      },
    ];

    var sortings = [
      {
        by: 'alphabetic',
        icon: 'sort-alpha-down',
        label: lang['nav-sort-alphabetic']
      },
      {
        by: 'time',
        icon: 'sort-numeric-down',
        label: lang['nav-sort-time']
      }
    ];
  </script>
  <script>{!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/script.js')) !!}</script>
  {{-- Use the line below instead of the above if you need to cache the script. --}}
  {{-- <script src="{{ asset('vendor/laravel-filemanager/js/script.js') }}"></script> --}}
  <script>
    Dropzone.options.uploadForm = {
      paramName: "upload[]", // The name that will be used to transfer the file
      uploadMultiple: false,
      parallelUploads: 5,
      timeout:0,
      clickable: '#upload-button',
      dictDefaultMessage: lang['message-drop'],
      init: function() {
        var _this = this; // For the closure
        this.on('success', function(file, response) {
          if (response == 'OK') {
            loadFolders();
          } else {
            this.defaultOptions.error(file, response.join('\n'));
          }
        });
      },
      headers: {
        'Authorization': 'Bearer ' + getUrlParam('token')
      },
      acceptedFiles: "{{ implode(',', $helper->availableMimeTypes()) }}",
      maxFilesize: ({{ $helper->maxUploadSize() }} / 1000)
    }
  </script>
</body>
</html>
