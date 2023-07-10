<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label(trans('global.page')) }}
            {!! Form::select('page_id', $pages, $title->page_id, ['class' => 'form-control' . ($errors->has('page_id') ? ' is-invalid' : '')]) !!}
            {!! $errors->first('page_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(trans('global.title')) }}
            {{ Form::text('title:'.app()->getLocale(), $title->{'title:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('title:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Title']) }}
            {!! $errors->first('title:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label(trans('global.text')) }}
            {{ Form::textarea('text:'.app()->getLocale(), $title->{'text:'. app()->getLocale()}, ['class' => 'form-control' . ($errors->has('text:'.app()->getLocale()) ? ' is-invalid' : ''), 'placeholder' => 'Text', 'rows' => 2]) }}
            {!! $errors->first('text:'.app()->getLocale(), '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-info">{{ __('global.save') }}</button>
    </div>
</div>