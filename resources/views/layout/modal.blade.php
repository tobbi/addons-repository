<div class="modal fade" id="{{ $modal_id ?? 'modal'}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">{{ $modal_title ?? "Modal title" }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $modal_content }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $modal_ok_label ?? "OK"}}</button>
        <a class="btn btn-primary" href="/addons" role="button">{{ $modal_cancel_label ?? "Cancel" }}</a>
      </div>
    </div>
  </div>
</div>