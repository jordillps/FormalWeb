<form id="deleteItemForm" action="" method="POST">
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>{{ __('global.sure') }}</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('global.close') }}</button>
                    <button type="submit" class="btn btn-info">{{ __('global.delete') }}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</form>