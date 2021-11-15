<div class="card">

  <div class="card-body p-0">

    <div class="row p-0">

      <div class="bg-orange">
        <!--  Investors Alert MAS -->
        <p class="h2 text-header">
    
        </p>

      </div>

    </div>

    <div>

      <p class="text-justify">

        <small class="text-muted">
          We matched the company information of the report provider. 
        </small>

      </p>

    </div>

    <?php if(!empty($MASinvestors)){  ?>
      <center><h5 color="green"><i> MAS Investors Alert Likely Match  </i></h5></center>
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
                  <td><?php echo $d['unregulatedpersons_t'][0]; ?></td>
                </tr>
                <tr>
                  <td><b> Website </b></td>
                  <td><?php echo $d['website_s']; ?></td>
                </tr>
                <tr>
                  <td> <b>Phone </b></td>
                  <td><?php echo $d['phonenumber_s']; ?></td>
                </tr>
                <tr>
                  <td> <b>Address </b></td>
                  <td><?php echo $d['address_s']; ?></td>
                </tr>
              
              </tbody>
            </table>
        <br />

        <?php } ?>
    </div>
    <?php }  else { ?>
      <center><h5 color="red"><i> No matching records on MAS </i></h5></center>
    <?php }  ?>



    <?php if(!empty($Panama)){  ?>
      <center><h5 color="green"><i> Panama Likely Match  </i></h5></center>
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
      <?php }  else { ?>
        <center><h5 color="red"><i> No matching records on Panama </i></h5></center>
      <?php }  ?>

        <?php if(!empty($Paradise)){  ?>
          <center><h5 color="green"><i> Paradise Likely Match  </i></h5></center>
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
          <?php }   else { ?>
            <center><h5 color="red"><i> No matching records on Paradise </i></h5></center>
          <?php }  ?>

          <?php if(!empty($Offshore)){  ?>
            <center><h5 color="green"><i> Offshore Likely Match  </i></h5></center>
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
            <?php }  else { ?>
              <center><h5 color="red"><i> No matching records on Offshore </i></h5></center>
            <?php }  ?>

            <?php if(!empty($Bahamas)){  ?>
              <center><h5 color="green"><i> Bahamas Likely Match  </i></h5></center>
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
              <?php } else { ?>
                <center><h5 color="red"><i> No matching records on Bahamas </i></h5></center>
              <?php }  ?>



     <div class=" p-3">

     </div>


  </div>

</div>