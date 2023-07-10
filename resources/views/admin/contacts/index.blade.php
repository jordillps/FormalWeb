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

                            <span class="card_title">
                                {{ __('global.contacts') }}
                            </span>
                        </div>
                    </div>
                    @include('flash::message')

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="item_datatable" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>{{ __('global.id') }}</th>
                                        <th>{{ __('global.name') }}</th>
										<th>{{ __('global.email') }}</th>
                                        <th>{{ __('global.phone') }}</th>
                                        <th>{{ __('global.subject') }}</th>
                                        <th>{{ __('global.message') }}</th>
                                        <th>{{ __('global.date') }}</th>
                                        <th>{{ __('global.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->id }}</td>
                                            <td>{{ $contact->name }}</td>
											<td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->subject }}</td>
                                            <td>{{ $contact->message }}</td>
                                            <td>{{ Carbon\Carbon::parse($contact->created_at)->format('d-m-Y') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-item-name="{{ $contact->name }}" data-item-id="{{ $contact->id }}" data-target="#modal-delete"><i class="fa fa-fw fa-trash"></i>
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
                var route = "{{ route('contacts-list.destroy',  'id' ) }}";
                route = route.replace('id', button.data('item-id'));
                $('#deleteItemForm').attr('action', route);
            });

        });

    </script>
@endpush