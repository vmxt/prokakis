@extends('layouts.mainDatatable')


@section('breadcrumbs')
<div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{ route('home') }}">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Influencers</span>
                            </li>
                        </ul>

                    </div>
@endsection

@section('content')

<h2>Influencers</h2>


<div class="container">

    <div class="row justify-content-center">

                <div class="tabbable tabbable-tabdrop">

                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab11" data-toggle="tab">Facebook</a>
                                            </li>
                                            <li>
                                                <a href="#tab12" data-toggle="tab">Twitter</a>
                                            </li>
                                            <li>
                                                <a href="#tab13" data-toggle="tab">Web</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">

                                            <div class="tab-pane active" id="tab11">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" cellspacing="0" width="70%">
                                                    <thead>
                                                                            <tr>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if(!empty($data)){
                                                     foreach($data as $d){
                                                        if($d['Tab'] == 'Facebook')
                                                        {
                                                      ?>

                                                        <tr>
                                                        <td>
                                                        <div style="float:left;margin:1em;min-width:48px;min-height:48px;">
                                                            <a target="_blank" href="<?php echo $d['Url']; ?>"><img src="https://www.google.com/s2/favicons?domain=www.facebook.com" alt=""/>
                                                                <br />
                                                                Open Link
                                                            </a>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div style="float:left;margin:1ex 1em;">
                                                          <span style=""><i class="icon-book-open">&nbsp;</i><?php echo $d['NumLikes']; ?></span>
                                                          <br><span style="font-size:0.9em;color:#76838f;">INFLUENCE</span>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div style="float:left;margin:1ex 1em;">
                                                          <span style=""><i class="icon-equalizer">&nbsp;</i><?php echo$d['NumReach']; ?></span>
                                                          <br><span style="font-size:0.9em;color:#76838f;">REACH (EST.)</span>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div style="float:left;margin:1ex 1em;cursor:pointer;" onclick="jQuery(this).closest('td').find('div.men-container').toggle();">
                                                          <span style=""><i class="icon-check">&nbsp;</i><?php echo $d['NumRecords']; ?></span>
                                                          <br><span style="font-size:0.9em;color:#76838f;">MENTIONS : <?php echo $d['MentionWord']; ?></span>
                                                        </div>
                                                        </td>
                                                        </tr>


                                                    <?php
                                                         }
                                                       }
                                                     }
                                                     ?>
                                                    </tbody>
                                                    </table>
                                            </div>

                                            <div class="tab-pane" id="tab12">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_4" cellspacing="0" width="70%">
                                                    <thead>
                                                                            <tr>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                <?php
                                                if(!empty($data)){
                                                 foreach($data as $d){
                                                    if($d['Tab'] == 'Twitter')
                                                    {
                                                  ?>

                                                    <tr>
                                                    <td>
                                                    <div style="float:left;margin:1em;min-width:48px;min-height:48px;">
                                                    <a target="_blank" href="<?php echo $d['Url']; ?>"><img src="https://www.google.com/s2/favicons?domain=www.twitter.com" alt="" />
                                                        <br />
                                                        Open Link
                                                    </a>
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style="float:left;margin:1ex 1em;">
                                                      <span style=""><i class="icon-book-open">&nbsp;</i><?php echo $d['NumLikes']; ?></span>
                                                      <br><span style="font-size:0.9em;color:#76838f;">INFLUENCE</span>
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style="float:left;margin:1ex 1em;">
                                                      <span style=""><i class="icon-equalizer">&nbsp;</i><?php echo $d['NumReach']; ?></span>
                                                      <br><span style="font-size:0.9em;color:#76838f;">REACH (EST.)</span>
                                                    </div>
                                                    </td>

                                                    <td>
                                                    <div style="float:left;margin:1ex 1em;cursor:pointer;" onclick="jQuery(this).closest('td').find('div.men-container').toggle();">
                                                      <span style=""><i class="icon-check">&nbsp;</i><?php echo $d['NumRecords']; ?></span>
                                                      <br><span style="font-size:0.9em;color:#76838f;">MENTIONS : <?php echo $d['MentionWord']; ?></span>
                                                    </div>
                                                    </td>
                                                    </tr>

                                                <?php
                                                     }
                                                   }
                                                 }
                                                 ?>
                                                </tbody>
                                                </table>
                                            </div>

                                            <div class="tab-pane" id="tab13">
                                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3" cellspacing="0" width="70%">
                                                    <thead>
                                                                            <tr>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                                <th>
                                                                                </th>
                                                                            </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if(!empty($data)){
                                                     foreach($data as $d){
                                                        if($d['Tab'] == 'Web')
                                                        {
                                                      ?>

                                                      <tr><td>
                                                        <div style="float:left;margin:1em;min-width:48px;min-height:48px;">
                                                            <a target="_blank" href="<?php echo $d['Url']; ?>"><img src="https://www.google.com/s2/favicons?domain=business.facebook.com" alt="" />
                                                            <br />
                                                           Open Link
                                                            </a>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div style="float:left;margin:1ex 1em;">
                                                          <span style=""><i class="icon-book-open">&nbsp;</i><?php echo $d['NumLikes']; ?></span>
                                                          <br><span style="font-size:0.9em;color:#76838f;">INFLUENCE</span>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div style="float:left;margin:1ex 1em;">
                                                          <span style=""><i class="icon-equalizer">&nbsp;</i><?php echo $d['NumReach']; ?></span>
                                                          <br><span style="font-size:0.9em;color:#76838f;">REACH (EST.)</span>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        <div style="float:left;margin:1ex 1em;cursor:pointer;" onclick="jQuery(this).closest('td').find('div.men-container').toggle();">
                                                          <span style=""><i class="icon-check">&nbsp;</i><?php echo $d['NumRecords']; ?></span>
                                                          <br><span style="font-size:0.9em;color:#76838f;">MENTIONS : <?php echo $d['MentionWord']; ?></span>
                                                        </div>
                                                        </td></tr>

                                                    <?php
                                                         }
                                                       }
                                                     }
                                                     ?>
                                                    </tbody>
                                                    </table>
                                            </div>


                                        </div>


                </div>
    </div>
</div>

@endsection
