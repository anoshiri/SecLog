import { Notice } from "./shared/notice";

Vue.component('locations', {
    props: ['locations'],

    data () {
        return {
            form: new SparkForm(
                {
                    id: '',
                    title: '',
                    status: 0
                }
            ),
            notice: new Notice(),
            editing: false,
            index: 0,
            statuses: {0: 'Inactive', 1: "Active"}
        }
    },

    methods: {
        doCreate() {
            Spark.post(this.endpoint, this.form)
                .then(response => {
                    this.locations.push(response.item);
                    this.reset();
                    
                    this.notice.success(response.message);
                });
        },


        edit(index) {
            // load values to the current form
            let fields = this.locations[index];

            for (let field of Object.keys(this.form)) {
                if (this.locations[index].hasOwnProperty(field)){
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
                    Vue.set(this.locations, this.index, response.item);
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
                    Spark.delete(this.endpoint + '/' + this.locations[index].id, this.form)
                    .then(response => {
                        this.locations.splice(index, 1);

                        this.notice.success(response.message);
                    })
                }
            });
        },
        reset() {
            this.form.reset();
            this.editing = false;
        }
    },

    computed: {
        endpoint() {
            let url = '/locations';

            if (this.editing) {
                return url + '/' + this.locations[this.index].id;
            }

            return url;
        }
    }
})