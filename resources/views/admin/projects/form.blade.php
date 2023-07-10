@push('styles')
    <link href="{{asset('css/admin/dropzone.min.css')}}" rel="stylesheet" />
@endpush

<div class="box box-info padding-1">
  <div class="box-body">
      <div class="form-group">
          {{ Form::label(trans('global.title')) }}
          {{ Form::text('title:'.app()->getLocale(), $project->{'title:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('title:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
          {!! $errors->first('title:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
      </div>
      <div class="form-group">
          {{ Form::label(trans('global.text')) }}
          {{ Form::textarea('text:'.app()->getLocale(), $project->{'text:'. app()->getLocale()}, ['id'=> "summernote",'class' => 'form-control' . ($errors->has('text:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'text']) }}
          {!! $errors->first('text:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
      </div>
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            {{ Form::label(trans('global.published_at')) }}
            {{ Form::date('published_at', $project->published_at, ['class' => 'form-control' . ($errors->has('published_at') ? ' is-invalid' : ''), 'placeholder' => 'Published At']) }}
            {!! $errors->first('published_at', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
              {{ Form::label(trans('global.category')) }}
              @if(Route::is('projects.create'))
                  {!! Form::select('category_id', $categories, null, ['class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : '')]) !!}
              @else
                  {!! Form::select('category_id', $categories, $project->category_id, ['class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : '')]) !!}
              @endif
              {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
            {{ Form::label(trans('global.period-time')) }}
            {{ Form::text('period-time:'.app()->getLocale(), $project->{'period-time:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('period-time:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => trans('global.period-time')]) }}
            {!! $errors->first('period-time:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            {{ Form::label(trans('global.company')) }}
              {{ Form::text('company', $project->company, ['class' => 'form-control' . ($errors->has('company') ? ' is-invalid' : ''), 'placeholder' => trans('global.company')]) }}
              {!! $errors->first('company', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
            {{ Form::label(trans('global.location')) }}
              {{ Form::text('location', $project->location, ['class' => 'form-control' . ($errors->has('location') ? ' is-invalid' : ''), 'placeholder' => 'location']) }}
              {!! $errors->first('location', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
            {{ Form::label(trans('global.project-link')) }}
              {{ Form::text('projectLink', $project->projectLink, ['class' => 'form-control' . ($errors->has('projectLink') ? ' is-invalid' : ''), 'placeholder' => trans('global.project-link')]) }}
              {!! $errors->first('projectLink', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label for="document">{{ __('global.upload-images-projects') }}</label>
        <ul>
          <li>{{ __('global.first-image-home') }}</li>
          <li>{{ __('global.two-third-image-projects') }}</li>
        </ul>
        <div class="needsclick dropzone" id="document-dropzone">
        </div>
    </div>
  </div>
  <div class="box-footer mt20">
      <div class="form-group">
        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
          {!!Form::checkbox('isPublished', '1', $project->isPublished, ['id' => "Publicado", 'class' => 'custom-control-input']) !!}
          {{Form::label(trans('Publicado'), trans('global.is-published'),['class' => 'custom-control-label'])}}
        </div>
      </div>
      <button type="submit" class="btn btn-info">{{ __('global.save') }}</button>
  </div>
</div>

@push('scripts')
    <script src="{{asset('js/dropzone.min.js')}}"></script>
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
          url: '{{ route('projects.storeMedia') }}',
          maxFilesize: 1, // MB
          acceptedFiles: ".png,.jpg,.gif,.webp",
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
            @if(isset($project) && $project->images)
              var files ={!! json_encode($project->images) !!}
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