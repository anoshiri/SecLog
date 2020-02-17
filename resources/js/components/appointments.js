import { Notice } from "./shared/notice";

Vue.component('appointments', {
    props: ['appointments', 'employees'],

    data () {
        return {
            form: new SparkForm(
                {
                    first_name: "",
                    last_name: "",
                    full_name: "",
                    address: "",
                    date_time: "",
                    number_of_persons: "",
                    employee_id: "",
                    status: ""
                }
            ),
            notice: new Notice(),
            creating: false,
            editing: false,
            index: 0,
            statuses: {0: 'Pending', 1: "Visited" }
        }
    },

    methods: {
        doCreate() {
            Spark.post(this.endpoint, this.form)
                .then(response => {
                    this.appointments.data.push(response.item);

                    this.reset();

                    this.notice.success(response.message);
                });
        },


        edit(index) {
            let fields = this.appointments.data[index];

            for (let field of Object.keys(this.form)) {
                if (this.appointments.data[index].hasOwnProperty(field)){
                    this.form[field] = fields[field];
                }
            }

            // set editing flag to true
            this.editing = true;

            // store the item we are currently editing
            this.index = index; // editing becomes the index of the item to be edited
        },

        doUpdate() {
            Spark.patch(this.endpoint, this.form)
                .then( response => {
                    Vue.set(this.appointments.data, this.index, response.item);

                    this.reset();

                    this.notice.success(response.message);
                })
        },

        destroy(index) {
            Swal.fire({
                title: 'Confirm',
                text: 'Are you sure about this?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, continue!'
            }).then((result) => {
                if ( result.value) {
                    
                    Spark.delete(this.endpoint + '/' + this.appointments.data[index].id, this.form)
                    
                    .then(response => {

                        this.appointments.data = this.appointments.data.slice(index, 1);

                        this.notice.success(response.message);
                    })
                }
            });
        },

        reset() {
            this.form.reset();
            this.editing = this.creating = false;
        },

        getEmployeeName (employee_id) {
            console.log(employee_id);
            
            return this.employees[this.employees.findIndex(x => x.id === employee_id)].full_name;
        }
    },

    computed: {
        endpoint() {
            let url = '/appointments';

            if (this.editing) {
                return url + '/' + this.appointments.data[this.index].id;
            }

            return url;
        },

        
    }
})