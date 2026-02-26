@extends('backend.layouts.master')
@section('title','KHAYRAT || Modifier l\'étiquette d\'article')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit mr-2"></i>Modifier l'étiquette d'article</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('post-tag.update',$postTag->id)}}">
        @csrf 
        @method('PATCH')
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="inputTitle">Titre de l'étiquette</label>
              <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre"  value="{{$postTag->title}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="status">Statut</label>
              <select name="status" class="form-control">
                <option value="active" {{(($postTag->status=='active') ? 'selected' : '')}}>Actif</option>
                <option value="inactive" {{(($postTag->status=='inactive') ? 'selected' : '')}}>Inactif</option>
              </select>
              @error('status')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="form-actions mb-3">
           <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>Mettre à jour l'étiquette</button>
        </div>
      </form>
    </div>
@endsection
