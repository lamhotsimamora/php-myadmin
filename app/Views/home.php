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
    <div class="container" id="app">
        <div class="card">
            <div class="card-body">

                <div v-for="data in databases">
                <span  class="badge text-bg-primary"><a :href="viewLink(data.Database)"
                        style="color:white">{{data.Database}}</a></span>
                        <hr>
                </div>

            </div>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                databases: null
            },
            methods: {
                viewLink:function(data){
                    return './database/'+data;
                },
                loadDatabases: function() {
                    jnet({
                        url: './get-database',
                        method: 'post',
                        data: {
                            
                        }
                    }).request($response => {
                        let $obj = JSON.parse($response);
                        if ($obj){
                            this.databases = $obj;
                        }
                    })
                }
            },
            mounted() {
                this.loadDatabases();
            }
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>