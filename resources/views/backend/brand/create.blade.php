@extends('backend.layouts.master')
@section('title','KHAYRAT || Création de Marque')
@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-plus-circle mr-2"></i>Ajouter une marque</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('brand.store')}}">
        {{csrf_field()}}
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Titre <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre de la marque"  value="{{old('title')}}" class="form-control">
              @error('title')
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
        </div>

        <div class="form-actions mb-3">
           <button type="reset" class="btn btn-warning"><i class="fas fa-undo mr-2"></i>Réinitialiser</button>
           <button class="btn btn-success" type="submit"><i class="fas fa-check-circle mr-2"></i>Enregistrer la marque</button>
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