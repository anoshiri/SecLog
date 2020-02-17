import { Notice } from "./shared/notice";

Vue.component('transits', {
    props: ['persons'],

    data () {
        return {
            form: new SparkForm(
                {
                    first_name: "",
                    last_name: "",
                }
            ),
            notice: new Notice(),
        }
    }
});