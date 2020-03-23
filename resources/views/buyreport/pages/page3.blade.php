<div class="card">
    <div class="card-body p-0">
        <div class="row p-0">
            <div class="bg-orange">
                <p class="h2 text-header">{!! !empty($reportTemplates['HEADER_TXT_PG3']) ? strtoupper($reportTemplates['HEADER_TXT_PG3']) : 'Variable [HEADER_TXT_PG3] does not exist' !!} </p>
            </div>
        </div>
        <div>
            <p class="text-justify">
                <small>
                   {!! !empty($reportTemplates['CONTENT_TXT_PG3']) ? ucfirst($reportTemplates['CONTENT_TXT_PG3']) : 'Variable [CONTENT_TXT_PG3] does not exist' !!}
                </small>
            </p>
        </div>
        <div class="row p-5">
            &#160;
        </div>

        


    </div>
</div>
