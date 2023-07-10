@push('styles')
    <link href="{{asset('css/admin/dropzone.min.css')}}" rel="stylesheet" />
@endpush

<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label(trans('global.name')) }}
              {{ Form::text('name', $about->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
              {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label(trans('global.profession')) }}
              {{ Form::text('profession:'.app()->getLocale(), $about->{'profession:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('profession:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Profession']) }}
              {!! $errors->first('profession:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label(trans('global.slogan')) }}
              {{ Form::text('slogan:'.app()->getLocale(), $about->{'slogan:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('slogan:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Slogan']) }}
              {!! $errors->first('slogan:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label(trans('global.languages')) }}
              {{ Form::text('languages:'.app()->getLocale(), $about->{'languages:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('languages:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'languages']) }}
              {!! $errors->first('languages:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
        </div>   
        <div class="form-group">
            {{ Form::label(trans('global.about_me')) }}
            {{ Form::textarea('about_me:'.app()->getLocale(), $about->{'about_me:'. app()->getLocale()}, ['id'=> 'summernote','class' => 'form-control' . ($errors->has('about_me:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'About Me']) }}
            {!! $errors->first('about_me:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="row">
          <div class="col-12 col-md-4">
            <div class="form-group">
              {{ Form::label(trans('global.email')) }}
              {{ Form::text('email', $about->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
              {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              {{ Form::label(trans('global.phone')) }}
              {{ Form::text('phone', $about->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''), 'placeholder' => 'Phone']) }}
              {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-4">
            <div class="form-group">
              {{ Form::label(trans('global.city')) }}
              {{ Form::text('city', $about->city, ['class' => 'form-control' . ($errors->has('city') ? ' is-invalid' : ''), 'placeholder' => 'City']) }}
              {!! $errors->first('city', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-3">
              <div class="form-group">
                  {{ Form::label('html') }}
                  {{ Form::text('html', $about->html, ['class' => 'form-control' . ($errors->has('html') ? ' is-invalid' : ''), 'placeholder' => 'Html']) }}
                  {!! $errors->first('html', '<div class="invalid-feedback">:message</div>') !!}
              </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
                {{ Form::label('css') }}
                {{ Form::text('css', $about->css, ['class' => 'form-control' . ($errors->has('css') ? ' is-invalid' : ''), 'placeholder' => 'Css']) }}
                {!! $errors->first('css', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
                {{ Form::label('php') }}
                {{ Form::text('php', $about->php, ['class' => 'form-control' . ($errors->has('php') ? ' is-invalid' : ''), 'placeholder' => 'Php']) }}
                {!! $errors->first('php', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
                {{ Form::label('javascript') }}
                {{ Form::text('javascript', $about->javascript, ['class' => 'form-control' . ($errors->has('javascript') ? ' is-invalid' : ''), 'placeholder' => 'Javascript']) }}
                {!! $errors->first('javascript', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
                {{ Form::label('bootstrap') }}
                {{ Form::text('bootstrap', $about->bootstrap, ['class' => 'form-control' . ($errors->has('bootstrap') ? ' is-invalid' : ''), 'placeholder' => 'Bootstrap']) }}
                {!! $errors->first('bootstrap', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
                {{ Form::label('laravel') }}
                {{ Form::text('laravel', $about->laravel, ['class' => 'form-control' . ($errors->has('laravel') ? ' is-invalid' : ''), 'placeholder' => 'Laravel']) }}
                {!! $errors->first('laravel', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
                {{ Form::label('mysql') }}
                {{ Form::text('mysql', $about->mysql, ['class' => 'form-control' . ($errors->has('mysql') ? ' is-invalid' : ''), 'placeholder' => 'Mysql']) }}
                {!! $errors->first('mysql', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-3">
            <div class="form-group">
                {{ Form::label('git') }}
                {{ Form::text('git', $about->git, ['class' => 'form-control' . ($errors->has('git') ? ' is-invalid' : ''), 'placeholder' => 'Git']) }}
                {!! $errors->first('git', '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="document">{{ __('global.image-uploaded-warining-1') }}</label>
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
          url: '{{ route('abouts.storeMedia') }}',
          maxFilesize: 1, // MB
          acceptedFiles: ".png,.jpg,.gif,.webp",
          addRemoveLinks: true,
          maxFiles:1,
          uploadMultiple: false,
          headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
          },
          dictDefaultMessage : "{{ __('global.drag-to-upload') }}",
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
            @if(isset($about) && $about->images)
              var files ={!! json_encode($about->images) !!}
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