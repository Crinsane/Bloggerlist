@extends('spark::layouts.dashboard')

@section('title', 'Create a new project')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <create-project :user="user" inline-template>

                    <form role="form">
                        <div class="row">

                            <div class="col-md-9">

                                <!-- Project details -->
                                <div class="ibox">
                                    <div class="ibox-title"><h5>Create a new project</h5></div>
                                    <div class="ibox-content">
                                        <!-- Title -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('title')}">
                                            <label for="title">Project title</label>
                                            <input type="text" name="title" id="title" class="form-control" v-model="form.title">

                                            <span class="help-block" v-show="form.errors.has('title')">
                                                @{{ form.errors.get('title') }}
                                            </span>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('description')}">
                                            <label for="description">Project description</label>
                                            <textarea name="description" id="description" class="form-control" rows="8" v-model="form.description"></textarea>

                                            <span class="help-block" v-show="form.errors.has('description')">
                                                @{{ form.errors.get('description') }}
                                            </span>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('reward')}">
                                            <label for="reward">Project reward</label>
                                            <textarea name="reward" id="reward" class="form-control" rows="6" v-model="form.reward"></textarea>

                                            <span class="help-block" v-show="form.errors.has('reward')">
                                                @{{ form.errors.get('reward') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Project Steps -->
                                <div class="ibox">
                                    <div class="ibox-title"><h5>Project steps</h5></div>
                                    <div class="ibox-content">

                                        <project-steps :user="user" :steps.sync="steps" :form="form" inline-template>

                                            <div id="project-steps">
                                                <div class="panel panel-default" v-for="step in steps">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-sm-2" style="padding-top: 3px;">
                                                                <i class="fa fa-arrows project-step-handle"></i> Step @{{ $index + 1 }}
                                                            </div>
                                                            <div class="col-sm-9">
                                                                <div class="form-group m-b-none" :class="{ 'has-error': hasError($index, 'title') }">
                                                                    <input type="text" name="step-title" class="form-control input-sm" placeholder="Step title" v-model="step.title">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-1 text-right" style="padding-top: 3px;">
                                                                <a href="#" @click.prevent="removeStep(step)"><i class="fa fa-times"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="form-group m-b-none" :class="{ 'has-error': hasError($index, 'description') }">
                                                            <textarea name="step-description" class="form-control" rows="3" placeholder="Step description" v-model="step.description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <button class="btn btn-primary btn-sm" @click.prevent="addStep"><i class="fa fa-plus"></i> Add another step</button>

                                        </project-steps>

                                    </div>
                                </div>

                                <!-- Project images -->
                                <div class="ibox">
                                    <div class="ibox-title"><h5>Project images</h5></div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div v-for="file in files" class="pull-left project-image-thumbnail">
                                                    <img :src="file.url" alt="Project image" class="img-thumbnail">
                                                    <a href="#" class="btn btn-xs btn-danger project-image-delete" @click.prevent="deleteImage(file)"><i class="fa fa-times"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="project-images" class="dropzone"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project meta -->
                            <div class="col-md-3">
                                <div class="ibox">
                                    <div class="ibox-title"><h5>Project meta</h5></div>
                                    <div class="ibox-content">
                                        <!-- Category -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('category_id')}">
                                            <label for="category_id">Category</label>
                                            <select name="category_id" id="category_id" class="form-control" v-model="form.category_id">
                                                <option value="" selected disabled>Select a category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            <span class="help-block" v-show="form.errors.has('category_id')">
                                                @{{ form.errors.get('category_id') }}
                                            </span>
                                        </div>

                                        <!-- Location -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('location')}">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" id="location" class="form-control" v-model="form.location">

                                            <span class="help-block" v-show="form.errors.has('location')">
                                                @{{ form.errors.get('location') }}
                                            </span>
                                        </div>

                                        <hr>

                                        <div class="form-group" style="margin-bottom: 0;">
                                            <button type="submit" class="btn btn-primary" @click.prevent="store" :disabled="form.busy">
                                                <span v-if="form.busy">
                                                    <i class="fa fa-btn fa-spinner fa-spin"></i>Saving project
                                                </span>

                                                <span v-else>
                                                    <i class="fa fa-btn fa-floppy-o"></i>Save project
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </create-project>
            </div>
        </div>
    </div>
@endsection