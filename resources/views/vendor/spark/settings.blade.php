@extends('spark::layouts.dashboard')

@section('title', 'Settings')

@section('scripts')
    @if (Spark::billsUsingStripe())
        <script src="https://js.stripe.com/v2/"></script>
    @else
        <script src="https://js.braintreegateway.com/v2/braintree.js"></script>
    @endif
@endsection

@section('body')

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <spark-settings :user="user" :teams="teams" inline-template>
                    <div class="spark-screen container">
                        <div class="row">
                            <!-- Tabs -->
                            <div class="col-md-4">
                                <div class="ibox">
                                    <div class="ibox-title"><h5>Settings</h5></div>

                                    <div class="ibox-content" style="padding: 0;">
                                        <div class="spark-settings-tabs">
                                            <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                                <!-- Profile Link -->
                                                <li role="presentation">
                                                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                                        <i class="fa fa-fw fa-btn fa-edit"></i>Profile
                                                    </a>
                                                </li>

                                                <!-- Teams Link -->
                                                @if (Spark::usesTeams())
                                                    <li role="presentation">
                                                        <a href="#teams" aria-controls="teams" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-btn fa-users"></i>Teams
                                                        </a>
                                                    </li>
                                                @endif

                                                <!-- Security Link -->
                                                <li role="presentation">
                                                    <a href="#security" aria-controls="security" role="tab" data-toggle="tab">
                                                        <i class="fa fa-fw fa-btn fa-lock"></i>Security
                                                    </a>
                                                </li>

                                                <!-- API Link -->
                                                @if (Spark::usesApi())
                                                    <li role="presentation">
                                                        <a href="#api" aria-controls="api" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-btn fa-cubes"></i>API
                                                        </a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing Tabs -->
                                @if (Spark::canBillCustomers())
                                    <div class="ibox">
                                        <div class="ibox-title"><h5>Billing</h5></div>

                                        <div class="ibox-content" style="padding: 0;">
                                            <div class="spark-settings-tabs">
                                                <ul class="nav spark-settings-stacked-tabs" role="tablist">
                                                    @if (Spark::hasPaidPlans())
                                                        <!-- Subscription Link -->
                                                        <li role="presentation">
                                                            <a href="#subscription" aria-controls="subscription" role="tab" data-toggle="tab">
                                                                <i class="fa fa-fw fa-btn fa-shopping-bag"></i>Subscription
                                                            </a>
                                                        </li>
                                                    @endif

                                                    <!-- Payment Method Link -->
                                                    <li role="presentation">
                                                        <a href="#payment-method" aria-controls="payment-method" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-btn fa-credit-card"></i>Payment Method
                                                        </a>
                                                    </li>

                                                    <!-- Invoices Link -->
                                                    <li role="presentation">
                                                        <a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab">
                                                            <i class="fa fa-fw fa-btn fa-history"></i>Invoices
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Tab Panels -->
                            <div class="col-md-8">
                                <div class="tab-content">
                                    <!-- Profile -->
                                    <div role="tabpanel" class="tab-pane active" id="profile">
                                        @include('spark::settings.profile')
                                    </div>

                                    <!-- Teams -->
                                    @if (Spark::usesTeams())
                                        <div role="tabpanel" class="tab-pane" id="teams">
                                            @include('spark::settings.teams')
                                        </div>
                                    @endif

                                    <!-- Security -->
                                    <div role="tabpanel" class="tab-pane" id="security">
                                        @include('spark::settings.security')
                                    </div>

                                    <!-- API -->
                                    @if (Spark::usesApi())
                                        <div role="tabpanel" class="tab-pane" id="api">
                                            @include('spark::settings.api')
                                        </div>
                                    @endif

                                    <!-- Billing Tab Panes -->
                                    @if (Spark::canBillCustomers())
                                        @if (Spark::hasPaidPlans())
                                            <!-- Subscription -->
                                            <div role="tabpanel" class="tab-pane" id="subscription">
                                                <div v-if="user">
                                                    @include('spark::settings.subscription')
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Payment Method -->
                                        <div role="tabpanel" class="tab-pane" id="payment-method">
                                            <div v-if="user">
                                                @include('spark::settings.payment-method')
                                            </div>
                                        </div>

                                        <!-- Invoices -->
                                        <div role="tabpanel" class="tab-pane" id="invoices">
                                            @include('spark::settings.invoices')
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </spark-settings>
            </div>
        </div>
    </div>

@endsection
