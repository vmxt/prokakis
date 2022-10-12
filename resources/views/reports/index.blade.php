@extends('layouts.app')
 
@section('content')

<style>
	html, body {
		width: 100%;
		height: 100%;
		margin: 0px;
		padding: 0px;
		overflow-x: hidden;
	}

    #edit_icon{
        cursor: pointer;
    }

    /* Outer */
.popup {
	width:100%;
	height:100%;
	display:none;
	position:fixed;
	top:0px;
	left:0px;
	background:rgba(0,0,0,0.75);
}

/* Inner */
.popup-inner {
	max-width:700px;
	width:90%;
	padding:40px;
	position:absolute;
	top:50%;
	left:50%;
	-webkit-transform:translate(-50%, -50%);
	transform:translate(-50%, -50%);
	box-shadow:0px 2px 6px rgba(0,0,0,1);
	border-radius:3px;
	background:#fff;
}

/* Close Button */
.popup-close {
	width:30px;
	height:30px;
	padding-top:4px;
	display:inline-block;
	position:absolute;
	top:0px;
	right:0px;
	transition:ease 0.25s all;
	-webkit-transform:translate(50%, -50%);
	transform:translate(50%, -50%);
	border-radius:1000px;
	background:rgba(0,0,0,0.8);
	font-family:Arial, Sans-Serif;
	font-size:20px;
	text-align:center;
	line-height:100%;
	color:#fff;
}

.popup-close:hover {
	-webkit-transform:translate(50%, -50%) rotate(180deg);
	transform:translate(50%, -50%) rotate(180deg);
	background:rgba(0,0,0,1);
	text-decoration:none;
}
    
</style>

    <div class="row justify-content-center">
           <div class="card">
        
            <div id="container">
							
							
							@if (session('status'))
							<div class="alert alert-success">
								 {{ session('status') }}
							 </div>
					 @endif
					 @if (session('message'))
								 <div class="alert alert-danger">
									{{ session('message') }}
								 </div>
					 @endif
							
             </div>
           </div>
        </div>
  
 

   
<script src="{{ asset('public/js/app.js') }}"></script> 
<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
<script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

<script>
$(document).ready( function () {
    
} );


function ajxProcess(cId, codeName){
 //alert(cId); 
   swal("You are about to edit system configuration for '"+codeName+"' !", "", "success");
   
          //form.submit(); // <--- submit form programmatically
            $("#configID").val(cId);
            var d = $("#tdDesc"+cId).text();
            var j = $("#tdJson"+cId).text();
            $("#config_desc").val(d);
            $("#config_json").text(j);

}

$("#ajxUpdate").click(function(){
   var idc = $("#configID").val();
    var desc= $("#config_desc").val();
    var jsonV = $("#config_json").val();
   
            formData= new FormData();
            formData.append("config_id", idc);
            formData.append("config_desc", desc);
            formData.append("config_json", jsonV);
            
             $.ajax({
              url: "{{ route('sysUpdate') }}",
              type: "POST",
              data: formData,
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
              processData: false,
              contentType: false,

              success: function(data){
                $("#tdDesc"+idc).text(desc);
                $("#tdJson"+idc).text(jsonV);
                $(".popup").hide(250);
                document.location = "{{ route('sysIndex') }}"
              }
            }); 
   
});

        //----- OPEN
	$('[data-popup-open]').on('click', function(e) {
		var targeted_popup_class = jQuery(this).attr('data-popup-open');
		$('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

		e.preventDefault();
	});

	//----- CLOSE
	$('[data-popup-close]').on('click', function(e) {
		var targeted_popup_class = jQuery(this).attr('data-popup-close');
		$('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

		e.preventDefault();
	});

</script>

@endsection