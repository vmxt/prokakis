@extends('layouts.printPreview')


@section('content')

    <div class="col-md-8" style="margin-top:25px;">
       <!-- <button id="print_button" class="btn btn-primary">Print Now</button> -->
        <table id="system_data" class="table table-bordered table-striped table-condensed flip-content" style="width: 100%; padding-top: 25px;">
            <thead>
            <tr>
                <th>Id</th>
                <th>Payment</th>
                <th>Amount</th>
                <th>Date Created</th>

            </tr>
            </thead>
            <tbody>
            <?php
            if(count((array)$rs_buy) - 1 > 0){
            foreach($rs_buy as $data){ ?>
            <tr>
                <td><?php echo $data->id; ?></td>
                <td><?php echo 'Token Purchased: '. $data->num_tokens; ?></td>
                <td><?php echo $data->amount; ?> </td>
                <td>
                <?php
                    $dateFinal = date_format($data->created_at,"Y-m-d");
                    echo date("F j, Y", strtotime($dateFinal));
                ?>
                </td>

            </tr>
            <?php }
            } else { ?>
            <tr>
                <td colspan="4">You have no purchased record.</td>
            </tr>
            <?php

            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Payment</th>
                <th>Details</th>
                <th>Date Created</th>
            </tr>
            </tfoot>
        </table>
    </div>

    <script type="text/javascript">

         $(document).ready(function() {
            window.print();
           // $("#print_button").hide();
          });



    </script>

@endsection
