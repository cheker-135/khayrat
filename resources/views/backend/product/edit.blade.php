@extends('backend.layouts.master')
@section('title','KHAYRAT || Modification de Produit')

@section('main-content')

<div class="card">
    <div class="card-header">
        <h5><i class="fas fa-edit mr-2"></i>Modifier le produit</h5>
    </div>
    <div class="card-body">
      <form method="post" action="{{route('product.update',$product->id)}}">
        @csrf 
        @method('PATCH')
        
        <div class="form-grid">
            <!-- Part 1: Basic Info -->
            <div class="form-group grid-full">
              <label for="inputTitle">Titre <span class="text-danger">*</span></label>
              <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre"  value="{{$product->title}}" class="form-control">
              @error('title')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="summary">Résumé <span class="text-danger">*</span></label>
              <textarea class="form-control" id="summary" name="summary">{{$product->summary}}</textarea>
              @error('summary')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group grid-full">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description">{{$product->description}}</textarea>
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
                      <option value='{{$cat_data->id}}' {{(($product->cat_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group {{(($product->child_cat_id)? '' : 'd-none')}}" id="child_cat_div">
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
                  <option value="{{$brand->id}}" {{(($product->brand_id==$brand->id)? 'selected':'')}}>{{$brand->title}}</option>
                 @endforeach
              </select>
            </div>

            <!-- Part 3: Pricing & Inventory -->
            <div class="form-group">
              <label for="price">Prix <span class="text-danger">*</span></label>
              <input id="price" type="number" name="price" placeholder="Entrez le prix"  value="{{$product->price}}" class="form-control">
              @error('price')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="discount">Remise (%)</label>
              <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Entrez la remise"  value="{{$product->discount}}" class="form-control">
              @error('discount')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="stock">Quantité <span class="text-danger">*</span></label>
              <input id="quantity" type="number" name="stock" min="0" placeholder="Entrez la quantité"  value="{{$product->stock}}" class="form-control">
              @error('stock')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <!-- Part 4: Specs & Condition -->
            <div class="form-group">
              <label for="size">Taille</label>
              <select name="size[]" class="form-control selectpicker"  multiple data-live-search="true">
                  <option value="">--Sélectionner une taille--</option>
                  @foreach($items as $item)              
                    @php 
                    $data=explode(',',$item->size);
                    @endphp
                  <option value="S"  @if( in_array( "S",$data ) ) selected @endif>Small (S)</option>
                  <option value="M"  @if( in_array( "M",$data ) ) selected @endif>Medium (M)</option>
                  <option value="L"  @if( in_array( "L",$data ) ) selected @endif>Large (L)</option>
                  <option value="XL"  @if( in_array( "XL",$data ) ) selected @endif>Extra Large (XL)</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="condition">Condition</label>
              <select name="condition" class="form-control">
                  <option value="">--Sélectionner une condition--</option>
                  <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Par défaut</option>
                  <option value="new" {{(($product->condition=='new')? 'selected':'')}}>Nouveau</option>
                  <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Populaire</option>
              </select>
            </div>

            <div class="form-group">
              <label for="status">Statut <span class="text-danger">*</span></label>
              <select name="status" class="form-control">
                <option value="active" {{(($product->status=='active')? 'selected' : '')}}>Actif</option>
                <option value="inactive" {{(($product->status=='inactive')? 'selected' : '')}}>Inactif</option>
            </select>
              @error('status')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>

            <div class="form-group">
              <label for="is_featured">Options du produit</label>
              <div class="custom-control custom-checkbox mt-2">
                  <input type="checkbox" name='is_featured' id='is_featured' value='1' {{(($product->is_featured) ? 'checked' : '')}}> 
                  <label class="d-inline-block ml-2" for="is_featured">Mettre en vedette sur la page d'accueil</label>
              </div>
            </div>

            <!-- Part 5: Media -->
            <div class="form-group grid-full">
              <label for="inputPhoto">Photo du produit <span class="text-danger">*</span></label>
              <div class="input-group">
                  <span class="input-group-btn">
                      <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image mr-2"></i>Choisir depuis le média
                      </a>
                  </span>
                  <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$product->photo}}">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
              @error('photo')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
        </div>

        <div class="form-actions mb-3">
           <button class="btn btn-success" type="submit"><i class="fas fa-save mr-2"></i>Mettre à jour le produit</button>
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
        height: 150
    });
    });
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Écrivez une description détaillée.....",
          tabsize: 2,
          height: 150
      });
    });
</script>

<script>
  var  child_cat_id='{{$product->child_cat_id}}';
        // alert(child_cat_id);
        $('#cat_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Sélectionnez une option--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                console.log('no response data');
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

        });
        if(child_cat_id!=null){
            $('#cat_id').change();
        }
</script>
@endpush