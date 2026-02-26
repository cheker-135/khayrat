@extends('backend.layouts.master')

@section('title','KHAYRAT || Modifier l\'avis')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit mr-2"></i>Modifier l'avis client</h5>
    </div>
    <div class="card-body">
      <form action="{{route('review.update',$review->id)}}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-grid">
            <div class="form-group grid-full">
              <label for="name">Auteur de l'avis</label>
              <input type="text" disabled class="form-control" value="{{$review->user_info->name}}">
            </div>

            <div class="form-group grid-full">
              <label for="review_text">Contenu de l'avis</label>
              <textarea name="review" id="review_text" cols="20" rows="5" class="form-control">{{$review->review}}</textarea>
            </div>

            <div class="form-group">
              <label for="status">Statut</label>
              <select name="status" id="status" class="form-control">
                <option value="active" {{(($review->status=='active')? 'selected' : '')}}>Actif</option>
                <option value="inactive" {{(($review->status=='inactive')? 'selected' : '')}}>Inactif</option>
              </select>
            </div>
        </div>

        <div class="form-actions mb-3">
           <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Mettre à jour l'avis</button>
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