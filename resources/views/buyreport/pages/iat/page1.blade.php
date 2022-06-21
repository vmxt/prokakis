        <div id="watermark">
            <em>Intellinz</em>
        </div>
<div class="card">
    <div class="card-body ">
    
        <div class="row p-2">
            &#160;
        </div>

        <div class="row p-0">
            <div class="col-md-12 text-center">
                This report prepared by Intellinz for Inquiry on:
            </div>
        </div>

        <div class="row p-1">
            <div class="col-md-12 text-center">
                <p  class="h1 heading1">{{ $data['COMP_NAME'] }}</p>
                <small class="h6">REGISTRATION NUMBER: {{ $data['COMP_REGISTRATION_NUMBER'] }}</small>
            </div>
        </div>

        <div class="row p-1">
            <hr class="report-line">
        </div>

        <div class="row p-3">
            <div class="gray-box">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <b class="h4">Investors Alert</b>
                    </div>
                </div>
              
            </div>
        </div>
        <div class="row p-5">
            &#160;
        </div>
        <div class="row p-5">
            &#160;
        </div>
        <div class="row p-5">
            &#160;
        </div>

        <div class="row p-2">
            &#160;
        </div>

        <div class="row p-1">
            <div class="col-md-12 text-right">
                PRESENTED BY: <b>Intellinz</b>
                <br>
                GENERATED ON: <b><?php echo date('Y-m-d'); ?></b>
            </div>
        </div>
        {{--         <div class="row p-5 page-break">
            <div class="col-md-12">
                @include('buyreport.disclaimer')
            </div>
        </div> --}}
    </div>
</div>
<div style = "display:block; clear:both; page-break-after:always;"></div>