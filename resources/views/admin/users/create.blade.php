@extends('layouts.admin')

@section('content')
<div class="content-wrapper">
    
    @include('admin.partials.header')

    <section class="content container-fluid">
        <div class="row">
            <div class="col-sm-12">

                @includeif('partials.errors')

                <div class="card card-info">
                    <div class="card-header">
                      <div class="float-left">
                        <span class="card-title">{{ __('global.create-user') }}</span>
                      </div>
                      <div class="float-right">
                          <a class="btn btn-primary" href="{{ route('users.index') }}">{{ __('global.back') }}</a>
                      </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('admin.users.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
