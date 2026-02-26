@extends('backend.layouts.master')
@section('title','KHAYRAT || Modification de Livraison')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit mr-2"></i>Modifier la livraison</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('shipping.update',$shipping->id)}}">
        @csrf 
        @method('PATCH')
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Type / Titre <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="type" placeholder="Entrez le titre"  value="{{$shipping->type}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>     

            <div class="form-group">
              <label for="price">Prix <span class="text-danger">*</span></label>
              <input id="price" type="number" name="price" placeholder="Entrez le prix"  value="{{$shipping->price}}" class="form-control">
              @error('price')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>        
            
            <div class="form-group">
              <label for="status">Statut <span class="text-danger">*</span></label>
              <select name="status" class="form-control">
                <option value="active" {{(($shipping->status=='active') ? 'selected' : '')}}>Actif</option>
                <option value="inactive" {{(($shipping->status=='inactive') ? 'selected' : '')}}>Inactif</option>
              </select>
              @error('status')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="form-actions mb-3">
           <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>Mettre à jour la livraison</button>
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