@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin/dataTables.min.css')}}">
@endpush

@section('content')
<div class="content-wrapper">

    @include('admin.partials.header')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="card_title" id="card_title">
                                {{ __('global.legal-pages') }}
                            </span>

                             {{-- <div class="float-right">
                                <a href="{{ route('legal-pages.create') }}" class="btn btn-primary float-right"  data-placement="left">
                                  {{ __('global.create') }}
                                </a>
                              </div> --}}
                        </div>
                    </div>
                    @include('flash::message')

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>{{ __('global.id') }}</th>
                                        <th>{{ __('global.title') }}</th>
                                        <th>Url</th>
                                        <th>{{ __('global.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($legalPages as $legalPage)
                                        <tr>
                                            <td>{{ $legalPage->id }}</td>
                                            <td>{{ $legalPage->{'title:'. app()->getLocale()} }}</td>
                                            <td>{{ $legalPage->url }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-primary " href="{{ route('legal-pages.show',$legalPage->id) }}"><i class="fa fa-fw fa-eye"></i>{{ __("global.show") }}</a>
                                                <a class="btn btn-sm btn-success" href="{{ route('legal-pages.edit',$legalPage->id) }}"><i class="fa fa-fw fa-edit"></i>{{ __("global.edit") }}</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-item-id="{{ $legalPage->id }}" data-item-name="{{ $legalPage->title }}" data-target="#modal-delete"><i class="fa fa-fw fa-trash"></i>
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
        </div>
    </section>
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
                    var language_datatable = "{{asset('lang/en/dataTables.json')}}";
                    break;
                case 'es':
                    var language_datatable = "{{asset('lang/es/dataTables.json')}}";
                    break;
                case 'ca':
                    var language_datatable = "{{asset('lang/ca/dataTables.json')}}";
                    break;
                default:
                    var language_datatable = "{{asset('lang/en/dataTables.json')}}";
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
                var route = "{{ route('legal-pages.destroy',  'id' ) }}";
                route = route.replace('id',button.data('item-id'));
                $('#deleteItemForm').attr('action', route);
            });

        });

    </script>
@endpush

