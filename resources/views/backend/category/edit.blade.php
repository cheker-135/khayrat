@extends('backend.layouts.master')
@section('title','KHAYRAT || Modification de Catégorie')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit mr-2"></i>Modifier la catégorie</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('category.update',$category->id)}}">
        @csrf 
        @method('PATCH')
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Titre <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre"  value="{{$category->title}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="summary">Résumé</label>
              <textarea class="form-control" id="summary" name="summary">{{$category->summary}}</textarea>
              @error('summary')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="is_parent">Relation de parenté</label>
              <div class="custom-control custom-checkbox mt-2">
                  <input type="checkbox" name='is_parent' id='is_parent' value='1' {{(($category->is_parent==1)? 'checked' : '')}}> 
                  <label class="d-inline-block ml-2" for="is_parent">Est une catégorie parente</label>
              </div>
            </div>

            <div class="form-group {{(($category->is_parent==1) ? 'd-none' : '')}}" id='parent_cat_div'>
              <label for="parent_id">Catégorie parente</label>
              <select name="parent_id" class="form-control">
                  <option value="">--Sélectionner une catégorie--</option>
                  @foreach($parent_cats as $key=>$parent_cat)
                      <option value='{{$parent_cat->id}}' {{(($parent_cat->id==$category->parent_id) ? 'selected' : '')}}>{{$parent_cat->title}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="status">Statut <span class="text-danger">*</span></label>
              <select name="status" class="form-control">
                  <option value="active" {{(($category->status=='active')? 'selected' : '')}}>Actif</option>
                  <option value="inactive" {{(($category->status=='inactive')? 'selected' : '')}}>Inactif</option>
              </select>
              @error('status')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="inputPhoto">Photo de catégorie</label>
              <div class="input-group">
                  <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image mr-2"></i>Choisir depuis le média
                      </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$category->photo}}">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
              @error('photo')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="form-actions mb-3">
           <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>Mettre à jour la catégorie</button>
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
    $('#summary').summernote({
      placeholder: "Écrivez une courte description.....",
        tabsize: 2,
        height: 150
    });
    });
</script>
<script>
  $('#is_parent').change(function(){
    var is_checked=$('#is_parent').prop('checked');
    // alert(is_checked);
    if(is_checked){
      $('#parent_cat_div').addClass('d-none');
      $('#parent_cat_div').val('');
    }
    else{
      $('#parent_cat_div').removeClass('d-none');
    }
  })
</script>
@endpush