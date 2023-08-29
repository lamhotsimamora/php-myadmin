<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP MY Admin</title>
    <script src="https://cdn.jsdelivr.net/gh/lamhotsimamora/jnet@master/dist/js/jnet.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <br><br>

    <div class="container">
        <div class="card">
            <div class="card-body">

                <h1>PHP My Admin | by Lamhot Simamora</h1>

            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-body">

                <h3>Database :
                    <div class="alert alert-warning" role="alert">
                        <?= esc($database) ?>
                    </div>
                </h3>
            </div>
        </div>
    </div>
    <br>
    <div class="container" id="app">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th v-for="data in tablename" scope="col">
                                    <a @click="loadField(data.table_name)" href="#">{{data.table_name}}</a>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <br>
    <div class="container" id="app2">
        <div class="card">
            <div class="card-body">
                <div v-if="loading" class="spinner-border text-primary" role="status">
                    <span class="visually-hidden"></span>
                </div>

                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th v-for="data in datatables" scope="col">{{data.COLUMN_NAME}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td v-for="data in datas">{{ data.field }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const $database = '<?= esc($database) ?>';
        const $server = "<?= base_url() ?>";
        new Vue({
            el: '#app',
            data: {
                tablename: null,
                database: $database
            },
            methods: {
                loadField: function(data) {
                    $app2.loading=true;
                    jnet({
                        url: $server + 'get-column-name',
                        method: 'post',
                        data: {
                            database: this.database,
                            tablename: data
                        }
                    }).request($response => {
                        let $obj = JSON.parse($response);
                        if ($obj) {
                            $app2.datatables = $obj;
                            $app2.loading=false;
                            $app2.loadData(data);
                        }
                    })
                },
                loadTableName: function() {
                    jnet({
                        url: $server + 'get-table-name',
                        method: 'post',
                        data: {
                            database: this.database
                        }
                    }).request($response => {
                        let $obj = JSON.parse($response);
                        if ($obj) {
                            this.tablename = $obj;
                        }
                    })
                }
            },
            mounted() {
                this.loadTableName();
            }
        });
        var $app2 = new Vue({
            el: '#app2',
            data: {
                datatables: null,
                loading:false,
                datas:null
            },
            methods: {
                loadData: function(tablename){
                    jnet({
                        url: $server + 'get-data',
                        method: 'post',
                        data: {
                            tablename:tablename
                        }
                    }).request($response => {
                        let $obj = JSON.parse($response);
                        if ($obj) {
                            this.datas = $obj;
                        }
                    })
                }
            },
            mounted() {

            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>