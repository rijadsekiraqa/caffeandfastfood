
<div class="container-fluid">
    <form action="" id="product-form">
        <input type="hidden" name ="id" value="">
        <div class="form-group">
            <label for="category_id" class="control-label">Kategoria</label>
            <select name="category_id" id="category_id" class="form-control form-control-sm rounded-0" required>
                <option value="" disabled></option>

                <option value="" </option>

            </select>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Emri</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" value="<?php echo isset($name) ? $name : ''; ?>"  required/>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Pershkrimi</label>
            <textarea type="text" name="description" id="description" class="form-control form-control-sm rounded-0" required><?php echo isset($description) ? $description : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="price" class="control-label">Qmimi</label>
            <input type="number" name="price" id="price" class="form-control form-control-sm rounded-0 text-left" value="<?php echo isset($price) ? $price : ''; ?>"  required/>
        </div>
        <div class="form-group">
            <label for="status" class="control-label">Statusi</label>
            <select name="status" id="status" class="form-control form-control-sm rounded-0" required>
                <option value="1" >Aktiv</option>
                <option value="0" >Deaktiv</option>
            </select>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('#uni_modal').on('shown.bs.modal', function(){
            $('#category_id').select2({
                placeholder:"Please select here",
                width: '100%',
                dropdownParent: $('#uni_modal'),
                containerCssClass: 'form-control form-control-sm rounded-0'
            })
        })
        $('#product-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_product",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        location.reload()
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body,.modal").scrollTop(0);
                        end_loader()
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                    }
                }
            })
        })

    })
</script>
