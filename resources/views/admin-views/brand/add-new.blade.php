@extends('layouts.back-end.app')
@section('title','Añadir Marca')
<style>
     #brand-image-modal .modal-content{
              width: 1116px !important;
            margin-left: -264px !important;
        }
        #image-count-brand-image-modal{
            width: 100%;

        }

        @media(max-width:768px){
            #brand-image-modal .modal-content{
                width: 698px !important;
    margin-left: -75px !important;
        }


        }
        @media(max-width:375px){
            #brand-image-modal .modal-content{
              width: 367px !important;
            margin-left: 0 !important;
        }

        }

   @media(max-width:500px){
    #brand-image-modal .modal-content{
              width: 400px !important;
            margin-left: 0 !important;
        }

        .btn-for-m{
            margin-bottom: 10px;
        }
       .parcent-margin{
           margin-left: 0px !important;
       }
   }
</style>
@push('css_or_js')
    <link href="{{asset('public/assets/back-end')}}/css/select2.min.css" rel="stylesheet"/>
    <link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{trans('messages.Dashboard')}}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{trans('messages.brand')}}</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-black-50">{{ trans('messages.brand')}}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ trans('messages.brand_form')}}
                </div>
                <div class="card-body">
                    <form action="{{route('admin.brand.add-new')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10">
                                    <label for="name">{{ trans('messages.name')}}</label>
                                    <input type="text" name="name" required class="form-control" id="name" placeholder="">
                                </div>
                                <div class="col-md-2 ">
                                    <label for="name">{{ trans('messages.brand_logo')}}</label>
                                    <button type="button" class="btn bg-secondary text-light btn-sm " data-toggle="modal"
                                            data-target="#brand-image-modal" data-whatever="@mdo"
                                            id="image-count-brand-image-modal">
                                            <i class="tio-add-circle"></i>{{ trans('messages.Upload')}}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success" style="background: #258934">{{ trans('messages.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    @include('shared-partials.image-process._image-crop-modal',['modal_id'=>'brand-image-modal'])
    <!--modal-->

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ trans('messages.brand_table')}}</h5>
                </div>
                <div class="card-body" style="padding: 0">
                    <div class="table-responsive">
                        <table id="columnSearchDatatable"
                               class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                               data-hs-datatables-options='{
                                 "order": [],
                                 "orderCellsTop": true
                               }'>
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">{{ trans('messages.name')}}</th>
                                <th scope="col">{{ trans('messages.image')}}</th>
                                <th scope="col" style="width: 50px">{{ trans('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($br as $k=>$b)
                                <tr>
                                    <th scope="row">{{$k+1}}</th>
                                    <td>{{$b['name']}}</td>
                                    <td>
                                        <img width="80"
                                             onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                             src="{{asset('storage/app/public/brand')}}/{{$b['image']}}">
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                href="{{route('admin.brand.update',[$b['id']])}}">{{ trans('messages.Edit')}} </a>
                                                <a class="dropdown-item delete"
                                                id="{{$b['id']}}"> {{ trans('messages.Delete')}}</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{$br->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{asset('public/assets/back-end')}}/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    @include('shared-partials.image-process._script',[
     'id'=>'brand-image-modal',
     'height'=>400,
     'width'=>800,
     'multi_image'=>false,
     'route'=>route('image-upload')
     ])

    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: '¿Estás seguro de eliminar es marca?',
                text: "¡No podrás revertir esto!",
                showCancelButton: true,
                confirmButtonColor: '#258934',
                cancelButtonColor: 'Dark',
                confirmButtonText: '¡Sí, bórralo!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{route('admin.brand.delete')}}",
                        method: 'POST',
                        data: {id: id},
                        success: function () {
                            toastr.success('Marca eliminada correctamente');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush