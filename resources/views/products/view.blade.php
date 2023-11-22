<div class="modal fade" id="view-product-{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Informacioni i Produktit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="control-label">Emri i Produktit</label>
                    <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" value="{{$product->name}}" readonly/>
                </div>

                <div class="form-group">
                    <label for="category_id" class="control-label">Kategoria</label>
                    <input type="text" name="category_id" id="category_id" class="form-control form-control-sm rounded-0" value="{{$product->category->name}}" readonly/>
                </div>

                <div class="form-group">
                    <label for="price" class="control-label">Qmimi</label>
                    <input type="text" name="price" id="price" class="form-control form-control-sm rounded-0" value="{{ number_format($product->price, 2, '.', '') }}" readonly/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark bg-gradient-dark btn-flat" data-dismiss="modal"><i class="fa fa-times"></i> Dil</button>
            </div>
        </div>
    </div>
</div>
