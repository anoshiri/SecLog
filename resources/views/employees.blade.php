@extends('spark::layouts.app')

@section('content')

<employees :employees="spark.extra.employees" :locations="spark.extra.locations" inline-template>
    <div class="container">

        <!-- Application Dashboard -->
        <div class="row justify-content-center">
            <div v-if="creating || editing" class="col">
                <div class="card card-default">

                    <div v-if="!editing" class="card-header">Add New Employee</div> 
                    <div v-if="editing" class="card-header">Update Employee Information</div> 

                    <div class="card-body">
                        <form role="form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">First Name</label>
                                    <input type="text" v-model="form.first_name" class="form-control" id="first_name">
                                    <span class="invalid-feedback d-block" v-if="form.errors.has('first_name')" v-text="form.errors.get('first_name')"></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" v-model="form.last_name" class="form-control" id="last_name">
                                    <span class="invalid-feedback d-block" v-if="form.errors.has('last_name')" v-text="form.errors.get('last_name')"></span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="location_id">Location</label>

                                    <select v-model="form.location_id" class="form-control" id="location_id" placeholder="-- select location --">
                                        <option v-for="option in locations" v-bind:value="option.id">
                                            @{{ option.title }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="department">Department</label>
                                    <input type="department" v-model="form.department" class="form-control" id="department">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" v-model="form.email" class="form-control" id="email">
                                    <span class="invalid-feedback d-block" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" v-model="form.phone" class="form-control" id="phone">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="form.status" class="custom-control-input" id="status">
                                    <label class="custom-control-label" for="status">Make Active</label>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class=" col-md-12">
                                    <button v-if="creating" :disabled="form.busy" @click.prevent="doCreate" class="btn btn-primary">Add Employee</button>

                                    <button v-if="editing" :disabled="form.busy" @click.prevent="doUpdate" class="btn btn-primary">Update Employee Record</button>

                                    <button @click.prevent="editing = creating = false; form.reset()" type="submit" class="btn btn-primary">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div v-if="!(creating || editing)" class="col">
                <!-- create button -->
                <div class="row mb-2"> 
                    <div class="col">
                        <div class="float-right">
                            <button @click="creating=true" class="btn btn-primary"><i class="la las la-plus"></i> Add Employee</button>
                        </div>
                    </div>
                </div>


                <div v-if="employees.data.length > 0" class="card card-default">
                    <div class="card-header"> Employees</div> 
                    <div class="table-responsive">
                        <table class="table table-valign-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>  
                                    <th>Location</th>
                                    <th>Department</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th><th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in employees.data">
                                    <td>@{{ item.full_name }}</td>
                                    <td>@{{ getLocationTitle(item.location_id) }}</td>
                                    <td>@{{ item.department }}</td>
                                    <td>@{{ item.phone }}</td>
                                    <td>@{{ item.email }}</td>

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
                            </tbody>
                        </table>
                    </div>
                </div>

                <div v-else class="intro mt-5">
                    <div class="intro-img">
                        <img src="http://e360security.local/img/create-team.svg" alt="Create Team" class="h-90">
                    </div>

                    <h4>Where're your employees?</h4> 
                    <p class="intro-copy">
                        It looks like you do not have employees listed yet!
                    </p> 
                    
                    <div class="intro-btn">
                        <a @click.prevent="creating=true" class="btn btn-outline-dark">Add Employee</a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</employees>
@endsection
