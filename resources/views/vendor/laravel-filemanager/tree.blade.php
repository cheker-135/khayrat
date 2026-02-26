<div class="p-3 mb-4 text-center border-bottom">
  <img src="{{ asset('vendor/laravel-filemanager/img/72px color.png') }}" class="mb-2" style="width: 40px;">
  <h6 class="font-weight-bold text-dark mb-0">KHAYRAT MEDIA</h6>
  <small class="text-muted">Gestionnaire de fichiers</small>
</div>

<ul class="nav nav-pills flex-column">
  @foreach($root_folders as $root_folder)
    <li class="nav-item">
      <a class="nav-link" href="#" data-type="0" data-path="{{ $root_folder->url }}">
        <i class="fa fa-folder fa-fw"></i> {{ $root_folder->name }}
      </a>
    </li>
    @foreach($root_folder->children as $directory)
    <li class="nav-item sub-item">
      <a class="nav-link" href="#" data-type="0" data-path="{{ $directory->url }}">
        <i class="fa fa-folder fa-fw"></i> {{ $directory->name }}
      </a>
    </li>
    @endforeach
  @endforeach
</ul>
