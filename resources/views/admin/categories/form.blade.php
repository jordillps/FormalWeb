<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label(trans('global.name')) }}
              {{ Form::text('name:'.app()->getLocale(), $category->{'name:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('name:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
              {!! $errors->first('name:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="form-group">
              {{ Form::label('url') }}
              {{ Form::text('url:'.app()->getLocale(), $category->{'url:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('url:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Url']) }}
              {!! $errors->first('url:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
            </div>
          </div>
        </div>   
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-info">{{ __('global.save') }}</button>
    </div>
</div>