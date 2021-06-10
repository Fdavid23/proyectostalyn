@extends('layouts.back-end.app')
@section('title','General Setting')
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #258934;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #258934;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="content container-fluid">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Panel de control</a></li>
            <li class="breadcrumb-item" aria-current="page">Configuración general</li>
        </ol>
    </nav>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h4 class="mb-0 text-black-50">Configuración comercial general</h4>
    </div>

    <div class="row" style="margin-top: 20px">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between pl-4 pr-4">
                        <div>
                            <h5>Tabla de idiomas</h5>
                        </div>
                    </div>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_id" class="display table table-hover " style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col">#SL</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">{{trans('message.Action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($language=App\Model\BusinessSetting::where('type','language')->first())
                                @foreach(json_decode($language['value'],true) as $key =>$data)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$data['id']}}</td>
                                        <td>{{$data['name']}}</td>
                                        <td>{{$data['code']}}</td>
                                        <td style="width: 100px">
                                            <label class="switch">
                                                <input type="checkbox" onclick="updateStatus('{{route('admin.business-settings.update-language')}}','{{$data['id']}}')"
                                                       class="status" {{$data['status']==1?'checked':''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });

        function updateStatus(route,id) {
            $.get({
                url: route,
                data: {
                    id: id,
                },
                success: function (data) {
                   /* console.log(data)*/
                }
            });
        }
    </script>
@endpush