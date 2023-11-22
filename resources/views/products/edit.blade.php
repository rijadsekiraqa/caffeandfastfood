<div class="modal fade" id="edit-product-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Informacioni i Produktit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/products/{{$product->id}}" id="product-form">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name" class="control-label">Emri</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" value="{{$product->name}}" required/>
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="control-label">Kategoria</label>
                        <select name="category_id" id="category_id" class="form-control form-control-sm rounded-0" required>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="price" class="control-label">Qmimi</label>
                    <input type="number" name="price" id="price" step="0.05" class="form-control form-control-sm rounded-0 text-left" value="{{ number_format($product->price, 2, '.', '') }}" required/>
                    </div>
                     <div class="form-group">
                    <button type="submit" class="btn btn-primary">Ruaj</button>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    const priceInput = document.getElementById("price");

    priceInput.addEventListener("input", function () {
        // Get the current value of the input
        let value = priceInput.value;

        // Format the value with two decimal places
        value = parseFloat(value).toFixed(2);

        // Set the formatted value back to the input
        priceInput.value = value;
    });
</script>
