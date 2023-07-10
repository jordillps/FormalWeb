@extends('layouts.admin')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/admin/dataTables.min.css')}}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('global.settings') }}
                            </span>
                        </div>
                    </div>
                    @include('flash::message')

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="item_datatable" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>                                        
										<th>{{ __('global.email') }}</th>
										<th>{{ __('global.phone') }}</th>
                                        <th>{{ __('global.email-contacts') }}</th>
                                        <th>{{ __('global.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($settings as $setting)
                                        <tr>
											<td>{{ $setting->email }}</td>
											<td>{{ $setting->phone }}</td>
											
											<td>{{ $setting->email_contacts }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-success" href="{{ route('settings.edit',$setting) }}"><i class="fa fa-fw fa-edit"></i>{{ __("global.edit") }}</a>
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
    </div>
</div>
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

        });

    </script>
@endpush
