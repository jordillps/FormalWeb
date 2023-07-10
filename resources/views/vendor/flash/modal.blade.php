<div id="flash-overlay-modal" class="modal fade {{ isset($modalClass) ? $modalClass : '' }} 
        {{ str_contains($body, 'successfully') ? 'success' : '' }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $title }}</h4>
            </div>

            <div class="modal-body">
                <p>{!! $body !!}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn  {{ str_contains($body, 'successfully') ? 'btn-success' : 'btn-default' }}" data-dismiss="modal">{{ __('global.close') }}</button>
            </div>
        </div>
    </div>
</div>
