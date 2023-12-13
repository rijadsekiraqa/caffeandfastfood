<div class="modal fade" id="create-product" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Regjistrimi i Produkteve</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('products.store')}}">
                    @csrf
                    @method("POST")

                    <div class="form-group">
                        <label for="name" class="control-label">Emri i Produktit</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" value="" required/>
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="control-label">Kategoria</label>
                        <select name="category_id" id="category_id" class="form-control form-control-sm rounded-0" required>
                            <option value="">Selektoni nje Kategori </option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price" class="control-label">Qmimi</label>
                        <input type="number" name="price" id="price" value="" step="0.05" class="form-control form-control-sm rounded-0 text-left"  required min="0"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ruaj</button>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>



