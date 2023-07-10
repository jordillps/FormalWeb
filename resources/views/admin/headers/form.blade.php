@push('styles')
    <link href="{{asset('css/admin/dropzone.min.css')}}" rel="stylesheet" />
@endpush

<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label(trans('global.page')) }}
            {!! Form::select('page_id', $pages, $header->page_id, ['class' => 'form-control' . ($errors->has('page_id') ? ' is-invalid' : '')]) !!}
            {!! $errors->first('page_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(trans('global.title')) }}
            {{ Form::text('title:'.app()->getLocale(), $header->{'title:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('title:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(trans('global.text')) }}
            {{ Form::textarea('text:'.app()->getLocale(), $header->{'text:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('text:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Text']) }}
            {!! $errors->first('text:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="document">{{ __('global.header-image-warning') }}</label>
            <div class="needsclick dropzone" id="document-dropzone">
    
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
          url: '{{ route('headers.storeMedia') }}',
          maxFilesize: 1, // MB
          acceptedFiles: ".png,.jpg,.gif,.webp",
          addRemoveLinks: true,
          maxFiles:1,
          uploadMultiple: false,
          //resizeWidth: 1920,
          // resizeHeight: 1055,
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          dictDefaultMessage : 'Arrastrar para subir las fotografías',
          dictInvalidFileType: 'Este formulario solo acepta imágenes.',
          success: function (file, response) {
            $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
          },
          removedfile: function (file) {
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
            @if(isset($header) && $header->images)
              var files ={!! json_encode($header->images) !!}
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