<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label(trans('global.title')) }}
            {{ Form::text('title:'.app()->getLocale(), $legalPage->{'title:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('title:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(trans('global.body')) }}
            {{ Form::textarea('body:'.app()->getLocale(), $legalPage->{'body:'. app()->getLocale()}, ['id'=> "summernote",'class' => 'form-control' . ($errors->has('body:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Body']) }}
            {!! $errors->first('body:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-info">{{ __('global.save') }}</button>
    </div>
</div>