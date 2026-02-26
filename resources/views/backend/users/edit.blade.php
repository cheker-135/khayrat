@extends('backend.layouts.master')
@section('title','KHAYRAT || Modifier l\'utilisateur')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-user-edit mr-2"></i>Modifier l'utilisateur</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('users.update',$user->id)}}">
        @csrf 
        @method('PATCH')
        
        <div class="form-grid">
            <div class="form-group">
              <label for="inputTitle">Nom complet</label>
              <input id="inputTitle" type="text" name="name" placeholder="Entrez le nom"  value="{{$user->name}}" class="form-control">
              @error('name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
                <label for="inputEmail">Adresse Email</label>
                <input id="inputEmail" type="email" name="email" placeholder="Entrez l'email"  value="{{$user->email}}" class="form-control">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Rôle utilisateur</label>
                <select name="role" class="form-control">
                    <option value="">-----Sélectionner un rôle-----</option>
                    <option value="admin" {{(($user->role=='admin') ? 'selected' : '')}}>Administrateur</option>
                    <option value="user" {{(($user->role=='user') ? 'selected' : '')}}>Utilisateur standard</option>
                </select>
                @error('role')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Statut du compte</label>
                <select name="status" class="form-control">
                    <option value="active" {{(($user->status=='active') ? 'selected' : '')}}>Actif</option>
                    <option value="inactive" {{(($user->status=='inactive') ? 'selected' : '')}}>Inactif</option>
                </select>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group grid-full">
              <label for="inputPhoto">Photo de profil</label>
              <div class="input-group">
                  <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image mr-2"></i>Choisir depuis le média
                      </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$user->photo}}" placeholder="URL de la photo">
              </div>
              <img id="holder" style="margin-top:15px;max-height:100px;">
              @error('photo')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="form-actions mb-3">
           <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>Mettre à jour l'utilisateur</button>
        </div>
      </form>
    </div>
@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush