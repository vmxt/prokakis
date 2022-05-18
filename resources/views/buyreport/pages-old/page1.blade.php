<div class="card">
    <div class="card-body p-5">
        <div class="row p-5">
            &#160;
        </div>
        <div class="row p-5">
            &#160;
        </div>
        <div class="row p-5">
            <div class="col-md-12 text-center">
                <img src="{{ asset('public/img-resources/intellinz_green.png') }}" width="90%">
            </div>
        </div>
        
        <div class="row p-5">
            <div class="col-md-12 text-right">
                <p  class="h4">{{ $data['COMP_NAME'] }}</p>
                <small class="h6">REGISTRATION NUMBER: {{ $data['COMP_REGISTRATION_NUMBER'] }}</small>
            </div>
        </div>
        {{-- <div class="row p-5">
            &#160;
        </div> --}}
        <div class="row p-3">
            <div class="col-md-12 text-right">
                <p  class="h5">PRESENTED BY: Intellinz</p>
                <small class="h6">GENERATED ON: <?php echo date('Y-m-d'); ?></small>
            </div>
        </div>
        {{--         <div class="row p-5 page-break">
            <div class="col-md-12">
                @include('buyreport.disclaimer')
            </div>
        </div> --}}
    </div>
</div>