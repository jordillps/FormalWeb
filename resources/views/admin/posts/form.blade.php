@push('styles')
    <link href="{{asset('css/admin/dropzone.min.css')}}" rel="stylesheet" />
@endpush

<div class="box box-info padding-1">
  <div class="box-body">
      <div class="form-group">
          {{ Form::label(trans('global.title')) }}
          {{ Form::text('title:'.app()->getLocale(), $post->{'title:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('title:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
          {!! $errors->first('title:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
      </div>
      <div class="form-group">
          {{ Form::label(trans('global.excerpt')) }}
          {{ Form::text('excerpt:'.app()->getLocale(), $post->{'excerpt:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('excerpt:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Excerpt']) }}
          {!! $errors->first('excerpt:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
      </div>
      <div class="form-group">
          {{ Form::label(trans('global.iframe')) }}
          {{ Form::text('iframe:'.app()->getLocale(), $post->{'iframe:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('iframe:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Iframe']) }}
          {!! $errors->first('iframe:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
      </div>
      <div class="form-group">
          {{ Form::label(trans('global.body')) }}
          {{ Form::textarea('body:'.app()->getLocale(), $post->{'body:'. app()->getLocale()}, ['id'=> "summernote",'class' => 'form-control' . ($errors->has('body:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Body']) }}
          {!! $errors->first('body:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
      </div>
      <div class="row">
        <div class="col-12 col-md-3">
          <div class="form-group">
            {{ Form::label(trans('global.published_at')) }}
            {{ Form::date('published_at', $post->published_at, ['class' => 'form-control' . ($errors->has('published_at') ? ' is-invalid' : ''), 'placeholder' => 'Published At']) }}
            {!! $errors->first('published_at', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
              {{ Form::label(trans('global.author')) }}
              @if(Route::is('posts.create'))
                  {!! Form::select('user_id', $users, null, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : '')]) !!}
              @else
                  {!! Form::select('user_id', $users, $post->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : '')]) !!}
              @endif
              {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
              {{ Form::label(trans('global.category')) }}
              @if(Route::is('posts.create'))
                  {!! Form::select('category_id', $categories, null, ['class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : '')]) !!}
              @else
                  {!! Form::select('category_id', $categories, $post->category_id, ['class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : '')]) !!}
              @endif
              {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="form-group">
            {{Form::label(trans('global.tags'))}}
            @if(Route::is('posts.create'))
              {!! Form::select('tags[]', $tags, null, ['id' => 'tags', 'multiple' => 'multiple', 'class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : '')]) !!}
            @else
              {!! Form::select('tags[]', $tags, $post->tags->pluck('id'), ['id' => 'tags', 'multiple' => 'multiple', 'class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : '')]) !!}
            @endif
            {!! $errors->first('tag_id', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
      </div>
      <div class="form-group">
          <label for="document">{{ __('global.upload-post-images') }}</label>
          <ul>
            <li>{{ __('global.first-image-posts') }}</li>
            <li>{{ __('global.second-image-posts') }}</li>
            <li>{{ __('global.third-image-posts') }}</li>
          </ul>
          <div class="needsclick dropzone" id="document-dropzone">
          </div>
      </div>
  </div>
  <div class="box-footer mt20">
    <div class="form-group">
      <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
        {!!Form::checkbox('isPublished', '1', $post->isPublished, ['id' => "Publicado", 'class' => 'custom-control-input']) !!}
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
          url: '{{ route('posts.storeMedia') }}',
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
            @if(isset($post) && $post->images)
              var files ={!! json_encode($post->images) !!}
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