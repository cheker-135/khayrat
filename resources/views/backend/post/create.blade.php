@extends('backend.layouts.master')
@section('title','KHAYRAT || Ajouter un article')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-plus-circle mr-2"></i>Ajouter un article</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('post.store')}}">
        {{csrf_field()}}
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Titre <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre de l'article"  value="{{old('title')}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="quote">Citation</label>
              <textarea class="form-control" id="quote" name="quote">{{old('quote')}}</textarea>
              @error('quote')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="summary">Résumé <span class="text-danger">*</span></label>
              <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
              @error('summary')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="description">Description complète</label>
              <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
              @error('description')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="post_cat_id">Catégorie <span class="text-danger">*</span></label>
              <select name="post_cat_id" class="form-control">
                  <option value="">--Sélectionner une catégorie--</option>
                  @foreach($categories as $key=>$data)
                      <option value='{{$data->id}}'>{{$data->title}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="tags">Étiquettes</label>
              <select name="tags[]" multiple data-live-search="true" class="form-control selectpicker">
                  @foreach($tags as $key=>$data)
                      <option value='{{$data->title}}'>{{$data->title}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="added_by">Auteur</label>
              <select name="added_by" class="form-control">
                  @foreach($users as $key=>$data)
                    <option value='{{$data->id}}' {{($key==0) ? 'selected' : ''}}>{{$data->name}}</option>
                @endforeach
              </select>
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
              <label for="inputPhoto">Photo de couverture <span class="text-danger">*</span></label>
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
           <button class="btn btn-success" type="submit"><i class="fas fa-check-circle mr-2"></i>Publier l'article</button>
        </div>
      </form>
    </div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Écrivez une courte description.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Écrivez une description détaillée.....",
          tabsize: 2,
          height: 150
      });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Écrivez une citation détaillée.....",
          tabsize: 2,
          height: 100
      });
    });
    // $('select').selectpicker();

</script>
@endpush