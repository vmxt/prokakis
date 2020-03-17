@extends('layouts.ialerts')


@section('content')

<h2>iAlerts</h2>

<div class="panel">
        <div class="panel-body container-fluid">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

            <div class="row row-lg">
                <div class="col-sm-8 col-lg-6">
                    <div class="example-wrap">
                    <form action="{{ route('PutAlertSave') }}" method="POST">
                     @csrf

                        <h4 class="example-title ng-binding">Email me when:</h4>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" name="mentions_news_blogs_socialmedia" id="al-important" 
                            @if(isset($ai->mentions_news_blogs_socialmedia) && $ai->mentions_news_blogs_socialmedia == 'on') checked @endif>
                            <label for="al-important" ng-show="account.id!=12182" class="ng-binding">mentions by important sources appear: news, blogs, social media</label>
                        </div>
                        <p></p>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" name="new_negative_mentions" id="al-negative"
                            @if(isset($ai->new_negative_mentions) && $ai->new_negative_mentions == 'on') checked @endif>
                            <label for="al-important" class="ng-binding">new negative mentions appear</label>
                        </div>
                        <p></p>
                        <div class="checkbox-custom checkbox-primary">
                            <input type="checkbox" name="number_mentions_increase" id="al-raise" 
                            @if(isset($ai->number_mentions_increase) && $ai->number_mentions_increase == 'on') checked @endif>
                            <label for="al-important" class="ng-binding">the number of mentions increases irregularly</label>
                        </div>
                        <p></p>
                        <div class="checkbox-custom checkbox-primary ng-hide">
                            <input type="checkbox" name="new_online_reviews_published" id="al-reviews" 
                            @if(isset($ai->new_online_reviews_published) && $ai->new_online_reviews_published == 'on') checked @endif>
                            <label for="al-important" class="ng-binding">new online reviews are published</label>
                        </div>
                        <p></p>
                        <h4 class="example-title ng-binding">Send email to:</h4>
                        <div class="form-group">
                            <input type="text" class="form-control" id="al-raise-emails" name="send_to" placeholder="address1@server.com; address2@server.com"
                            value="@if(isset($ai->send_to)) {{ $ai->send_to }} @endif">
                            <small class="ng-binding">Set alternative email addresses to receive notifications.</small>
                        </div>
                        <h4 class="example-title ng-binding">Filter by importance of sources:</h4>
                        <div class="form-group">
                            <select type="text" class="form-control" id="al-important-sens" name="filter_importance" >
                            <option value="Highest" @if(isset($ai->filter_importance) && $ai->filter_importance == 'Highest') selected @endif>Highest</option>
                            <option value="High" @if(isset($ai->filter_importance) && $ai->filter_importance == 'High') selected @endif>High</option>
                            <option value="Medium" @if(isset($ai->filter_importance) && $ai->filter_importance == 'Medium') selected @endif>Medium</option>
                            <option value="Low" @if(isset($ai->filter_importance) && $ai->filter_importance == 'Low') selected @endif>Low</option>
                            <option value="Lower" @if(isset($ai->filter_importance) && $ai->filter_importance == 'Lower') selected @endif>Lower</option>
                            <option value="NoFilter" @if(isset($ai->filter_importance) && $ai->filter_importance == 'NoFilter') selected @endif>No filter - All sources</option>
                            </select>
                            <small class="ng-binding">Higher importance causes fewer notifications</small>
                        </div>

                        <div class="form-group">
                        <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
