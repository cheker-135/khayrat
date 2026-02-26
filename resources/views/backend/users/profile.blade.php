@extends('backend.layouts.master')

@section('title','Profil Admin')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-user-circle mr-2"></i>Mon Profil</h5>
    </div>
    <div class="card-body">
        <div class="profile-layout">
            <div class="profile-sidebar">
                <div class="profile-card text-center">
                    <div class="profile-avatar-wrapper">
                        @if($profile->photo)
                            <img class="profile-avatar" src="{{$profile->photo}}" alt="{{$profile->name}}">
                        @else 
                            <img class="profile-avatar" src="{{asset('backend/img/avatar.png')}}" alt="Default Avatar">
                        @endif
                    </div>
                    <div class="profile-short-info mt-3">
                        <h4>{{$profile->name}}</h4>
                        <p class="text-muted"><i class="fas fa-envelope mr-1"></i> {{$profile->email}}</p>
                        <span class="badge badge-primary px-3 py-2">{{ucfirst($profile->role)}}</span>
                    </div>
                </div>
            </div>
            
            <div class="profile-content">
                <form method="POST" action="{{route('profile-update',$profile->id)}}">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group grid-full">
                            <label for="inputTitle">Nom complet</label>
                            <input id="inputTitle" type="text" name="name" placeholder="Votre nom" value="{{$profile->name}}" class="form-control">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputEmail">Adresse Email</label>
                            <input id="inputEmail" disabled type="email" value="{{$profile->email}}" class="form-control bg-light">
                        </div>

                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <select name="role" class="form-control">
                                <option value="admin" {{(($profile->role=='admin')? 'selected' : '')}}>Administrateur</option>
                                <option value="user" {{(($profile->role=='user')? 'selected' : '')}}>Utilisateur</option>
                            </select>
                            @error('role')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group grid-full">
                            <label for="inputPhoto">Photo de profil</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                        <i class="fas fa-image mr-2"></i>Changer la photo
                                    </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$profile->photo}}">
                            </div>
                            @error('photo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions mt-4 text-right">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Enregistrer les modifications</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-layout {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 2rem;
    }

    @media (max-width: 992px) {
        .profile-layout {
            grid-template-columns: 1fr;
        }
    }

    .profile-card {
        background: #f8f9fc;
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid #e3e6f0;
    }

    .profile-avatar-wrapper {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .profile-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profile-short-info h4 {
        margin-bottom: 0.5rem;
        color: #333;
        font-weight: 700;
    }

    .profile-short-info p {
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .form-actions button {
        padding: 0.6rem 2rem;
        font-weight: 600;
        border-radius: 8px;
    }
</style>

@endsection

<style>
    .breadcrumbs{
        list-style: none;
    }
    .breadcrumbs li{
        float:left;
        margin-right:10px;
    }
    .breadcrumbs li a:hover{
        text-decoration: none;
    }
    .breadcrumbs li .active{
        color:red;
    }
    .breadcrumbs li+li:before{
      content:"/\00a0";
    }
    .image{
        background:url('{{asset('backend/img/background.jpg')}}');
        height:150px;
        background-position:center;
        background-attachment:cover;
        position: relative;
    }
    .image img{
        position: absolute;
        top:55%;
        left:35%;
        margin-top:30%;
    }
    i{
        font-size: 14px;
        padding-right:8px;
    }
  </style> 

@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush