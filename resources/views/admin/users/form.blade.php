@push('styles')
    <link href="{{asset('css/admin/dropzone.min.css')}}" rel="stylesheet" />
@endpush

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label(trans('global.name')) }}
                            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label(trans('global.role')) }}
                            @if(Route::is('users.create'))
                                {!! Form::select('role_id', $roles, null, ['class' => 'form-control' . ($errors->has('role_id') ? ' is-invalid' : '')]) !!}
                            @else
                                {!! Form::select('role_id', $roles, $user->role_id, ['class' => 'form-control' . ($errors->has('role_id') ? ' is-invalid' : '')]) !!}
                            @endif
                            {!! $errors->first('role_id', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label(trans('global.email')) }}
                            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
                            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label(trans('global.date-of-birth')) }}
                            {{ Form::date('date_birth', $user->date_birth, ['class' => 'form-control' . ($errors->has('date_birth') ? ' is-invalid' : ''), 'placeholder' => 'Date of Birth']) }}
                            {!! $errors->first('date_birth', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                    </div>
                </div>
                @if(Route::is('users.create'))       
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                {{ Form::label(trans('global.password')) }}
                                {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'New Password']) }}
                                {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                {{ Form::label(trans('global.confirmpassword')) }}
                                {{ Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''), 'placeholder' => 'Confirm New Password']) }}
                                {!! $errors->first('password_confirmation', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                        </div>
                    </div>                      
                @endif
            </div>
            <div class="col-md-3">
                @if(count($user->getMedia('images'))>0)
                    <div class="card-body box-profile">
                        <div class="text-center">
                        <form action="{{ route('users.deleteMedia', ['media' => $user->getMedia('images')[0]])}}" method="POST">
                            {{ @method_field('DELETE')}}
                            @csrf
                            <img src="{{ $user->getMedia('images')[0]->getUrl() }}" alt="" style="max-width: 100%;">
                            <button class="btn btn-danger" style="position: absolute; left:20px;"><i class="far fa-trash-alt xs"></i></button>
                        </form>
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label for="document">{{ __('global.image') }}<small>{{ __('global.square-image') }}</small></label>
                        <div class="needsclick dropzone" id="document-dropzone">
                        </div>
                    </div>  
                @endif
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-info">{{ __('global.save') }}</button>
    </div>
</div>

@push('scripts')
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
          url: '{{ route('users.storeMedia') }}',
          maxFilesize: 1, // MB
          addRemoveLinks: true,
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          dictDefaultMessage : 'Arrastrar para subir las fotografías',
          success: function (file, response) {
            console.log(response);
            $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
          },
          removedfile: function (file) {
            console.log(file);
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
              name = file.file_name
            } else {
              name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="images[]"][value="' + name + '"]').remove()
          },
          init: function () {
            @if(isset($user) && $user->images)
              var files ={!! json_encode($user->images) !!}
                console.log(files);
              for (var i in files) {
                var file = files[i]
                console.log(file);
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
              }
            @endif
          }
        }
      </script>
@endpush


    

