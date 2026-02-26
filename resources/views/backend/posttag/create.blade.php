@extends('backend.layouts.master')
@section('title','KHAYRAT || Ajouter une étiquette d\'article')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-tag mr-2"></i>Ajouter une étiquette d'article</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('post-tag.store')}}">
        {{csrf_field()}}
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Titre de l'étiquette</label>
              <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre"  value="{{old('title')}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="status">Statut</label>
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
           <button class="btn btn-success" type="submit"><i class="fas fa-check-circle mr-2"></i>Enregistrer l'étiquette</button>
        </div>
      </form>
    </div>
@endsection
