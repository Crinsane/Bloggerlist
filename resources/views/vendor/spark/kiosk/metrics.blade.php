<spark-kiosk-metrics :user="user" inline-template>
    <!-- The Landsman™ -->
    <div>
        <div class="row">
            <!-- Monthly Recurring Revenue -->
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title text-center">
                        <h5 style="display: block; float: none;">Monthly Recurring Revenue</h5>
                    </div>

                    <div class="ibox-content text-center text-success">
                        <div style="font-size: 24px;">
                            @{{ monthlyRecurringRevenue | currency spark.currencySymbol }}
                        </div>

                        <!-- Compared To Last Month -->
                        <div v-if="monthlyChangeInMonthlyRecurringRevenue" style="font-size: 12px;">
                            @{{ monthlyChangeInMonthlyRecurringRevenue }}% From Last Month
                        </div>

                        <!-- Compared To Last Year -->
                        <div v-if="yearlyChangeInMonthlyRecurringRevenue" style="font-size: 12px;">
                            @{{ yearlyChangeInMonthlyRecurringRevenue }}% From Last Year
                        </div>
                    </div>
                </div>
            </div>

            <!-- Yearly Recurring Revenue -->
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title text-center">
                        <h5 style="display: block; float: none;">Yearly Recurring Revenue</h5>
                    </div>

                    <div class="ibox-content text-center text-success">
                        <div style="font-size: 24px;">
                            @{{ yearlyRecurringRevenue | currency spark.currencySymbol }}
                        </div>

                        <!-- Compared To Last Month -->
                        <div v-if="monthlyChangeInYearlyRecurringRevenue" style="font-size: 12px;">
                            @{{ monthlyChangeInYearlyRecurringRevenue }}% From Last Month
                        </div>

                        <!-- Compared To Last Year -->
                        <div v-if="yearlyChangeInYearlyRecurringRevenue" style="font-size: 12px;">
                            @{{ yearlyChangeInYearlyRecurringRevenue }}% From Last Year
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Total Volume -->
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title text-center">
                        <h5 style="display: block; float: none;">Total Volume</h5>
                    </div>

                    <div class="ibox-content text-center text-success">
                        <span style="font-size: 24px;">
                            @{{ totalVolume | currency spark.currencySymbol }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Total Trial Users -->
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title text-center">
                        <h5 style="display: block; float: none;">Users Currently Trialing</h5>
                    </div>

                    <div class="ibox-content text-center text-info">
                        <span style="font-size: 24px;">
                            @{{ totalTrialUsers }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Recurring Revenue Chart -->
        <div class="row" v-show="indicators.length > 0">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title"><h5>Monthly Recurring Revenue</h5></div>

                    <div class="ibox-content">
                        <canvas id="monthlyRecurringRevenueChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yearly Recurring Revenue Chart -->
        <div class="row" v-show="indicators.length > 0">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title"><h5>Yearly Recurring Revenue</h5></div>

                    <div class="ibox-content">
                        <canvas id="yearlyRecurringRevenueChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-show="indicators.length > 0">
            <!-- Daily Volume Chart -->
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title"><h5>Daily Volume</h5></div>

                    <div class="ibox-content">
                        <canvas id="dailyVolumeChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <!-- Daily New Users Chart -->
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title"><h5>New Users</h5></div>

                    <div class="ibox-content">
                        <canvas id="newUsersChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Subscribers Per Plan -->
        <div class="row" v-if="plans.length > 0">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title"><h5>Subscribers Per Plan</h5></div>

                    <div class="ibox-content">
                        <table class="table table-borderless m-b-none">
                            <thead>
                                <th>Name</th>
                                <th>Subscribers</th>
                                <th>Trialing</th>
                            </thead>

                            <tbody>
                                <tr v-for="plan in plans">
                                    <!-- Plan Name -->
                                    <td>
                                        <div class="btn-table-align">
                                            @{{ plan.name }} (@{{ plan.interval | capitalize }})
                                        </div>
                                    </td>

                                    <!-- Subscriber Count -->
                                    <td>
                                        <div class="btn-table-align">
                                            @{{ plan.count }}
                                        </div>
                                    </td>

                                    <!-- Trialing Count -->
                                    <td>
                                        <div class="btn-table-align">
                                            @{{ plan.trialing }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</spark-kiosk-metrics>
