@extends('backend.layouts.master')

@section('title','KHAYRAT || Modifier le commentaire')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit mr-2"></i>Modifier le commentaire</h5>
    </div>
    <div class="card-body">
      <form action="{{route('comment.update',$comment->id)}}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="name">Auteur du commentaire</label>
              <input type="text" disabled class="form-control" value="{{$comment->user_info->name}}">
            </div>

            <div class="form-group grid-full">
              <label for="comment">Contenu du commentaire</label>
              <textarea name="comment" id="comment" cols="20" rows="5" class="form-control">{{$comment->comment}}</textarea>
            </div>

            <div class="form-group">
              <label for="status">Statut</label>
              <select name="status" id="status" class="form-control">
                <option value="active" {{(($comment->status=='active')? 'selected' : '')}}>Actif</option>
                <option value="inactive" {{(($comment->status=='inactive')? 'selected' : '')}}>Inactif</option>
              </select>
            </div>
        </div>

        <div class="form-actions mb-3">
           <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Mettre à jour le commentaire</button>
        </div>
      </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }
</style>
@endpush