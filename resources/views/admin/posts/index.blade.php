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
                                {{ __('global.posts') }}
                            </span>

                             <div class="float-right">
                                @if(app()->getLocale() != 'es')
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="{{ trans('global.create-warning', ['item' => trans('global.post')]) }}">
                                        <a href="{{ route('posts.create') }}" class="btn btn-primary float-right disabled"  data-placement="left">
                                        {{ __('global.create') }}
                                        </a>
                                    </span>
                                @else
                                    <a href="{{ route('posts.create') }}" class="btn btn-primary float-right"  data-placement="left">
                                        {{ __('global.create') }}
                                        </a>
                                @endif
                              </div>
                        </div>
                    </div>
                    @include('flash::message')

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="item_datatable" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>{{ __('global.id') }}</th>
										<th>{{ __('global.title') }}</th>
										<th>{{ __('global.published_at') }}</th>
                                        <th>{{ __('global.is-published-index') }}</th>
										<th>{{ __('global.author') }}</th>
										<th>{{ __('global.category') }}</th>

                                        <th>{{ __('global.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
											<td>{{ $post->{'title:'. app()->getLocale()} }}</td>
                                            @if(!$post->published_at)
											   <td></td> 
                                            @else
                                               <td>{{ Carbon\Carbon::parse($post->published_at)->format('d-m-Y')}}</td>
                                            @endif
                                            @if($post->isPublished)
											   <td><i class="nav-icon fas fa-check-circle fa-1x" style="color:green"></i></td> 
                                            @else
                                                <td><i class="nav-icon fas fa-times-circle fa-1x" style="color:red"></i></td>
                                            @endif
											<td>{{ $post->user->name }}</td>
											<td>{{ $post->category->{'name:'. app()->getLocale()} }}</td>

                                            <td>
                                                    <a class="btn btn-sm btn-primary " href="{{ route('posts.show',$post) }}"><i class="fa fa-fw fa-eye"></i>{{ __("global.show") }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('posts.edit',$post) }}"><i class="fa fa-fw fa-edit"></i>{{ __("global.edit") }}</a>
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-item-id="{{ $post->url }}" data-item-name="{{ $post->title }}" data-target="#modal-delete"><i class="fa fa-fw fa-trash"></i>
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
                var route = "{{ route('posts.destroy',  'id' ) }}";
                route = route.replace('id',button.data('item-id'));
                $('#deleteItemForm').attr('action', route);
            });

        });

    </script>
@endpush
