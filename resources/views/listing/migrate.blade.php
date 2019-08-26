@extends('layout.layout')

@section('title', 'Import Add-ons')
@section('additional_head_tags')
<script type="text/javascript">
function performGETRequest($caller)
{
  var modal = $("#importModal");
  var $progressBar = $('.modal-body .progress-bar-import');
  $caller.setAttribute('disabled', '');
  
  $progressBar.text("");
  $progressBar.removeClass('bg-danger bg-success');
  $progressBar.addClass('progress-bar-animated');

  $('#importModalLabel').text("Importing nfo file...");
  modal.modal();

  var nfoUrl = document.getElementById('nfoURL').value;
  var stVersion = document.getElementById('supertux_version').value;
  $.post('/addons/parse-nfo', 
  {
    _token: "{{ csrf_token() }}",
    nfoURL: nfoUrl,
    stVersion: stVersion
  }).done(
  function(response) {
    $progressBar.text(response.text);
    $progressBar.removeClass('progress-bar-animated');
    if(response.error_code > -1)
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
  }).fail(
    function(response)
    {
      $progressBar.text("Import failed!");
      $progressBar.addClass('bg-danger');
      $progressBar.removeClass('progress-bar-animated');
      $caller.removeAttribute('disabled');
    });
}

function prefillVersionSelect($el)
{
  var $url = $($el).val();
  var versionRegEx = /\d_\d(_\d)?/;
  if(versionRegEx.test($url))
  {
    var $match = versionRegEx.exec($url)[0].replace(/_/g, ".");
    // Check exact match:
    $("#supertux_version option").each(function($option, $el) {
      var option_val = $($el).text();
      var option_value_attr = $($el).attr("value");
      if($match == option_val || $match + ".0" == option_val || $match == option_val + ".0")
        $("#supertux_version").val(option_value_attr);
    })
  }
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
    <input type="url" class="form-control" id="nfoURL" placeholder="http://www.example.com/v0.5.0.nfo" name="nfoURL" oninput="prefillVersionSelect(this);">
    </div>

    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <div class="form-group row">
    <label for="supertux_version" class="col-sm-2 col-form-label">SuperTux version</label>
    <div class="col-sm-10">
      <select class="form-control" id="supertux_version" name="supertux_version">
        @foreach($st_versions as $version)
      <option value="{{ $version->id }}">{{ $version->name }}</option>
        @endforeach
      </select>
    </div>
    
    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
  </div>
  <button type="submit" class="btn btn-primary btn-import" onclick='performGETRequest(this);'>Import add-ons</button>
<!-- </form> -->
@component('layout.modal')
  @slot('modal_id', 'importModal')
  @slot('modal_title', 'Importing add-ons...')
  @slot('modal_content')
  <div class="progress">
    <div class="progress-bar progress-bar-striped progress-bar-animated progress-bar-import" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Importing add-ons...</div>
  </div>
  @endslot
  @slot('modal_ok_label', 'Import another nfo file')
  @slot('modal_cancel_label', 'Return to listing')
  @slot('modal_cancel_target', '/')
@endcomponent

</div>
@endsection