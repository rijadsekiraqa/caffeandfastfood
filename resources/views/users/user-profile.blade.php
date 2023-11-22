@extends('layouts.header')

@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content  text-dark">
            <div class="container-fluid">

    <div class="card card-outline rounded-0 card-navy">
        <div class="card-body">
            <div class="container-fluid">
                <div id="msg"></div>
                <form action="{{ route('adminprofile.update', ['id' => $user->id]) }}" method="post" id="manage-user">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control" value="{{ $user->firstname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $user->lastname }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" value="">
                        <small><i>Lereni te zbrazet nese nuk deshironi te nderroni passwordin</i></small>
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="" class="control-label">Avatar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <img src="" alt="" id="cimg" class="img-fluid img-thumbnail">
                    </div>
                    -->
                    <div class="card-footer">
                        <div class="col-md-12">
                            <div class="row">
                                <button type="submit" class="btn btn-sm btn-primary" form="manage-user">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
            </div>
        </section>
    </div>
    <style>
        img#cimg{
            height: 15vh;
            width: 15vh;
            object-fit: cover;
            border-radius: 100% 100%;
        }
    </style>
{{--    <script>--}}
{{--        function displayImg(input,_this) {--}}
{{--            if (input.files && input.files[0]) {--}}
{{--                var reader = new FileReader();--}}
{{--                reader.onload = function (e) {--}}
{{--                    $('#cimg').attr('src', e.target.result);--}}
{{--                }--}}

{{--                reader.readAsDataURL(input.files[0]);--}}
{{--            }else{--}}
{{--                $('#cimg').attr('src', "");--}}
{{--            }--}}
{{--        }--}}
{{--        $('#manage-user').submit(function(e){--}}
{{--            e.preventDefault();--}}
{{--            start_loader()--}}
{{--            $.ajax({--}}
{{--                url:_base_url_+'classes/Users.php?f=save',--}}
{{--                data: new FormData($(this)[0]),--}}
{{--                cache: false,--}}
{{--                contentType: false,--}}
{{--                processData: false,--}}
{{--                method: 'POST',--}}
{{--                type: 'POST',--}}
{{--                success:function(resp){--}}
{{--                    if(resp ==1){--}}
{{--                        location.reload()--}}
{{--                    }else{--}}
{{--                        $('#msg').html('<div class="alert alert-danger">Username already exist</div>')--}}
{{--                        end_loader()--}}
{{--                    }--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}

{{--    </script>--}}





    @include('layouts.footer-admin')
@endsection
