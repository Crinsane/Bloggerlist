<spark-invoice-list :user="user" :team="team"
                    :invoices="invoices" :billable-type="billableType" inline-template>

    <div class="ibox">
        <div class="ibox-title"><h5>Invoices</h5></div>

        <div class="ibox-content">
            <table class="table table-borderless m-b-none">
                <thead>
                </thead>
                <tbody>
                    <tr v-for="invoice in invoices">
                        <!-- Invoice Date -->
                        <td>
                            <div class="btn-table-align">
                                <strong>@{{ invoice.date | date }}</strong>
                            </div>
                        </td>

                        <!-- Invoice Total -->
                        <td>
                            <div class="btn-table-align">@{{ invoice.total | currency spark.currencySymbol }}</div>
                        </td>

                        <!-- Invoice Download Button -->
                        <td class="text-right">
                            <a :href="downloadUrlFor(invoice)">
                                <button class="btn btn-default">
                                    <i class="fa fa-btn fa-file-pdf-o"></i>Download PDF
                                </button>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</spark-invoice-list>
