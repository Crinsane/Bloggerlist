@extends('spark::layouts.dashboard')

@section('title', 'Kiosk')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.0/Chart.min.js"></script>
@endsection

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <spark-kiosk :user="user" inline-template>
                    <div class="container-fluid">
                        <div class="row">
                            <!-- Tabs -->
                            <div class="col-md-4">
                                <div class="ibox">
                                    <div class="ibox-title"><h5>Kiosk</h5></div>

                                    <div class="ibox-content" style="padding: 0;">
                                        <div class="spark-settings-tabs">
                                            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                                <!-- Announcements Link -->
                                                <li role="presentation" class="active">
                                                    <a href="#announcements" aria-controls="announcements" role="tab" data-toggle="tab">
                                                        <i class="fa fa-fw fa-btn fa-bullhorn"></i>Announcements
                                                    </a>
                                                </li>

                                                <!-- Metrics Link -->
                                                <li role="presentation">
                                                    <a href="#metrics" aria-controls="metrics" role="tab" data-toggle="tab">
                                                        <i class="fa fa-fw fa-btn fa-bar-chart"></i>Metrics
                                                    </a>
                                                </li>

                                                <!-- Users Link -->
                                                <li role="presentation">
                                                    <a href="#users" aria-controls="users" role="tab" data-toggle="tab">
                                                        <i class="fa fa-fw fa-btn fa-user"></i>Users
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab Panels -->
                            <div class="col-md-8">
                                <div class="tab-content">
                                    <!-- Announcements -->
                                    <div role="tabpanel" class="tab-pane active" id="announcements">
                                        @include('spark::kiosk.announcements')
                                    </div>

                                    <!-- Metrics -->
                                    <div role="tabpanel" class="tab-pane" id="metrics">
                                        @include('spark::kiosk.metrics')
                                    </div>

                                    <!-- User Management -->
                                    <div role="tabpanel" class="tab-pane" id="users">
                                        @include('spark::kiosk.users')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </spark-kiosk>
            </div>
        </div>
    </div>

@endsection