@extends('user.layouts.master')

@section('title','KHAYRAT || Modifier l\'avis')

@section('main-content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Modifier mon avis</h6>
    </div>
    <div class="card-body">
        <div class="premium-form-container p-4 shadow-sm rounded">
            <form action="{{route('user.productreview.update',$review->id)}}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label for="name">Auteur de l'avis :</label>
                    <input type="text" disabled class="form-control bg-light" value="{{$review->user_info->name}}">
                </div>

                <div class="form-group">
                    <label for="review">Votre avis :</label>
                    <textarea name="review" id="review" cols="20" rows="5" class="form-control" placeholder="Écrivez votre avis ici...">{{$review->review}}</textarea>
                    @error('review')
                        <span class="text-danger small">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group d-none">
                    <label for="status">Statut :</label>
                    <select name="status" id="status" class="form-control">
                        <option value="active" {{(($review->status=='active')? 'selected' : '')}}>Actif</option>
                        <option value="inactive" {{(($review->status=='inactive')? 'selected' : '')}}>Inactif</option>
                    </select>
                </div>

                <div class="form-actions mt-4">
                    <button type="submit" class="btn btn-success"><i class="fas fa-check-circle mr-2"></i> Mettre à jour l'avis</button>
                    <a href="{{route('user.productreview.index')}}" class="btn btn-secondary ml-2">Annuler</a>
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