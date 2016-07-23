<update-profile-details :user="user" inline-template>
    <div class="ibox">
        <div class="ibox-title"><h5>Profile Details</h5></div>

        <div class="ibox-content">
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                Your profile has been updated!
            </div>

            <form class="form-horizontal" role="form">
                <!-- Title -->
                <div class="form-group" :class="{'has-error': form.errors.has('title')}">
                    <label class="col-md-4 control-label">Title</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" v-model="form.title">

                        <span class="help-block" v-show="form.errors.has('title')">
                            @{{ form.errors.get('title') }}
                        </span>
                    </div>
                </div>

                <!-- Website -->
                <div class="form-group" :class="{'has-error': form.errors.has('website')}">
                    <label class="col-md-4 control-label">Website URL</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="website" v-model="form.website">

                        <span class="help-block" v-show="form.errors.has('website')">
                            @{{ form.errors.get('website') }}
                        </span>
                    </div>
                </div>

                <!-- Branch -->
                <div class="form-group" :class="{'has-error': form.errors.has('branch')}">
                    <label class="col-md-4 control-label">Branch</label>

                    <div class="col-md-6">
                        <select class="form-control" name="branch" v-model="form.branch">
                            <option v-if="form.branch == ''" value="" selected disabled>Select your branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>

                        <span class="help-block" v-show="form.errors.has('branch')">
                            @{{ form.errors.get('branch') }}
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group" :class="{'has-error': form.errors.has('description')}">
                    <label class="col-md-4 control-label">Description</label>

                    <div class="col-md-6">
                        <textarea class="form-control" name="description" v-model="form.description" rows="8"></textarea>

                        <span class="help-block" v-show="form.errors.has('description')">
                            @{{ form.errors.get('description') }}
                        </span>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <button type="submit" class="btn btn-primary"
                                @click.prevent="update"
                                :disabled="form.busy">

                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</update-profile-details>