@extends('spark::layouts.dashboard')

@section('title', 'Personal projects')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">

                <projects-list :user="user" inline-template>

                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>The projects you've created</h5>
                            <div class="ibox-tools">
                                <a href="{{ route('projects.create') }}" class="btn btn-primary btn-xs">Create new project</a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row m-b-sm m-t-sm">
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-white btn-sm" @click="refresh">
                                        <i class="fa fa-refresh" :class="{ 'fa-spin': refreshing }"></i> Refresh
                                    </button>
                                </div>
                                <div class="col-md-4" style="padding-top: 4px;">
                                    <template v-if="category.name">
                                        <label>Filter by: </label>
                                        <span class="project-category-filter">@{{ category.name }} <a href="#" @click.prevent="removeCategoryFilter"><i class="fa fa-times"></i></a></span>
                                    </template>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" class="input-sm form-control" placeholder="Search" v-model="search">
                                </div>
                            </div>

                            <div v-if="loading" class="projects-loading">
                                <h3><i class="fa fa-spinner fa-spin"></i> Loading your projects...</h3>
                            </div>

                            <div class="project-list" v-else>

                                <div class="no-projects-found" v-if="filteredProjects.length == 0">
                                    <h3>No projects were found.</h3>
                                </div>

                                <table class="table table-hover" v-else>
                                    <tbody>
                                        <tr v-for="project in filteredProjects">
                                            <td class="project-status">
                                                <a href="#" @click.prevent="filterByCategory(project.category)" class="label" :class="project.category.slug">@{{ project.category.name }}</a>
                                            </td>
                                            <td class="project-title">
                                                <a href="/projects/@{{ project.id }}">@{{ project.title }}</a>
                                                <br/>
                                                <small>Created @{{ project.created_at | date }}</small>
                                            </td>
                                            <td class="project-completion">
                                                <small>Completion with: 48%</small>
                                                <div class="progress progress-mini">
                                                    <div style="width: 48%;" class="progress-bar"></div>
                                                </div>
                                            </td>
                                            <td class="project-people">
                                                <a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>
                                                <a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>
                                                <a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>
                                                <a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>
                                                <a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>
                                            </td>
                                            <td class="project-actions">
                                                <a href="/projects/@{{ project.id }}" class="btn btn-white btn-sm"><i class="fa fa-folder"></i> View</a>
                                                <a href="/projects/@{{ project.id }}/edit" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </projects-list>
            </div>
        </div>
    </div>
@endsection