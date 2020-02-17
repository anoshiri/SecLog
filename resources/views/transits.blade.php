@extends('spark::layouts.app')

@section('content')

<transits :persons="spark.extra.persons" inline-template>
    <div class="container">

        <!-- Application Dashboard -->
        <div class="row justify-content-center">
            <div class="col-md-3 spark-settings-tabs">
                <aside>
                    <h3 class="nav-heading ">
                        Settings
                    </h3> 
                    <ul class="nav flex-column mb-4 ">
                        <li class="nav-item "><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="nav-link active" aria-selected="true">
                                Profile
                            </a>
                        </li> 
                            
                        <li class="nav-item ">
                            <a href="#teams" aria-controls="teams" role="tab" data-toggle="tab" class="nav-link">
                                Teams
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>

            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#drive">Drive-In</a></li>
                    <li><a data-toggle="tab" href="#walk">Walk-In</a></li>
                    <li><a data-toggle="tab" href="#exit">Exit</a></li>
                </ul>

                <div class="tab-content">
                    <div id="drive" class="tab-pane fade in active">
                        <h3>Drive</h3>
                        <p>Some content.</p>
                    </div>
                    <div id="walk" class="tab-pane fade">
                        <h3>Walk</h3>
                        <p>Some content in menu 1.</p>
                    </div>
                    <div id="exit" class="tab-pane fade">
                        <h3>Exit</h3>
                        <p>Some content in menu 2.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</transits>


@endsection
