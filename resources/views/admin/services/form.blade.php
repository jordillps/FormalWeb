@push('styles')
    <link href="{{asset('css/admin/dropzone.min.css')}}" rel="stylesheet" />
@endpush
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label(trans('global.title')) }}
            {{ Form::text('title:'.app()->getLocale(), $service->{'title:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('title:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(trans('global.text')) }}
            {{ Form::textarea('text:'.app()->getLocale(), $service->{'text:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('text:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Text', 'rows' => 2]) }}
            {!! $errors->first('text:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
          {{ Form::label(trans('global.body')) }}
          {{ Form::textarea('body:'.app()->getLocale(), $service->{'body:'. app()->getLocale()}, ['id'=> "summernote",'class' => 'form-control' . ($errors->has('body:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Body']) }}
          {!! $errors->first('body:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
      </div>
        <div class="form-group">
          {{ Form::label(trans('global.icons')) }}
          <div class="form-group-icons">
            <div class="row align-items-center">
              {{ Form::radio('icon','web-design.svg', $service->icon == 'web-design.svg') }}
              <span class="ico-circle"><img src="{{ asset('img/web/icons/web-design.svg') }}" alt=""></span> 
            </div>
            <div class="row align-items-center">
              {{ Form::radio('icon','branding.svg', $service->icon == 'branding.svg') }}
              <span class="ico-circle"><img src="{{ asset('img/web/icons/branding.svg') }}" alt=""></span>
            </div>
            <div class="row align-items-center">
              {{ Form::radio('icon','graphic-design.svg', $service->icon == 'graphic-design.svg') }}
              <span class="ico-circle"><img src="{{ asset('img/web/icons/graphic-design.svg') }}" alt=""></span>
            </div>
            <div class="row align-items-center">
              {{ Form::radio('icon','coding.svg', $service->icon == 'coding.svg') }}
              <span class="ico-circle"><img src="{{ asset('img/web/icons/coding.svg') }}" alt=""></span> 
            </div>
            <div class="row align-items-center">
              {{ Form::radio('icon','idea.svg', $service->icon == 'idea.svg') }}
              <span class="ico-circle"><img src="{{ asset('img/web/icons/idea.svg') }}" alt=""></span> 
            </div>
          </div>
          {!! $errors->first('text:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            <label for="document">{{ __('global.service-image') }}</label>
            <ul>
              <li>{{ __('global.first-image-services') }}</li>
              <li>{{ __('global.icon-services-images') }}</li>
            </ul>
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
          url: '{{ route('services.storeMedia') }}',
          maxFilesize: 1, // MB
          acceptedFiles: ".png,.jpg,.gif,.webp,.svg",
          addRemoveLinks: true,
          // maxFiles:1,
          uploadMultiple: false,
          // resizeWidth: 1920,
          // resizeHeight: 1055,
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          dictDefaultMessage : 'Arrastrar para subir las fotografías',
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
            @if(isset($service) && $service->images)
              var files ={!! json_encode($service->images) !!}
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