@extends('backend.layouts.master')
@section('title','KHAYRAT || Création de Coupon')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-plus-circle mr-2"></i>Ajouter un coupon</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('coupon.store')}}">
        {{csrf_field()}}
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Code promo <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="code" placeholder="Entrez le code promo (ex: SAVE20)"  value="{{old('code')}}" class="form-control">
              @error('code')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
                <label for="type">Type <span class="text-danger">*</span></label>
                <select name="type" class="form-control">
                    <option value="fixed">Fixe</option>
                    <option value="percent">Pourcentage</option>
                </select>
                @error('type')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="value">Valeur <span class="text-danger">*</span></label>
                <input id="value" type="number" name="value" placeholder="Entrez la valeur"  value="{{old('value')}}" class="form-control">
                @error('value')
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
           <button class="btn btn-success" type="submit"><i class="fas fa-check-circle mr-2"></i>Enregistrer le coupon</button>
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