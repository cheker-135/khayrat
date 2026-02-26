@extends('user.layouts.master')

@section('title','KHAYRAT || Profil')

@section('main-content')

<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
           @include('user.layouts.notification')
        </div>
    </div>
   <div class="card-header py-3">
     <h6 class="m-0 font-weight-bold text-primary float-left">Mon Profil</h6>
   </div>
   <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card profile-sidebar-card">
                    <div class="profile-image-header">
                        @if($profile->photo)
                        <img class="img-fluid rounded-circle shadow" src="{{$profile->photo}}" alt="profile picture">
                        @else 
                        <img class="img-fluid rounded-circle shadow" src="{{asset('backend/img/avatar.png')}}" alt="profile picture">
                        @endif
                    </div>
                    <div class="card-body text-center mt-5">
                      <h5 class="font-weight-bold">{{$profile->name}}</h5>
                      <p class="text-muted"><i class="fas fa-envelope mr-2"></i> {{$profile->email}}</p>
                      <span class="badge badge-premium-user">{{$profile->role == 'admin' ? 'Administrateur' : 'Client'}}</span>
                    </div>
                  </div>
            </div>
            <div class="col-md-8">
                <div class="premium-form-container p-4">
                    <form method="POST" action="{{route('user-profile-update',$profile->id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputTitle">Nom complet</label>
                            <input id="inputTitle" type="text" name="name" placeholder="Votre nom" value="{{$profile->name}}" class="form-control">
                            @error('name')
                            <span class="text-danger small">{{$message}}</span>
                            @enderror
                        </div>
                
                        <div class="form-group">
                            <label for="inputEmail">Adresse Email</label>
                            <input id="inputEmail" disabled type="email" name="email" value="{{$profile->email}}" class="form-control bg-light">
                        </div>
                
                        <div class="form-group">
                            <label for="inputPhoto">Photo de profil</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fas fa-image mr-1"></i> Choisir
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$profile->photo}}">
                            </div>
                            <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                            @error('photo')
                            <span class="text-danger small">{{$message}}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group d-none">
                            <label for="role">Rôle</label>
                            <select name="role" class="form-control">
                                <option value="user" {{(($profile->role=='user')? 'selected' : '')}}>Client</option>
                                <option value="admin" {{(($profile->role=='admin')? 'selected' : '')}}>Admin</option>
                            </select>
                        </div>

                        <div class="form-actions mt-4">
                            <button type="submit" class="btn btn-success"><i class="fas fa-check-circle mr-2"></i> Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>
</div>

<style>
.profile-image-header {
    background: linear-gradient(135deg, #a78bfa 0%, #7c3aed 100%);
    height: 120px;
    border-radius: 15px 15px 0 0;
    position: relative;
    display: flex;
    justify-content: center;
}
.profile-image-header img {
    position: absolute;
    bottom: -40px;
    width: 100px;
    height: 100px;
    object-fit: cover;
    border: 4px solid #fff;
}
.profile-sidebar-card {
    border-radius: 15px !important;
    overflow: hidden;
}
.badge-premium-user {
    background: rgba(124, 58, 237, 0.1);
    color: #7c3aed;
    border: 1px solid rgba(124, 58, 237, 0.2);
    padding: 6px 15px;
    border-radius: 8px;
    font-weight: 700;
}
.premium-form-container {
    background: #f8fafc;
    border-radius: 15px;
    border: 1px solid #e2e8f0;
}
</style>

@endsection

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush