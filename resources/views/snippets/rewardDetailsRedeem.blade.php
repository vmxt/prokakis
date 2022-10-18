                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Earned Amount</th>
                                <th>Earned Point</th>
                                <th>Last Update</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    
                        <tbody>
                        <?php
                        $counter = 1;
                        if(count((array)$advisorDetails) > 0){
                            foreach($advisorDetails as $b){  ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><p> <?php echo $b->earned_amount; ?></p></td>
                            <td><p> <?php echo $b->earned_points; ?></p></td>
                            <td><p> <?php echo $b->updated_at; ?></p></td>
                            <td><p>
                                @if($b->status == 0)
                                    Pending
                                @elseif($b->status == 1)
                                    Approved
                                @else
                                    Rejected
                                @endif

                        </tr>

                        <?php
                        $counter++;
                            }

                        } ?>

                        </tbody>