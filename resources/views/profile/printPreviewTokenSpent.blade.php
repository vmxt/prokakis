@extends('layouts.printPreview')


@section('content')

 <link href="{{ asset('public/css/purchaseHistory.css') }}" rel="stylesheet">
 <style type="text/css">
                                @media print and (width: 21cm) and (height: 29.7cm) {
                                     @page {
                                        margin: 3cm;
                                     }
                                }

                                /* style sheet for "letter" printing */
                                @media print and (width: 8.5in) and (height: 11in) {
                                    @page {
                                        margin: 1in;
                                    }
                                }

                                /* A4 Landscape*/
                                @page {
                                    size: A4 portrait;
                                    margin: 10%;
                                }

 </style>
 <?php 
 $invoiceNumber = $companyD->id.$companyD->user_id."-2";
 ?>
<div class="container" id="printSection">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <div class="row ">
                         <p class="h4">TOKEN SPENT HISTORY INFORMATION</p>
                    </div>
                    <div class="row ">
                         <img class='header-image' src="{{ asset('public/img-resources/ProKakisNewLogo.png') }}" width="35%">
                    </div>
                    <div class="row invoice ">
{{--                         <div class="col-md-9  ">
                            <img class='header-image' src="{{ asset('public/img-resources/ProKakisNewLogo.png') }}" width="35%">
                        </div> --}}

                        <div class="col-md-9  text-left ">
                            <p class="font-weight-bold mb-1">Invoice #{{ $invoiceNumber }}</p>
                            <p class="text-muted">Due to: </p>
                        </div>
                    </div>

                    <hr >

                    <div class="row   client-info">
                        <div class="col-md-12">
                            <p class="font-weight-bold mb-4"><strong>CLIENT INFORMATION</strong></p>
                            <p class="mb-1">{{ $userD->lastname }}, {{ $userD->firstname }}</p>
                            <p>{{ $userD->email }}</p>
                            <p>{{ $userD->phone }}</p>
                            <p><strong>{{ $companyD->company_name }}</strong></p>
                            <p><strong>{{ $companyD->company_website }}</strong></p>
                        </div>
{{-- 
                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-4">Payment Details</p>
                            <p class="mb-1"><span class="text-muted">VAT: </span> </p>
                            <p class="mb-1"><span class="text-muted">VAT ID: </span> </p>
                            <p class="mb-1"><span class="text-muted">Payment Type: </span> </p>
                            <p class="mb-1"><span class="text-muted">Name: </span> </p>
                        </div> --}}
                    </div>
                    <hr>
                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">ID</th>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Request ID</th>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Number of Tokens</th>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Date Created</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $grandTotal = 0;
                                    $discount = 0;
                                    ?>
                                    @foreach($rs_spent as $data)
                                    <tr>
                                        <?php $grandTotal += $data->amount ?>
                                        <td>{{ $data->id }}</td>
                                        <td>{{  $data->request_id }}</td>
                                        <td>{{ $data->num_tokens }}</td>
                                        <td><?php $dateFinal = date_format($data->created_at,"Y-m-d");
                                            echo date("F j, Y", strtotime($dateFinal));?>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

{{--                     <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Grand Total</div>
                            <div class="h3 font-weight-dark">${{ $grandTotal }}</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Discount</div>
                            <div class="h3 font-weight-light">{{ $discount }} %</div>
                        </div>

                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Sub - Total amount</div>
                            <div class="h3 font-weight-light">${{ $grandTotal - ($grandTotal * $discount) }}</div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

         $(document).ready(function() {
            window.print();
           // $("#print_button").hide();
          });



    </script>

@endsection
