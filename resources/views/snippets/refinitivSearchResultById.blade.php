<?php $printUrl = url("/thomson-print/" . $data['UID']); ?>
<div class="container-fluid">

    <form class="form-horizontal">
<fieldset>
	<legend><a href="{{$printUrl}}" target="_blank" class="btn btn-primary">Print Preview</a></legend>
<!-- Text input-->
<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Inserted to Intellinz</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['CREATED_AT']}}</div>
  </div>
</div>

<!-- Text input-->
<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Date Inserted to Refinitiv</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['ENTERED']}}</div>
  </div>
</div>

<!-- Text input-->
<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Date Updated by Refinitiv</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['UPDATED']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">First Name</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['FIRST_NAME']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Last Name</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['LAST_NAME']}}</div>
  </div>
</div>


<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Countries</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['COUNTRIES']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Companies</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['COMPANIES']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Aliases</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['ALIASES']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Low quality aliases</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['LOW_QUALITY_ALIASES']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Category</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['CATEGORY']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Title</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['TITLE']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Alternative Spelling</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['ALTERNATIVE_SPELLING']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Gender</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['E_I']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Position</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['POSITION']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Date Of Birth</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['DOB']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Locations</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['LOCATIONS']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Passport</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['PASSPORTS']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Citizenship</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['CITIZENSHIP']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Place Of Birth</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['PLACE_OF_BIRTH']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Keywords</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['KEYWORDS']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">Further Information</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['FURTHER_INFORMATION']}}</div>
  </div>
</div>

<div class="form-group" style="margin-bottom: -5px;">
  <label class="col-md-3 control-label">External Sources</label>  
  <div class="col-md-9 inputGroupContainer">
  	<div class="well" style="padding: 5px">{{$data['EXTERNAL_SOURCES']}}</div>
  </div>
</div>

</fieldset>
</form>
</div>
    </div><!-- /.container -->