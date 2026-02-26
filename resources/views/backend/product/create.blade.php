@extends('backend.layouts.master')
@section('title','KHAYRAT || Création de Produit')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-plus-circle mr-2"></i>Ajouter un produit</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('product.store')}}">
        {{csrf_field()}}
        
        <div class="form-grid">
            <!-- Part 1: Basic Info -->
            <div class="form-group grid-full">
              <label for="inputTitle">Titre <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre du produit"  value="{{old('title')}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="summary">Résumé <span class="text-danger">*</span></label>
              <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
              @error('summary')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
              @error('description')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <!-- Part 2: Categorization & Brands -->
            <div class="form-group">
              <label for="cat_id">Catégorie <span class="text-danger">*</span></label>
              <select name="cat_id" id="cat_id" class="form-control">
                  <option value="">--Sélectionner une catégorie--</option>
                  @foreach($categories as $key=>$cat_data)
                      <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group d-none" id="child_cat_div">
              <label for="child_cat_id">Sous-catégorie</label>
              <select name="child_cat_id" id="child_cat_id" class="form-control">
                  <option value="">--Sélectionner une sous-catégorie--</option>
              </select>
            </div>

            <div class="form-group">
              <label for="brand_id">Marque</label>
              <select name="brand_id" class="form-control">
                  <option value="">--Sélectionner une marque--</option>
                 @foreach($brands as $brand)
                  <option value="{{$brand->id}}">{{$brand->title}}</option>
                 @endforeach
              </select>
            </div>

            <!-- Part 3: Pricing & Inventory -->
            <div class="form-group">
              <label for="price">Prix <span class="text-danger">*</span></label>
              <input id="price" type="number" name="price" placeholder="Prix de vente"  value="{{old('price')}}" class="form-control">
              @error('price')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="discount">Remise (%)</label>
              <input id="discount" type="number" name="discount" min="0" max="100" placeholder="0 - 100"  value="{{old('discount')}}" class="form-control">
              @error('discount')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="stock">Quantité en stock <span class="text-danger">*</span></label>
              <input id="quantity" type="number" name="stock" min="0" placeholder="Ex: 100"  value="{{old('stock')}}" class="form-control">
              @error('stock')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <!-- Part 4: Specs & Condition -->
            <div class="form-group">
              <label for="size">Taille</label>
              <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
                  <option value="">--Sélectionner les tailles--</option>
                  <option value="S">Small (S)</option>
                  <option value="M">Medium (M)</option>
                  <option value="L">Large (L)</option>
                  <option value="XL">Extra Large (XL)</option>
              </select>
            </div>

            <div class="form-group">
              <label for="condition">Condition</label>
              <select name="condition" class="form-control">
                  <option value="">--Sélectionner une condition--</option>
                  <option value="default">Par défaut</option>
                  <option value="new">Nouveau</option>
                  <option value="hot">Populaire</option>
              </select>
            </div>

            <div class="form-group">
              <label for="status">Statut <span class="text-danger">*</span></label>
              <select name="status" class="form-control">
                  <option value="active">Actif</option>
                  <option value="inactive">Inactif</option>
              </select>
              @error('status')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="is_featured">Options du produit</label>
              <div class="custom-control custom-checkbox mt-2">
                  <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> 
                  <label class="d-inline-block ml-2" for="is_featured">Mettre en vedette sur la page d'accueil</label>
              </div>
            </div>

            <!-- Part 5: Media -->
            <div class="form-group grid-full">
              <label for="inputPhoto">Photo du produit <span class="text-danger">*</span></label>
              <div class="input-group">
                  <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fa fa-picture-o"></i> Choisir depuis le média
                      </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{old('photo')}}" placeholder="URL de la photo">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
              @error('photo')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        
            <div class="form-actions mb-3">
               <button type="reset" class="btn btn-warning"><i class="fas fa-undo mr-2"></i>Réinitialiser</button>
               <button class="btn btn-success" type="submit"><i class="fas fa-check-circle mr-2"></i>Enregistrer le produit</button>
            </div>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $('#lfm').filemanager('image');

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Écrivez un résumé court.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Écrivez une description détaillée.....",
          tabsize: 2,
          height: 150
      });
    });
    // $('select').selectpicker();

</script>

<script>
  $('#cat_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Sélectionnez une sous-catégorie----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })
</script>
@endpush