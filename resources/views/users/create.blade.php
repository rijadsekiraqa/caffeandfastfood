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
            <form method="post" action="/users">
                @csrf
                @method("POST")

                <div class="form-group">
                    <label for="name">Emri</label>
                    <input type="text" name="firstname" id="firstname" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="name">Mbiemri</label>
                    <input type="text" name="lastname" id="lastname" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="name">Emri Perdorues</label>
                    <input type="text" name="username" id="username" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="" required>
                </div>
                <div class="form-group">
                    <label for="password"> Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="type" class="control-label">Roli</label>
                    <select name="role" id="type" class="form-control form-control-sm rounded-0" required>
                        <option value=""> Select </option>
                        <option value="admin">Administrator</option>
                        <option value="staff">Staff</option>
                    </select>
                </div>
{{--                <div class="form-group">--}}
{{--                    <label for="" class="control-label">Avatar</label>--}}
{{--                    <div class="custom-file">--}}
{{--                        <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">--}}
{{--                        <label class="custom-file-label" for="customFile">Choose file</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary rounded-0 mr-3">Ruaj</button>
                </div>
                @if($errors->any())
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
        </section>
</div>



    @include('layouts.footer-admin')
@endsection
