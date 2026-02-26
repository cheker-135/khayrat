@extends('user.layouts.master')

@section('title','KHAYRAT || Sécurité')

@section('main-content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Changer le mot de passe</h6>
                </div>
   
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
   
                         @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right font-weight-bold">Mot de passe actuel</label>
                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control" name="current_password" placeholder="Mot de passe actuel" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right font-weight-bold">Nouveau mot de passe</label>
                            <div class="col-md-7">
                                <input id="new_password" type="password" class="form-control" name="new_password" placeholder="Nouveau mot de passe" autocomplete="new-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="new_confirm_password" class="col-md-4 col-form-label text-md-right font-weight-bold">Confirmer le nouveau mot de passe</label>
                            <div class="col-md-7">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" placeholder="Confirmer le mot de passe" autocomplete="new-password">
                            </div>
                        </div>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-7 offset-md-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-shield-alt mr-2"></i> Mettre à jour le mot de passe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection