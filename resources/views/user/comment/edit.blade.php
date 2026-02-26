@extends('user.layouts.master')

@section('title','KHAYRAT || Modifier le commentaire')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Modifier mon commentaire</h6>
    </div>
    <div class="card-body">
        <div class="premium-form-container p-4 shadow-sm rounded">
            <form action="{{route('user.post-comment.update',$comment->id)}}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label for="name">Auteur du commentaire :</label>
                    <input type="text" disabled class="form-control bg-light" value="{{$comment->user_info->name}}">
                </div>

                <div class="form-group">
                    <label for="comment">Votre commentaire :</label>
                    <textarea name="comment" id="comment" cols="20" rows="5" class="form-control" placeholder="Écrivez votre commentaire ici...">{{$comment->comment}}</textarea>
                    @error('comment')
                        <span class="text-danger small">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group d-none">
                    <label for="status">Statut :</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active" {{(($comment->status=='active')? 'selected' : '')}}>Actif</option>
                        <option value="inactive" {{(($comment->status=='inactive')? 'selected' : '')}}>Inactif</option>
                    </select>
                </div>

                <div class="form-actions mt-4">
                    <button type="submit" class="btn btn-success"><i class="fas fa-check-circle mr-2"></i> Mettre à jour le commentaire</button>
                    <a href="{{route('user.post-comment.index')}}" class="btn btn-secondary ml-2">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.premium-form-container {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
}
.form-group label {
    font-weight: 700;
    color: #4a5568;
    margin-bottom: 8px;
}
</style>
@endsection