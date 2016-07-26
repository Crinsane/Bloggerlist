<!-- Coupon -->
<div class="row" v-if="coupon">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-success">
            <div class="panel-heading">Discount</div>

            <div class="panel-body">
                The coupon's @{{ discount }} discount will be applied to your subscription!
            </div>
        </div>
    </div>
</div>

<!-- Invalid Coupon -->
<div class="row" v-if="invalidCoupon">
    <div class="col-md-8 col-md-offset-2">
        <div class="alert alert-danger">
            Whoops! This coupon code is invalid.
        </div>
    </div>
</div>

<!-- Invitation -->
<div class="row" v-if="invitation">
    <div class="col-md-8 col-md-offset-2">
        <div class="alert alert-success">
            We found your invitation to the <strong>@{{ invitation.team.name }}</strong> team!
        </div>
    </div>
</div>

<!-- Invalid Invitation -->
<div class="row" v-if="invalidInvitation">
    <div class="col-md-8 col-md-offset-2">
        <div class="alert alert-danger">
            Whoops! This invitation code is invalid.
        </div>
    </div>
</div>

<!-- Plan Selection -->
<div class="row" v-if="paidPlans.length > 0">
    <div class="col-md-8 col-md-offset-2">
        <div class="ibox">
            <div class="ibox-title">
                <div class="pull-left" :class="{'btn-table-align': hasMonthlyAndYearlyPlans}">
                    <h5>Subscription</h5>
                </div>

                <!-- Interval Selector Button Group -->
                <div class="pull-right">
                    <div class="btn-group" v-if="hasMonthlyAndYearlyPlans" style="padding-top: 2px;">
                        <!-- Monthly Plans -->
                        <button type="button" class="btn btn-default"
                                @click="showMonthlyPlans"
                                :class="{'active': showingMonthlyPlans}">

                            Monthly
                        </button>

                        <!-- Yearly Plans -->
                        <button type="button" class="btn btn-default"
                                @click="showYearlyPlans"
                                :class="{'active': showingYearlyPlans}">

                            Yearly
                        </button>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="ibox-content spark-row-list">
                <!-- Plan Error Message - In General Will Never Be Shown -->
                <div class="alert alert-danger" v-if="registerForm.errors.has('plan')">
                    @{{ registerForm.errors.get('plan') }}
                </div>

                <!-- European VAT Notice -->
                @if (Spark::collectsEuropeanVat())
                    <p class="p-b-md">
                        All subscription plan prices are excluding applicable VAT.
                    </p>
                @endif

                <div class="row">
                    <div class="col-md-6" style="border-right: 1px solid #e7eaec;">
                        <div class="row">
                            <template v-for="plan in freePlans">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-block dim" v-if="isSelected(plan)" disabled>
                                        <i class="fa fa-btn fa-check"></i>You're a blogger!
                                    </button>

                                    <button class="btn btn-outline btn-primary btn-block dim" @click="selectPlan(plan)" v-else>
                                        I am a blogger!
                                    </button>
                                </div>

                                <div class="col-xs-10 col-xs-offset-1">
                                    <ul class="list-group text-left m-t-lg" :class="{ 'selected' : isSelected(plan) }">
                                        <li v-for="feature in plan.features" class="list-group-item">
                                            <i class="fa fa-btn fa-star-o text-navy"></i>@{{ feature }}
                                        </li>
                                    </ul>
                                </div>
                            </template>
                        </div>

                        {{--<table class="table table-borderless m-b-none">--}}
                            {{--<thead></thead>--}}
                            {{--<tbody>--}}
                                {{--<tr v-for="plan in freePlans">--}}
                                    {{--<!-- Plan Name -->--}}
                                    {{--<td>--}}
                                        {{--<div class="btn-table-align" @click="showPlanDetails(plan)">--}}
                                            {{--<span style="cursor: pointer;">--}}
                                                {{--<strong>@{{ plan.name }}</strong>--}}
                                            {{--</span>--}}
                                            {{--<span v-if="plan.price == 0">--}}
                                                {{--Free--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}

                                    {{--<!-- Plan Features Button -->--}}
                                    {{--<td>--}}
                                        {{--<button class="btn btn-default m-l-sm" @click="showPlanDetails(plan)">--}}
                                            {{--<i class="fa fa-btn fa-star-o"></i>Plan Features--}}
                                        {{--</button>--}}
                                    {{--</td>--}}

                                    {{--<!-- Trial Days -->--}}
                                    {{--<td>--}}
                                        {{--<div class="btn-table-align" v-if="plan.trialDays">--}}
                                            {{--@{{ plan.trialDays}} Day Trial--}}
                                        {{--</div>--}}
                                    {{--</td>--}}

                                    {{--<!-- Plan Select Button -->--}}
                                    {{--<td class="text-right">--}}
                                        {{--<button class="btn btn-primary btn-plan" v-if="isSelected(plan)" disabled>--}}
                                            {{--<i class="fa fa-btn fa-check"></i>Selected--}}
                                        {{--</button>--}}

                                        {{--<button class="btn btn-outline btn-primary btn-plan" @click="selectPlan(plan)" v-else>--}}
                                            {{--Select--}}
                                        {{--</button>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <template v-for="plan in paidPlans">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-block dim" v-if="isSelected(plan)" disabled>
                                        <i class="fa fa-btn fa-check"></i>You're a company!
                                    </button>

                                    <button class="btn btn-outline btn-primary btn-block dim" @click="selectPlan(plan)" v-else>
                                        I am a company!
                                    </button>
                                </div>
                                <div class="col-xs-10 col-xs-offset-1">
                                    <ul class="list-group text-left m-t-lg" :class="{ 'selected' : isSelected(plan) }">
                                        <li v-for="feature in plan.features" class="list-group-item">
                                            <i class="fa fa-btn fa-star-o text-navy"></i>@{{ feature }}
                                        </li>
                                    </ul>
                                </div>
                            </template>
                        </div>


                        {{--<table class="table table-borderless m-b-none">--}}
                            {{--<thead></thead>--}}
                            {{--<tbody>--}}
                                {{--<tr v-for="plan in paidPlans">--}}
                                    {{--<!-- Plan Name -->--}}
                                    {{--<td>--}}
                                        {{--<div class="btn-table-align" @click="showPlanDetails(plan)">--}}
                                            {{--<span style="cursor: pointer;">--}}
                                                {{--<strong>@{{ plan.name }}</strong>--}}
                                            {{--</span>--}}
                                            {{--<span v-if="plan.price > 0">--}}
                                                {{--@{{ plan.price | currency spark.currencySymbol }} / @{{ plan.interval | capitalize }}--}}
                                            {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</td>--}}

                                    {{--<!-- Plan Features Button -->--}}
                                    {{--<td>--}}
                                        {{--<button class="btn btn-default m-l-sm" @click="showPlanDetails(plan)">--}}
                                            {{--<i class="fa fa-btn fa-star-o"></i>Plan Features--}}
                                        {{--</button>--}}
                                    {{--</td>--}}

                                    {{--<!-- Trial Days -->--}}
                                    {{--<td>--}}
                                        {{--<div class="btn-table-align" v-if="plan.trialDays">--}}
                                            {{--@{{ plan.trialDays}} Day Trial--}}
                                        {{--</div>--}}
                                    {{--</td>--}}

                                    {{--<!-- Plan Select Button -->--}}
                                    {{--<td class="text-right">--}}
                                        {{--<button class="btn btn-primary btn-plan" v-if="isSelected(plan)" disabled>--}}
                                            {{--<i class="fa fa-btn fa-check"></i>Selected--}}
                                        {{--</button>--}}

                                        {{--<button class="btn btn-outline btn-primary btn-plan" @click="selectPlan(plan)" v-else>--}}
                                            {{--Select--}}
                                        {{--</button>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Basic Profile -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="ibox">
            <div class="ibox-title">
                <h5>
                    <span v-if="paidPlans.length > 0">
                        Profile
                    </span>

                    <span v-else>
                        Register
                    </span>
                </h5>
            </div>

            <div class="ibox-content">
                <!-- Generic Error Message -->
                <div class="alert alert-danger" v-if="registerForm.errors.has('form')">
                    @{{ registerForm.errors.get('form') }}
                </div>

                <!-- Invitation Code Error -->
                <div class="alert alert-danger" v-if="registerForm.errors.has('invitation')">
                    @{{ registerForm.errors.get('invitation') }}
                </div>

                <!-- Registration Form -->
                @include('spark::auth.register-common-form')
            </div>
        </div>
    </div>
</div>
