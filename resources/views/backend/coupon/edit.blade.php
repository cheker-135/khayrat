@extends('backend.layouts.master')
@section('title','KHAYRAT || Modification de Coupon')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit mr-2"></i>Modifier le coupon</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('coupon.update',$coupon->id)}}">
        @csrf 
        @method('PATCH')
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Code promo <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="code" placeholder="Entrez le code promo"  value="{{$coupon->code}}" class="form-control">
              @error('code')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
    
            <div class="form-group">
                <label for="type">Type <span class="text-danger">*</span></label>
                <select name="type" class="form-control">
                    <option value="fixed" {{(($coupon->type=='fixed') ? 'selected' : '')}}>Fixe</option>
                    <option value="percent" {{(($coupon->type=='percent') ? 'selected' : '')}}>Pourcentage</option>
                </select>
                @error('type')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
    
            <div class="form-group">
                <label for="inputTitle">Valeur <span class="text-danger">*</span></label>
                <input id="inputTitle" type="number" name="value" placeholder="Entrez la valeur du coupon"  value="{{$coupon->value}}" class="form-control">
                @error('value')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="form-group">
              <label for="status">Statut <span class="text-danger">*</span></label>
              <select name="status" class="form-control">
                <option value="active" {{(($coupon->status=='active') ? 'selected' : '')}}>Actif</option>
                <option value="inactive" {{(($coupon->status=='inactive') ? 'selected' : '')}}>Inactif</option>
              </select>
              @error('status')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="form-actions mb-3">
           <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>Mettre à jour le coupon</button>
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