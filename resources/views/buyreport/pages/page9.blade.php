<div class="card">

  <div class="card-body p-0">

    <div class="row p-0">

      <div class="bg-orange">
        <!--  Investors Alert MAS -->
        <p class="h2 text-header">{!! !empty($reportTemplates['HEADER_TXT_PG10']) ? strtoupper($reportTemplates['HEADER_TXT_PG10']) : 'Variable [HEADER_TXT_PG10] does not exist' !!}</p>

      </div>

    </div>

    <div>

      <p class="text-justify">

        <small class="text-muted">

         {!! !empty($reportTemplates['SUBHEADER_TXT_PG10']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG10']) : 'Variable [SUBHEADER_TXT_PG10] does not exist' !!}

        </small>

      </p>

    </div>

    <?php if(is_iterable($MASinvestors)){  ?>
    <div class=" p-3">
        <?php foreach($MASinvestors as $d){ ?>
            <table class="table table-sm table-bordered" >
              <thead>
                <tr>
                  <th>Attribute</th>
                  <th>Result</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td> <b>Company Name</b> </td>
                  <td><?php echo $d->unregulatedpersons_t[0]; ?></td>
                </tr>
                <tr>
                  <td><b> Website </b></td>
                  <td><?php echo $d->website_s; ?></td>
                </tr>
                <tr>
                  <td> <b>Phone </b></td>
                  <td><?php echo $d->phonenumber_s; ?></td>
                </tr>
                <tr>
                  <td> <b>Address </b></td>
                  <td><?php echo $d->address_s; ?></td>
                </tr>
              
              </tbody>
            </table>
        <br />

        <?php } ?>
    </div>
    <?php }  ?>



    <?php if(is_iterable($Panama)){  ?>
      <div class=" p-3">
          <?php foreach($Panama as $d){ ?>
              <table class="table table-sm table-bordered" >
                <thead>
                  <tr>
                    <th>Attribute</th>
                    <th>Result</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><b>Company Name</b> </td>
                    <td><?php echo $d[1]; ?></td>
                  </tr>
                  <tr>
                    <td><b> Country </b></td>
                    <td><?php echo $d[5] ?></td>
                  </tr>
                  <tr>
                    <td> <b>Incorporation Date </b></td>
                    <td><?php echo $d[6]; ?></td>
                  </tr>
                  <tr>
                    <td> <b>Jurisdiction </b></td>
                    <td><?php echo $d[3] ?></td>
                  </tr>
                
                </tbody>
              </table>
          <br />
  
          <?php } ?>
      </div>
      <?php }  ?>


      <?php if(is_iterable($Paradise)){  ?>
        <div class=" p-3">
            <?php foreach($Paradise as $d){ ?>
                <table class="table table-sm table-bordered" >
                  <thead>
                    <tr>
                      <th>Attribute</th>
                      <th>Result</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><b>Company Name</b> </td>
                      <td><?php echo $d[1]; ?></td>
                    </tr>
                    <tr>
                      <td><b> Country </b></td>
                      <td><?php echo $d[5] ?></td>
                    </tr>
                    <tr>
                      <td> <b>Incorporation Date </b></td>
                      <td><?php echo $d[6]; ?></td>
                    </tr>
                    <tr>
                      <td> <b>Jurisdiction </b></td>
                      <td><?php echo $d[3] ?></td>
                    </tr>
                  
                  </tbody>
                </table>
            <br />
    
            <?php } ?>
        </div>
        <?php }  ?>

        <?php if(is_iterable($Paradise)){  ?>
          <div class=" p-3">
              <?php foreach($Paradise as $d){ ?>
                  <table class="table table-sm table-bordered" >
                    <thead>
                      <tr>
                        <th>Attribute</th>
                        <th>Result</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><b>Company Name</b> </td>
                        <td><?php echo $d[1]; ?></td>
                      </tr>
                      <tr>
                        <td><b> Country </b></td>
                        <td><?php echo $d[5] ?></td>
                      </tr>
                      <tr>
                        <td> <b>Incorporation Date </b></td>
                        <td><?php echo $d[6]; ?></td>
                      </tr>
                      <tr>
                        <td> <b>Jurisdiction </b></td>
                        <td><?php echo $d[3] ?></td>
                      </tr>
                    
                    </tbody>
                  </table>
              <br />
      
              <?php } ?>
          </div>
          <?php }  ?>


          <?php if(is_iterable($Offshore)){  ?>
            <div class=" p-3">
                <?php foreach($Offshore as $d){ ?>
                    <table class="table table-sm table-bordered" >
                      <thead>
                        <tr>
                          <th>Attribute</th>
                          <th>Result</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><b>Company Name</b> </td>
                          <td><?php echo $d[1]; ?></td>
                        </tr>
                        <tr>
                          <td><b> Country </b></td>
                          <td><?php echo $d[5] ?></td>
                        </tr>
                        <tr>
                          <td> <b>Incorporation Date </b></td>
                          <td><?php echo $d[6]; ?></td>
                        </tr>
                        <tr>
                          <td> <b>Jurisdiction </b></td>
                          <td><?php echo $d[3] ?></td>
                        </tr>
                      
                      </tbody>
                    </table>
                <br />
        
                <?php } ?>
            </div>
            <?php }  ?>

            <?php if(is_iterable($Bahamas)){  ?>
              <div class=" p-3">
                  <?php foreach($Bahamas as $d){ ?>
                      <table class="table table-sm table-bordered" >
                        <thead>
                          <tr>
                            <th>Attribute</th>
                            <th>Result</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><b>Company Name</b> </td>
                            <td><?php echo $d[1]; ?></td>
                          </tr>
                          <tr>
                            <td><b> Country </b></td>
                            <td><?php echo $d[5] ?></td>
                          </tr>
                          <tr>
                            <td> <b>Incorporation Date </b></td>
                            <td><?php echo $d[6]; ?></td>
                          </tr>
                          <tr>
                            <td> <b>Jurisdiction </b></td>
                            <td><?php echo $d[3] ?></td>
                          </tr>
                        
                        </tbody>
                      </table>
                  <br />
          
                  <?php } ?>
              </div>
              <?php }  ?>



     <div class=" p-3">
   
      <p>The information obtain from <?php echo date("F j, Y"); ?>.</p>

     </div>


  </div>

</div>