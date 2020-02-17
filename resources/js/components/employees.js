import { Notice } from "./shared/notice";

Vue.component('employees', {
    props: ['employees', 'locations'],

    data () {
        return {
            form: new SparkForm(
                {
                    first_name: "",
                    last_name: "",
                    full_name: "",
                    department: "",
                    email: "",
                    phone: "",
                    location_id: "",
                    status: ""
                }
            ),
            notice: new Notice(),
            creating: false,
            editing: false,
            index: 0,
            statuses: {0: 'Inactive', 1: "Active"}
        }
    },

    methods: {
        doCreate() {
            Spark.post(this.endpoint, this.form)
                .then(response => {
                    this.employees.data.push(response.item);

                    this.reset();

                    this.notice.success(response.message);
                });
        },


        edit(index) {
            let fields = this.employees.data[index];

            for (let field of Object.keys(this.form)) {
                if (this.employees.data[index].hasOwnProperty(field)){
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
                    Vue.set(this.employees.data, this.index, response.item);

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
                    
                    Spark.delete(this.endpoint + '/' + this.employees.data[index].id, this.form)
                    
                    .then(response => {

                        this.employees.data = this.employees.data.slice(index, 1);

                        this.notice.success(response.message);
                    })
                }
            });
        },

        reset() {
            this.form.reset();
            this.editing = this.creating = false;
        },

        getLocationTitle (location_id) {
            return this.locations[this.locations.findIndex(x => x.id === location_id)].title;
        }
    },

    computed: {
        endpoint() {
            let url = '/employees';

            if (this.editing) {
                return url + '/' + this.employees.data[this.index].id;
            }

            return url;
        },

        
    }
})