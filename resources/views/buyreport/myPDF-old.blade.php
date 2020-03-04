@extends('layouts.appPdf')

@section('content')
<link href="{{ asset('public/mini-upload/assets/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">

<style>
    .niceDisplay{
        font-family: 'PT Sans Narrow', sans-serif;
        background-color: white;
        padding: 30px;
        border-radius: 3px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
	}

	iframe:focus {
		outline: none;
	  }

	  iframe[seamless] {
		display: block;
	  }
</style>


<div class="container">

    <div class="row">


        <div class="col-md-12">

                <div class="card">

					<div class="form-group">
                    	<div class="card-header"><b>Overview</b> <br /> </div>
					</div>

                    <div class="card-body center">

						<div class="form-group">
									<label for="company_description">Company Logo</label>
								  <div class="niceDisplay">

										<?php if( isset($profileAvatar) && $profileAvatar!=null ){  ?>
											<img src="{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>" />
											<?php } else { ?>
											<img src="{{ asset('public/images/robot.jpg') }}" />
											<?php } ?>
								   </div>

						 </div>


						<div class="form-group">
									<label for="company_description">Slogan and brandname</label>
								  <div class="niceDisplay">
										<span id="brandMessage"><b><?php if(isset($brand_slogan[0])) { echo substr($brand_slogan[0],0,60); } ?></b></span> <br />
										<span id="sloganMessage"><?php if(isset($brand_slogan[0])) { echo substr($brand_slogan[1],0,70); } ?></span>
								   </div>

                         </div>


                            <div class="form-group">
                              <label class="control-label">Company Name</label>
                              <div class="niceDisplay"> <?php if (isset($company_data->registered_company_name)) {
                                                   echo $company_data->registered_company_name;
                                               } ?>
                              </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Company Registration Number (UEN)</label>
                                <div class="niceDisplay"><?php if (isset($company_data->unique_entity_number)) {
                                        echo $company_data->unique_entity_number;
                                               } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Year Founded</label>
                                <div class="niceDisplay"><?php if (isset($company_data->year_founded)) {
                                                   echo $company_data->year_founded;
                                               } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Business Type</label>
                                <div class="niceDisplay"><?php if (isset($company_data->business_type)) {
                                                   echo $company_data->business_type;
                                               } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Industry</label>
                                <div class="niceDisplay"><?php if (isset($company_data->industry)) {
                                                   echo $company_data->industry;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                <label class="control-label">Description</label>
                                 <div class="niceDisplay"><?php if (isset($company_data->description)) {
                                                echo $company_data->description;
                                            } ?>
                               </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label">Office Address</label>
                                <div class="niceDisplay"><?php if (isset($company_data->registered_address)) {
                                                   echo $company_data->registered_address;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Office Phone</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->office_phone)) {
                                                   echo $company_data->office_phone;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Mobile Phone</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->mobile_phone)) {
                                                   echo $company_data->mobile_phone;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->company_email)) {
                                                   echo $company_data->company_email;
                                               } ?>
                            </div></div>


                            <div class="form-group">
                                        <label class="control-label">Website</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->company_website)) {
                                                   echo $company_data->company_website;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Facebook</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->facebook)) {
                                                   echo $company_data->facebook;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Twitter</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->twitter)) {
                                                   echo $company_data->twitter;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Linkedin</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->linkedin)) {
                                                   echo $company_data->linkedin;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Google Plus</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->googleplus)) {
                                                   echo $company_data->googleplus;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Other Link</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->otherlink)) {
                                                   echo $company_data->otherlink;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Financial Information
                                            Currency </label>
                                            <div class="niceDisplay"><?php if (isset($company_data->financial_year_end)) {
                                                   echo $company_data->financial_year_end;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label">Years of establishment </label>
                                        <div class="niceDisplay"><?php if (isset($company_data->years_establishment)) {
                                                   echo $company_data->years_establishment;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                        <label class="control-label"> Number of Staff</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->no_of_staff)) {
                                                   echo $company_data->no_of_staff;
                                               } ?>
                            </div></div>

                            <div class="form-group">
                                <label class="control-label">Gross Profit</label>
                                <div class="niceDisplay"><?php if (isset($company_data->gross_profit)) {
                                    echo $company_data->gross_profit;
                                } ?>
                            </div></div>

                            <div class="form-group">
                                <label class="control-label">Net Profit</label>
                                <div class="niceDisplay"><?php if (isset($company_data->net_profit)) {
                                    echo $company_data->net_profit;
                                } ?>
                            </div></div>

                            <div class="form-group">
                                <label class="control-label">Annual Tax filling rate</label>
                                <div class="niceDisplay"><?php if (isset($company_data->annual_tax_return)) {
                                    echo $company_data->annual_tax_return;
                                } ?>
                            </div></div>

                            <div class="form-group">
                                <label class="control-label">Corporate Tax filling rate</label>
                                <div class="niceDisplay"><?php if (isset($company_data->corporate_tax)) {
                                    echo $company_data->corporate_tax;
                                } ?></div></div>

                            <div class="form-group">
                                <label class="control-label">Asset more than Liability</label>
                                <div class="niceDisplay"><?php if (isset($company_data->asset_more_liability)) {
                                    echo $company_data->asset_more_liability;
                                } ?>
                            </div></div>

                            <div class="form-group">
                                <label class="control-label">Paid up capital</label>
                                <div class="niceDisplay"><?php if (isset($company_data->paid_up_capital)) {
                                    echo $company_data->paid_up_capital;
                                } ?>
                            </div></div>

                            <div class="form-group">
                                <label class="control-label">Financial Year End</label>
                                    <div class="niceDisplay"><?php if (isset($company_data->financial_year_end)) {
                                        echo $company_data->financial_year_end;
                                    } ?>
                            </div></div>


                            <div class="form-group">
                                    <label class="control-label">Key Personnel</label>
                                <div id="keyPersonnels">
                                    <?php

                                    $out = '';
                                    $kp = 0;
                                    if (count((array)$keyPersons) - 1 > 0) {
                                        foreach ($keyPersons as $data) {
                                            $kp++;
                                            $out = $out . '<table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%; padding-top: 5px;">
                                  <tr>
                                  <th width="40%"> ' . $kp . ' </th>
                                  <th> </th>
                                  </tr>
                              ';

                                            $out = $out . '<tr>
                                      <td> First Name   </td>
                                      <td> ' . $data->first_name . ' </td>
                                     </tr>';

                                            $out = $out . '<tr>
                                     <td> Last Name   </td>
                                     <td> ' . $data->last_name . ' </td>
                                    </tr>';

                                            $out = $out . '<tr>
                                    <td> Identification / Passport   </td>
                                    <td> ' . $data->idn_passport . ' </td>
                                   </tr>';

                                            $out = $out . '<tr>
                                   <td> Nationality   </td>
                                   <td> ' . $data->nationality . ' </td>
                                   </tr>';

                                            $out = $out . '<tr>
                                   <td> Gender   </td>
                                   <td> ' . $data->gender . ' </td>
                                   </tr>';

                                            $out = $out . '<tr>
                                   <td> Date of Birth   </td>
                                   <td> ' . $data->date_of_birth . ' </td>
                                   </tr>';

                                            $out = $out . '<tr>
                                   <td> Majority Shareholder   </td>
                                   <td> ' . $data->shareholder . ' </td>
                                   </tr>';

                                            $out = $out . '<tr>
                                   <td> Directorship   </td>
                                   <td> ' . $data->is_directorship . ' </td>
                                   </tr>';

                                            $out = $out . '<tr>
                                   <td> Position   </td>
                                   <td> ' . $data->position . ' </td>
                                     </tr>';
                                            $out = $out . '</table>';
                                        }

                                        echo $out;
                                    }
                                    ?>

                                </div>
                            </div>


                <div class="card">
                    <div class="card-header"><b>Financial Information</b> <br /> </div>

                        <div class="card-body center">

                                <div class="form-group">
                                        <label for="company_financial_year">For financial year/month</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->financial_year)) {
                                                echo $company_data->financial_year;
                                            } ?>  <?php if (isset($company_data->financial_month)) {
                                                echo $company_data->financial_month;
                                            } ?></div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="company_financial_currency">Currency</label> <br/>
                                        <div class="niceDisplay"><?php if (isset($company_data->currency)) {
                                                echo $company_data->currency;
                                            } ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_years_establishment">Years of establishment </label>
                                        <div class="niceDisplay"><?php if (isset($company_data->years_establishment)) {
                                                echo $company_data->years_establishment;
                                            } ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_number_employeee">Number of Staff</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->no_of_staff)) {
                                                echo $company_data->no_of_staff;
                                            } ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_gross_profit">Gross Profit</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->gross_profit)) {
                                                echo $company_data->gross_profit;
                                            } ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_gross_profit">Net Profit</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->net_profit)) {
                                                echo $company_data->net_profit;
                                            } ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_annual_tax">Annual Tax filling rate </label>
                                        <div class="niceDisplay"><?php if (isset($company_data->annual_tax_return)) {
                                                echo $company_data->annual_tax_return;
                                            } ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_annual_tax">Corporate Tax filling rate </label>
                                        <div class="niceDisplay"><?php if (isset($company_data->corporate_tax)) {
                                                echo $company_data->corporate_tax;
                                            } ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_annual_tax">Asset more than Liability </label>
                                        <div class="niceDisplay"><?php if (isset($company_data->asset_more_liability)) {
                                                echo $company_data->asset_more_liability;
                                            } ?></div>
                                    </div>


                                    <div class="form-group">
                                        <label for="company_paid_capital">Paid up capital</label>
                                        <div class="niceDisplay"><?php if (isset($company_data->paid_up_capital)) {
                                                echo $company_data->paid_up_capital;
                                            } ?></div>

                                        <div class="niceDisplay"><?php if (isset($company_data->solvent_value)) {
                                                echo $company_data->solvent_value;
                                            } ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_annual_tax">Financial Year End </label>
                                        <div class="niceDisplay"><?php if (isset($company_data->financial_year_end)) {
                                                echo $company_data->financial_year_end;
                                            } ?></div>
                                    </div>

                <?php if( isset($profileAwards) && count((array)$profileAwards) - 1 > 0) { ?>
                <div class="form-group">
                                    <label for="awards"><b>Awards</b></label> <br />

                                    <div id="upload">
                                        <div class="alert alert-info" role="alert">Saved Awards</div>


                                           <?php foreach($profileAwards as $aw) {  ?>

												<img src="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" style='width:100%;' border="0" alt="Null" />

                                           <?php } ?>



                                    </div>
                </div>
                <?php } ?>

                <?php if(isset($profilePurchaseInvoice) && count((array)$profilePurchaseInvoice) - 1 > 0) { ?>
                <div class="form-group">
                                   <label for="awards"><b>Invioces</b></label> <br />

                                   <div id="upload1">

                                           <div class="alert alert-info" role="alert">Saved Purchase Invoice</div>

                                           <?php foreach($profilePurchaseInvoice as $aw) {  ?>
											<img src="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" style='width:100%;' border="0" alt="Null" />

                                           <?php } ?>

                                          <?php } ?>

                                   </div>

                                  <div id="upload2">
                                           <?php if( isset($profileSalesInvoice) && count((array)$profileSalesInvoice) - 1 > 0) { ?>
                                           <div class="alert alert-info" role="alert">Saved Sales Invoice</div>
                                           <?php foreach($profileSalesInvoice as $aw) {  ?>
											<img src="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" style='width:100%;' border="0" alt="Null" />

											<?php } ?>
                                  </div>
                </div>
                <?php } ?>

                <?php if( isset($profileCertifications) && count((array)$profileCertifications) - 1 > 0) { ?>
                <div class="form-group">
                             <label for="awards"><b>Certifications</b></label> <br />

                                 <div id="upload3">

                                           <div class="alert alert-info" role="alert">Saved Certificates</b></div>
                                           <?php foreach($profileCertifications as $aw) {  ?>
											<img src="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" style='width:100%;' border="0" alt="Null" />

											<?php } ?>

                                  </div>
                </div>
                <?php } ?>


                        </div>

                    </div>

                </div>


        </div>

    </div>




@endsection
