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
 $invoiceNumber = date('YmdHis'); //$companyD->id.$companyD->user_id."-2";
 ?>
<div class="container" id="printSection">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <div class="row ">
                         <p class="h4">Request Redemption of Proakakis Rewards</p>
                    </div>
                    <div class="row ">
                         <img class='header-image' src="{{ asset('public/img-resources/ProKakisNewLogo.png') }}" width="35%">
                    </div>
                    <div class="row invoice ">


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
                      
                        </div>

                        <div class="col-md-12">
                            <table class="table">

                                <thead> 
                                    <tr>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Company Name</th>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Website</th>
                                    </tr>   
                                </thead>    
                                    
                                <tbody>
                                @if(isset($companyD))
                                    @foreach($companyD as $company) 
                                    <tr>     
                                    <td><strong>{{ $company->company_name }}</strong></td>
                                    <td><strong>{{ $company->company_website }}</strong></td>
                                    </tr>
                                    @endforeach
                                @endif   
                                
                                </tbody>
                            </table>
                                
                        </div>

                    </div>
                    <hr>
                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">#</th>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Transaction Type</th>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Total Value</th>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Points Earned</th>
                                        <th class="border-0 text-uppercase text-center small font-weight-bold">Request Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                   
                                    @if(isset($arrCredit))
                                        <tr>
                                            <td><?php echo $counter++; ?></td>
                                            <td> Credits </td>
                                            <td>{{  $arrCredit[0] }}</td>
                                            <td>{{  $arrCredit[1] }}</td>
                                            <td><?php $dateFinal = date_format($arrCredit[2],"Y-m-d");
                                                echo date("F j, Y", strtotime($dateFinal));?>
                                            </td>
                                        </tr>
                                    @endif

                                    @if(isset($arrReferrals))
                                    <tr>
                                        <td><?php echo $counter++; ?></td>
                                        <td>Referrals </td>
                                        <td>{{  $arrReferrals[0] }}</td>
                                        <td>{{  $arrReferrals[1] }}</td>
                                        <td><?php $dateFinal = date_format($arrReferrals[2],"Y-m-d");
                                            echo date("F j, Y", strtotime($dateFinal));?>
                                        </td>
                                    </tr>
                                @endif

                                @if(isset($arrRefCreditPoints))
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td> Referral Credits </td>
                                    <td>{{  $arrRefCreditPoints[0] }}</td>
                                    <td>{{  $arrRefCreditPoints[1] }}</td>
                                    <td><?php $dateFinal = date_format($arrRefCreditPoints[2],"Y-m-d");
                                        echo date("F j, Y", strtotime($dateFinal));?>
                                    </td>
                                </tr>
                                @endif

                            @if(isset($arrNumRefReport))
                            <tr>
                                <td><?php echo $counter++; ?></td>
                                <td> Referral Request Report </td>
                                <td>{{  $arrNumRefReport[0] }}</td>
                                <td>{{  $arrNumRefReport[1] }}</td>
                                <td><?php $dateFinal = date_format($arrNumRefReport[2],"Y-m-d");
                                    echo date("F j, Y", strtotime($dateFinal));?>
                                </td>
                            </tr>
                        @endif
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-right">
                            <div class="mb-2">Total Points </div>
                            <div class="h3 font-weight-dark">{{ $grandTotal }}</div>
                        </div>
                    </div> 


                    <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                        <div class="py-3 px-5 text-left">

                            - 50 Points = Advisor Level Worth USD$100 <br />
                            - 150 Points = Gold Advisor Worth USD$375 <br />
                            - 500 Points = Platinum Advisor Worth USD$1750 <br />
                            - ONLY ADVISORS LEVEL CAN REDEEM POINTS <br />
                         
                        </div>
                    </div> 

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

         $(document).ready(function() {
            window.print();
          });
   </script>

@endsection
