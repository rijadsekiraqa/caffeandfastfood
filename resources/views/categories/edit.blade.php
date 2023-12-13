<div class="modal fade" id="edit-category-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Informacioni i Produktit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('categories.update',['category' => $category->id]) }}" id="category-form">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name" class="control-label">Emri</label>
                        <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control form-control-sm rounded-0" required/>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ruaj</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>


