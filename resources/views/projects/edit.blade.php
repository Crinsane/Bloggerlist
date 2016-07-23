@extends('spark::layouts.dashboard')

@section('title', 'Edit a project')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <update-project :user="user" inline-template>

                    <form role="form">
                        <input type="hidden" v-model="id" value="{{ $project->id }}">
                        <div class="row">

                            <!-- Project details -->
                            <div class="col-md-9">
                                <div class="ibox">
                                    <div class="ibox-title"><h5>Project details</h5></div>
                                    <div class="ibox-content">
                                        <!-- Title -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('title')}">
                                            <label for="title">Project title</label>
                                            <input type="text" name="title" id="title" class="form-control" v-model="form.title" value="{{ $project->title }}">

                                            <span class="help-block" v-show="form.errors.has('title')">
                                                @{{ form.errors.get('title') }}
                                            </span>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('description')}">
                                            <label for="description">Project description</label>
                                            <textarea name="description" id="description" class="form-control" rows="8" v-model="form.description">{{ $project->description }}</textarea>

                                            <span class="help-block" v-show="form.errors.has('description')">
                                                @{{ form.errors.get('description') }}
                                            </span>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('reward')}">
                                            <label for="reward">Project reward</label>
                                            <textarea name="reward" id="reward" class="form-control" rows="6" v-model="form.reward">{{ $project->reward }}</textarea>

                                            <span class="help-block" v-show="form.errors.has('reward')">
                                                @{{ form.errors.get('reward') }}
                                            </span>
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
                                                    <option value="{{ $category->id }}" {{ $category->id == $project->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>

                                            <span class="help-block" v-show="form.errors.has('category_id')">
                                                @{{ form.errors.get('category_id') }}
                                            </span>
                                        </div>

                                        <!-- Location -->
                                        <div class="form-group" :class="{'has-error': form.errors.has('location')}">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" id="location" class="form-control" v-model="form.location" value="{{ $project->location }}">

                                            <span class="help-block" v-show="form.errors.has('location')">
                                                @{{ form.errors.get('location') }}
                                            </span>
                                        </div>

                                        <hr>

                                        <div class="form-group" style="margin-bottom: 0;">
                                            <button type="submit" class="btn btn-primary" @click.prevent="update" :disabled="form.busy">
                                                <span v-if="form.busy">
                                                    <i class="fa fa-btn fa-spinner fa-spin"></i>Updating project
                                                </span>

                                                <span v-else>
                                                    <i class="fa fa-btn fa-floppy-o"></i>Update project
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Project images -->
                            <div class="col-md-9">
                                <div class="ibox">
                                    <div class="ibox-title"><h5>Project images</h5></div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <project-image v-for="image in images" :image="image"></project-image>
                                                <div v-for="file in files" class="pull-left project-image-thumbnail">
                                                    <img :src="file.url" alt="Project image" class="img-thumbnail">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="project-images" class="dropzone"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </update-project>
            </div>
        </div>
    </div>
@endsection