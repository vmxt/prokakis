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
                        <u class="h4">TABLE OF CONTENTS</u>
                    </div>
                </div>
                <ul style="list-style-type: none; margin-top:20px; font-weight: bolder;">
                    <li style="font-size: 14px; line-height: 2 !important">Company Overview</li>
                    <li  style="font-size: 14px; line-height: 2 !important">Key Management</li>
                    <li style="font-size: 14px; line-height: 2 !important">Company Information</li>
                    <li  style="font-size: 14px; line-height: 2 !important">Financial Analysis</li>
                    <li  style="font-size: 14px; line-height: 2 !important">AML - World check risk intelligence by Refinitive </li>
                    <li  style="font-size: 14px; line-height: 2 !important">Investors Alert</li>
                    <li style="font-size: 14px; line-height: 2 !important">Adverse Media </li>
                    <li style="font-size: 14px; line-height: 2 !important">Appendix </li>
                </ul>
            </div>
        </div>
        <div class="row p-5">
            &#160;
        </div>
        <div class="row p-5">
            &#160;
        </div>
  
        <div class="row p-0">
             <div class="col-md-12" style="text-align: center; line-height: 0">
                <span>All Rights Reserved &#169; <?php echo date("Y");?> </span><br>
                <span>Intellinz PTE LTD</span>
            </div>
        </div>

        <div class="row p-2">
            &#160;
        </div>

        <div class="row p-1">
            <div class="col-md-12 text-right">
                PRESENTED BY: Intellinz
                <br>
                GENERATED ON: <?php echo date('Y-m-d'); ?>
            </div>
        </div>
        {{--         <div class="row p-5 page-break">
            <div class="col-md-12">
                @include('buyreport.disclaimer')
            </div>
        </div> --}}
    </div>
</div>