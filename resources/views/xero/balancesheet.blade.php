@extends('layouts.app')

@section('content')
    
    <style>
        .amount_css{
        text-align:right !important;
    }
    
    .text-center{
        text-align:center !important;
    }
    
    .mb-2{
        margin-bottom:15px;
    }
    .card{
        border:1px solid silver;
        border-radius:5px;
    }  
    .card-body{
        padding:20px;
    }  
    </style> 

<script src="https://cdn.tiny.cloud/1/slw9lhdv4c3fx4qi60rcwkfkpr4dwlfj265xiqescxzq8y76/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>


    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <h3 style="margin:0px !important"><i class="fa fa-file"></i> <b>BALANCE SHEET</b></h3>
                            </div>
                            <div class="col-md-6 mb-2">
                                <button type="button" class="btn btn-primary pull-right" id="balance_sheet_save_btn" ><i class="fa fa-save"></i> SAVE IN INTELLINZ</button>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>Title:</label>
                                <input value="{{ $title }}" type="text" placeholder="........" id="balance_sheet_title_txt"  class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>Description:</label>
                                <input value="{{ $description }}" type="text" placeholder="........" id="balance_sheet_description_txt"  class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                
                <textarea id="mytextarea" name='agreement_txt' class="form-control">
                    <?php 
                        $table_data = "";
                        if(isset($id) && $id != ""){
                            $table_data = $arr;
                        }
                        else
                        {
                            foreach ($arr as $value)
                            {
                                $table_data .= "<table style='width:100%'>";
                                $fontsize = 24;
                                
                                foreach ($value[0]["ReportTitles"] as $title_value)
                                {
                                    $table_data .= '<tr style="padding:0px !important; margin:0px !important">';
                                    $table_data .= '<td style="text-align:center;width:100%; font-size:'.$fontsize.'px !important; border:none; padding:0px !important; margin:0px !important" >'.$title_value.'</td>';  
                                    $table_data .= '</tr>';
                                    $fontsize -= 4;
                                }
                                $table_data .= "</table>";
                                
                                if (count($value[0]["Rows"]) > 0)
                                {
                                    $table_data .= "<table style='width:100%'>";
                                    
                                    foreach ($value[0]["Rows"] as $main_value)
                                    {
                                        if ($main_value["RowType"] == "Header")
                                        {
                                            $table_data .= '<tr>';
                                            $cc = 0;
                                            foreach ($main_value["Cells"] as $cells)
                                            {
                                                $align_right = "";
                                                if ($cc > 0)
                                                {
                                                    $align_right = "text-align:right";
                                                }
                                                $cc++;
                                                $table_data .= '<td style="' . $align_right . '"><b>' . $cells["Value"] . '</b></td>';
                                                
                                                if($periods == "" && $cc >= 2){
                                                    break;
                                                }
                                            }
                                            $table_data .= '</tr>';
                                        }
        
                                        if ($main_value["RowType"] == "Section")
                                        {
                                            $table_data .= '<tr>';
                                            
                                            $padd_right = "";
                                            if((isset($main_value["Title"]) ? $main_value["Title"] : "") != "Assets" &&
                                                (isset($main_value["Title"]) ? $main_value["Title"] : "") != "Liabilities" &&
                                                (isset($main_value["Title"]) ? $main_value["Title"] : "") != "Equity"){
                                                $padd_right = "padding-left:20px;";
                                            }
                                            
                                            $table_data .= '<td style="'.$padd_right.'" colspan="5"><b>' . (isset($main_value["Title"]) ? $main_value["Title"] : "") . '</b></td>';
                                            $table_data .= '</tr>';
        
                                            foreach ($main_value["Rows"] as $main_row)
                                            {
                                                if ($main_row["RowType"] == "Row")
                                                {
                                                    $table_data .= '<tr>';
                                                    $cc = 0;
                                                    foreach ($main_row["Cells"] as $main_cells)
                                                    {
                                                        $align_right = "";
                                                        $value = $main_cells["Value"];
                                                        if ($cc > 0)
                                                        {
                                                            $align_right = "text-align:right";
                                                            if ($main_cells["Value"] != "")
                                                            {
                                                                $value = number_format($main_cells["Value"] , 2);
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $acc_id = "";
                                                            if (isset($main_cells["Attributes"]))
                                                            {
                                                                foreach ($main_cells["Attributes"] as $value)
                                                                {
                                                                    $acc_id = $value["Value"];
                                                                }
                                                            }
                                                            $value = $main_cells["Value"];
                                                        }
                                                        $cc++;
                                                        $table_data .= '<td style="padding-left:40px;' . $align_right . '">' . $value . '</td>';
                                                        
                                                        if($periods == "" && $cc >= 2){
                                                            break;
                                                        }
                                                    }
                                                    $table_data .= '</tr>';
                                                }
        
                                                if ($main_row["RowType"] == "SummaryRow")
                                                {
                                                    $table_data .= '<tr>';
                                                    $cc = 0;
                                                    foreach ($main_row["Cells"] as $main_cells)
                                                    {
                                                        $align_right = "";
                                                        $value = $main_cells["Value"];
                                                        if ($cc > 0)
                                                        {
                                                            $align_right = "text-align:right";
                                                            if ($main_cells["Value"] != "")
                                                            {
                                                                $value = number_format($main_cells["Value"] , 2);
                                                            }
                                                        }
                                                        $cc++;
                                                        
                                                        $padd = "";
                                                        if($value != "Total Assets" && $value != "Total Liabilities" && $value != "Total Equity"){
                                                            $padd = "padding-left:20px;";
                                                        }
                                                        $table_data .= '<td style="' . $padd . $align_right . '"><b>' . $value . '</b></td>';
                                                        
                                                        if($periods == "" && $cc >= 2){
                                                            break;
                                                        }
                                                    }
                                                    $table_data .= '</tr>';
                                                }
                                            }
                                        }
                                    }
                                $table_data .= "</table>";
                                }
        
                            }
                        
                        }
                        
                        echo $table_data;
                    ?>
                </textarea>   
            </div>
        </div>
         
    </div>

    
    <script>
        $(document).ready(function () {
            /*tinymce.init({
                selector: '#mytextarea',
                plugins: 'autoresize print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                  imagetools_cors_hosts: ['picsum.photos'],
                  menubar: 'file edit view insert format tools table help',
                  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                  toolbar_sticky: true,
                  autosave_ask_before_unload: true,
                  autosave_interval: '30s',
                  autosave_prefix: '{path}{query}-{id}-',
                  autosave_restore_when_empty: false,
                  autosave_retention: '2m',
                  image_advtab: true,
                autoresize_on_init: true,
                relative_urls : false,
                remove_script_host: true,
                toolbar: 'undo redo | formatpainter casechange styleselect | bold italic backcolor | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help',
                
            });*/
            
            var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

            tinymce.init({
                autoresize_on_init: true,
              selector: 'textarea#mytextarea',
              plugins: [ 'autoresize', 'print', 'preview', 'paste', 'importcss', 'searchreplace', 'autolink', 'autosave', 'save', 'directionality', 'code', 'visualblocks', 'visualchars', 'fullscreen', 'image', 'link', 'media', 'template', 'codesample', 'table', 'charmap', 'hr', 'pagebreak', 'nonbreaking', 'anchor', 'toc', 'insertdatetime', 'advlist', 'lists', 'wordcount', 'imagetools', 'textpattern', 'noneditable', 'help', 'charmap', 'quickbars', 'emoticons'],
              imagetools_cors_hosts: ['picsum.photos'],
              menubar: 'file edit view insert format tools table help',
              toolbar: 'export undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
              toolbar_sticky: true,
              autosave_ask_before_unload: true,
              autosave_interval: '30s',
              autosave_prefix: '{path}{query}-{id}-',
              autosave_restore_when_empty: false,
              autosave_retention: '2m',
              image_advtab: true,
              importcss_append: true,
              templates: [
                    { title: 'New Table', description: 'creates a new table', content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>' },
                { title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...' },
                { title: 'New list with dates', description: 'New List with dates', content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>' }
              ],
              template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
              template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
              height: 600,
              image_caption: true,
              quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
              noneditable_noneditable_class: 'mceNonEditable',
              toolbar_mode: 'sliding',
              contextmenu: 'link image imagetools table',
              skin: useDarkMode ? 'oxide-dark' : 'oxide',
              content_css: useDarkMode ? 'dark' : 'default',
              content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
             });
        });

    $("#balance_sheet_save_btn").click(function(){
            var balance_sheet_date = "{{ $date }}";
            var balance_sheet_period_no = "{{ $period }}";
            var balance_sheet_period_type = "{{ $timeframe }}";
            
            var title = $("#balance_sheet_title_txt").val();
            var description = $("#balance_sheet_description_txt").val();
            
            var content = tinymce.activeEditor.getContent();
            
            if(title == "" || description == ""){
                alert("Please provide title and description for this Balance Sheet");
            }
            else{
                
                formData = new FormData();
                formData.append("date", balance_sheet_date);
                formData.append("period", balance_sheet_period_no);
                formData.append("ptype", balance_sheet_period_type);
                formData.append("title", title);
                formData.append("description", description);
                formData.append("id", "{{ $id }}");
                formData.append("editor_content", content);
                
                $(".loading").show();
                $.ajax({
                    url: "{{ route('saveBalanceSheet') }}",
                    type: "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.error == true){
                            alert("Failed to save");
                        }
                        else{
                            alert("Success");
                            if("{{ $id }}" == ""){
                                window.location = "{{ env('APP_URL') }}company/goXeroAnalytics";
                            }
                        }
                        $(".loading").hide();
                    },
                     error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                    }
                });
            }
        });
      
    </script>
@endsection
