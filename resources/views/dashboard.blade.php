@extends('layouts.header')



@section('content')
    @include('layouts.sidebar')
    <div class="content-wrapper" style="min-height: 567.854px;">

        <!-- Main content -->
        <section class="content  text-dark">
            <div class="container-fluid">

                <h1>Welcome to </h1>
                <hr>
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-light elevation-1"><i
                                    class="fas fa-th-list"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Kategorite</span>
                                <span class="info-box-number text-right">{{$category}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-navy elevation-1"><i
                                    class="fas fa-mug-hot"></i></span>
                            <div class="info-box-content">
                                <a href="#"> <span class="info-box-text">Produktet</span></a>
                                <span class="info-box-number text-right">{{$product}}

                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-12 col-sm-4 col-md-4">
                        <div class="info-box">
                            <span class="info-box-icon bg-gradient-primary elevation-1"><i
                                    class="fas fa-calendar-day"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Shitjet Ditore</span>
                                <span class="info-box-number text-right">
  {{ $totalSalesForToday }}
                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </section>
        <div class="container">

            <div id="tourCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner h-100">

                    <div class="carousel-item  h-100">
                        <img class="d-block w-100  h-100" style="object-fit:contain" src="" alt="">
                    </div>

                </div>
                <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmimi</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='confirm' onclick="">Po</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">
                        Ruaj
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Dil</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog modal-full-height  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="fa fa-arrow-right"></span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewer_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                <img src="" alt="">
            </div>
        </div>
    </div>

    @include('layouts.footer-admin')
@endsection
