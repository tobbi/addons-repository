@extends('layout.layout')

@section('title', 'Import Add-ons')
@section('additional_head_tags')
<script type="text/javascript">
function performGETRequest($caller)
{
  var modal = $("#importModal");
  var $progressBar = $('.modal-body .progress-bar-import');
  $caller.setAttribute('disabled', '');
  
  $progressBar.width('20%');
  $progressBar.removeClass('bg-danger bg-success');

  $('#importModalLabel').text("Importing nfo file...");
  modal.modal();

  var nfoUrl = document.getElementById('nfoURL').value;
  $.post('/addons/parse-nfo', 
  {
    _token: "{{ csrf_token() }}",
    nfoURL: nfoUrl
  },
  function(response) {
    var $result = JSON.parse(response);
    $progressBar.text($result.text);
    $progressBar.removeClass('progress-bar-animated');
    $progressBar.width('100%');
    if($result.error_code > -1)
    {
      $('#importModalLabel').text("Import failed");
      $progressBar.addClass('bg-danger');
    }
    else
    {
      $('#importModalLabel').text("Import successful!");
      $progressBar.addClass('bg-success');
    }
    $caller.removeAttribute('disabled');
  });
}
</script>
@endsection

@section('content')
<div class="container">
<div class='page-header'>
<h2>Import add-ons</h2>
</div>
<!-- <form action="/addons/parse-nfo" method="POST" enctype="multipart/form-data"> -->
<div class="form-group row">
    <label for="nfoURL" class="col-sm-2 col-form-label">.nfo URL</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="nfoURL" placeholder="http://www.example.com/v0.5.0.nfo" name="nfoURL">
    </div>
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <button type="submit" class="btn btn-primary btn-import" onclick='performGETRequest(this);'>Import add-ons</button>
<!-- </form> -->

<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModalLabel">Importing add-ons...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-import" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 75%">Importing add-ons...</div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Import another nfo file</button>
        <a class="btn btn-primary" href="/addons" role="button">Return to listing</a>
      </div>
    </div>
  </div>
</div>

</div>
@endsection