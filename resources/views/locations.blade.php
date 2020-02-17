@extends('spark::layouts.app')

@section('content')

<locations :locations="spark.extra.locations" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row justify-content-center">
            <div class="col-md-4 col-sm-12">
                <div class="card card-default">

                    <div v-if="!editing" class="card-header">Create New Location</div> 
                    <div v-if="editing" class="card-header">Update Location</div> 

                    <div class="card-body">
                        <form role="form">
                            <div class="form-group">
                                <div class="" data-children-count="1">
                                <label for="">Location:</label>
                                    <input v-model="form.title" type="text" class="form-control">
                                    <span class="invalid-feedback d-block" v-if="form.errors.has('title')" v-text="form.errors.get('title')"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Status</label>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="form.status" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Make Active</label>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class=" col-md-12">
                                    <button v-if="!editing" :disabled="form.busy" @click.prevent="doCreate" class="btn btn-primary">Create</button>

                                    <div v-if="editing">
                                        <button @click.prevent="doUpdate" :disabled="form.busy" class="btn btn-primary">Update</button>
                                        <button @click.prevent="editing = false; form.reset()" type="submit" class="btn btn-primary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-12">
                <div class="card card-default">
                    <div class="card-header"> Current Locations</div> 
                    <div class="table-responsive">
                        <table class="table table-valign-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th> <th>Status</th><th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="locations.length > 0" v-for="(item, index) in locations">
                                    <td>@{{ item.title }}</td>

                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" v-model="item.status" class="custom-control-input" id="customSwitch_id">
                                            <label class="custom-control-label" for="customSwitch_id">@{{ statuses[item.status] }}</label>
                                        </div>
                                    </td>

                                    <td class="td-fit">
                                        <a @click.prevent="edit(index)"  class="btn btn-outline-primary"><i class="fa fa-cog"></i></a>
                                        <a @click.prevent="destroy(index)" class="btn btn-outline-danger"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>

                                <tr v-else>
                                    <td colspan=10 align="center"><span>You do not have locations.</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</locations>
@endsection
