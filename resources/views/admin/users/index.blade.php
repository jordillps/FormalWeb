@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin/dataTables.min.css')}}">
@endpush

@section('content')

<div class="content-wrapper">
    
    @include('admin.partials.header')

    <section class="content container-fluid">
        <div class="col-sm-12">
            <div class="card card-info">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span class="card_title">
                            {{ __('global.users') }}
                        </span>
                        @if(Auth::user()->isAdmin())
                            <div class="float-right">
                                <a href="{{ route('users.create') }}" class="btn btn-primary float-right"  data-placement="left">
                                {{ __('global.create') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                @include('flash::message')

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="item_datatable" class="table table-striped" style="width:100%">
                            <thead class="thead">
                                <tr>
                                    <th>{{ __('global.id') }}</th>
                                    <th>{{ __('global.image') }}</th>
                                    <th>{{ __('global.name') }}</th>
                                    <th>{{ __('global.role') }}</th>
                                    <th>{{ __('global.email') }}</th>
                                    <th>{{ __('global.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        @if(count($user->getMedia('images'))>0)
                                            <td><img src="{{ $user->getMedia('images')[0]->getUrl() }}" alt="" style="width:40px;"></td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            
                                                <a class="btn btn-sm btn-primary " href="{{ route('users.show',$user) }}"><i class="fa fa-fw fa-eye"></i>{{ __("global.show") }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('users.edit',$user) }}"><i class="fa fa-fw fa-edit"></i>{{ __("global.edit") }}</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-item-id="{{ $user->id }}" data-item-name="{{ $user->name }}" data-target="#modal-delete"><i class="fa fa-fw fa-trash"></i>
                                                    {{ __('global.delete') }}
                                                  </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>    
</div>

@include('partials.confirm-delete-modal')
@endsection

@push('scripts')
    <script src="{{asset('js/dataTables.min.js')}}"></script>

    <script>
        $('#flash-overlay-modal').modal();

        $(document).ready( function () {
            var locale_lang = "{{app()->getLocale()}}";
            switch(locale_lang) {
                case 'en':
                    var language_datatable = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
                    break;
                case 'es':
                    var language_datatable = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json";
                    break;
                case 'ca':
                    var language_datatable = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Catalan.json";
                    break;
                default:
                    var language_datatable = "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json";
            }
            $('#item_datatable').DataTable({
                    "language": {
                        "url": language_datatable
                    },
            });

            $('#deleteItemForm').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                const id = 'id';
                $('.modal-title').text("{{ __('global.delete') }} " + button.data('item-name'));
                var route = "{{ route('users.destroy',  'id' ) }}";
                route = route.replace('id',button.data('item-id'));
                $('#deleteItemForm').attr('action', route);
            });

        });

    </script>
@endpush
