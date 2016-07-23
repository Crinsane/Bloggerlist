<spark-kiosk-users :user="user" inline-template>
    <div>
        <div v-show=" ! showingUserProfile">
            <!-- Search Field Panel -->
            <div class="panel panel-default panel-flush" style="border: 0;">
                <div class="panel-body">
                    <form class="form-horizontal p-b-none" role="form" @submit.prevent>
                        <!-- Search Field -->
                        <div class="form-group m-b-none">
                            <div class="col-md-12">
                                <input type="text" id="kiosk-users-search" class="form-control"
                                        name="search"
                                        placeholder="Search By Name Or E-Mail Address..."
                                        v-model="searchForm.query"
                                        @keyup.enter="search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Searching -->
            <div class="ibox" v-if="searching">
                <div class="ibox-title"><h5>Search Results</h5></div>

                <div class="ibox-content">
                    <i class="fa fa-btn fa-spinner fa-spin"></i>Searching
                </div>
            </div>

            <!-- No Search Results -->
            <div class="ibox" v-if=" ! searching && noSearchResults">
                <div class="ibox-title"><h5>Search Results</h5></div>

                <div class="ibox-content text-warning">
                    No users matched the given criteria.
                </div>
            </div>

            <!-- User Search Results -->
            <div class="ibox" v-if=" ! searching && searchResults.length > 0">
                <div class="ibox-title"><h5>Search Results</h5></div>

                <div class="ibox-content">
                    <table class="table table-borderless m-b-none">
                        <thead>
                            <th></th>
                            <th>Name</th>
                            <th>E-Mail Address</th>
                            <th></th>
                        </thead>

                        <tbody>
                            <tr v-for="searchUser in searchResults">
                                <!-- Profile Photo -->
                                <td>
                                    <img :src="searchUser.photo_url" class="spark-profile-photo">
                                </td>

                                <!-- Name -->
                                <td>
                                    <div class="btn-table-align">
                                        @{{ searchUser.name }}
                                    </div>
                                </td>

                                <!-- E-Mail Address -->
                                <td>
                                    <div class="btn-table-align">
                                        @{{ searchUser.email }}
                                    </div>
                                </td>

                                <td>
                                    <!-- View User Profile -->
                                    <button class="btn btn-default" @click="showUserProfile(searchUser)">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div>
        <!-- User Profile Detail -->
        <div v-show="showingUserProfile">
            @include('spark::kiosk.profile')
        </div>
    </div>
</spark-kiosk-users>
