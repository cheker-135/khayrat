@extends('backend.layouts.master')
@section('title','KHAYRAT || Paramètres du site')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-cog mr-2"></i>Paramètres du site</h5>
    </div>
    <div class="card-body">
    <form method="post" action="{{route('settings.update')}}">
        @csrf 
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="short_des">Description courte du site <span class="text-danger">*</span></label>
              <textarea class="form-control" id="quote" name="short_des">{{$data->short_des}}</textarea>
              @error('short_des')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="description">Description détaillée <span class="text-danger">*</span></label>
              <textarea class="form-control" id="description" name="description">{{$data->description}}</textarea>
              @error('description')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="address">Adresse physique <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="address" required value="{{$data->address}}" placeholder="Ex: 123 Rue de la Liberté, Ville">
              @error('address')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="email">Email de contact <span class="text-danger">*</span></label>
              <input type="email" class="form-control" name="email" required value="{{$data->email}}" placeholder="Ex: contact@votre-site.com">
              @error('email')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="phone">Numéro de téléphone <span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="phone" required value="{{$data->phone}}" placeholder="Ex: +216 12 345 678">
              @error('phone')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="logo">Logo du site <span class="text-danger">*</span></label>
              <div class="input-group">
                  <span class="input-group-btn">
                      <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-primary text-white">
                        <i class="fas fa-image mr-2"></i>Choisir logo
                      </a>
                  </span>
                  <input id="thumbnail1" class="form-control" type="text" name="logo" value="{{$data->logo}}">
              </div>
              <div id="holder1" style="margin-top:15px;max-height:100px;"></div>
              @error('logo')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="photo">Image de présentation (À propos) <span class="text-danger">*</span></label>
              <div class="input-group">
                  <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image mr-2"></i>Choisir image
                      </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$data->photo}}">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
              @error('photo')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="form-actions mb-3">
           <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>Enregistrer les paramètres</button>
        </div>
      </form>
    </div>
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
    $('#lfm1').filemanager('image');
    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Écrivez une courte description.....",
        tabsize: 2,
        height: 150
    });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Écrivez une courte citation.....",
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
</script>
@endpush