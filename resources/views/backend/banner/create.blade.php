@extends('backend.layouts.master')

@section('title','KHAYRAT || Création de Bannière')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-plus-circle mr-2"></i>Ajouter une bannière</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('banner.store')}}">
        {{csrf_field()}}
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Titre <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre de la bannière"  value="{{old('title')}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="inputDesc">Description</label>
              <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
              @error('description')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="status">Statut <span class="text-danger">*</span></label>
              <select name="status" class="form-control">
                  <option value="active">Actif</option>
                  <option value="inactive">Inactif</option>
              </select>
              @error('status')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="inputPhoto">Photo <span class="text-danger">*</span></label>
              <div class="input-group">
                  <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image mr-2"></i>Choisir depuis le média
                      </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}" placeholder="URL de la photo">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
              @error('photo')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="form-actions mb-3">
           <button type="reset" class="btn btn-warning"><i class="fas fa-undo mr-2"></i>Réinitialiser</button>
           <button class="btn btn-success" type="submit"><i class="fas fa-check-circle mr-2"></i>Enregistrer la bannière</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
    $('#description').summernote({
      placeholder: "Écrivez une courte description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
@endpush