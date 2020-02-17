@extends('spark::layouts.app')

@section('content')

<appointments :appointments="spark.extra.appointments" :employees="spark.extra.employees" inline-template>
    <div class="container">

        <!-- Application Dashboard -->
        <div class="row justify-content-center">
            <div v-if="creating || editing" class="col">
                <div class="card card-default">

                    <div v-if="!editing" class="card-header">Create New Appointment</div> 
                    <div v-if="editing" class="card-header">Update Appointment</div> 

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
                                    <label for="employee_id">Employee (Host)</label>

                                    <select v-model="form.employee_id" class="form-control" id="employee_id" placeholder="-- select employee --">
                                        <option v-for="option in employees" v-bind:value="option.id">
                                            @{{ option.full_name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="address" v-model="form.address" class="form-control" id="address">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="number_of_persons">Number of persons expected</label>
                                    <input type="number" v-model="form.number_of_persons" class="form-control" id="number_of_persons">
                                    <span class="invalid-feedback d-block" v-if="form.errors.has('number_of_persons')" v-text="form.errors.get('number_of_persons')"></span>
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
                                    <button v-if="creating" :disabled="form.busy" @click.prevent="doCreate" class="btn btn-primary">Create Appointment</button>

                                    <button v-if="editing" :disabled="form.busy" @click.prevent="doUpdate" class="btn btn-primary">Update Appointment</button>

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
                            <button @click="creating=true" class="btn btn-primary"><i class="la las la-plus"></i> Create New Appointment</button>
                        </div>
                    </div>
                </div>


                <div class="card card-default">
                    <div class="card-header"> Appointments</div> 
                    <div class="table-responsive">
                        <table class="table table-valign-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>  
                                    <th>Host</th>
                                    <th>Address</th>
                                    <th># Persons expected</th>
                                    <th>Status</th><th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="appointments.data.length > 0" v-for="(item, index) in appointments.data">
                                    <td>@{{ item.full_name }}</td>
                                    <td>@{{ getEmployeeName(item.employee_id) }}</td>
                                    <td>@{{ item.address }}</td>
                                    <td>@{{ item.number_of_persons }}</td>

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

                                <tr v-if="appointments.data.length <= 0">
                                    <td colspan="10" align="center"><span>You do not have appointments.</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> 
        </div>
    </div>
</appointments>

@endsection
