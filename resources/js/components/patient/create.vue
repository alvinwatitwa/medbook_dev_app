d<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Patient</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">
                                    Name
                                </label>
                                <input type="text" class="form-control" v-model="form.name">
                            </div>
                            <div class="col-md-6">
                                <label for="name">
                                    Date Of Birth
                                </label>
                                <datepicker v-model="form.dob" name="uniquename"></datepicker>
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="gender">
                                    Gender
                                </label>
                              <v-select :options="genders" v-model="form.gender" label="name" :reduce="gender => gender.id"></v-select>
                            </div>
                            <div class="col-md-6">
                                <label for="Service">
                                    Service
                                </label>
                              <v-select :options="services" v-model="form.service" label="name" :reduce="service => service.id"></v-select>
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-md-12">
                                <label for="name">
                                   General Comments
                                </label>
                                <textarea class="form-control" v-model="form.comments"></textarea>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <button class="btn btn-success btn-sm pull-right" @click="postData()">Submit</button>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <th>Name</th>
                                        <th>D.O.B</th>
                                        <th>Gender</th>
                                        <th>Service</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="patient in patients">
                                            <td>{{ patient.name }}</td>
                                             <td>{{ patient.dob | moment("dddd, MMMM Do YYYY") }}</td>
                                              <td>{{ patient.gender.name }}</td>
                                               <td>{{ patient.service.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                       

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //  import moment from 'moment';
    import Datepicker from 'vuejs-datepicker';
    export default {
        components: {
            Datepicker
        },
        mounted() {
            console.log('Component mounted.')
        },
        created(){
                this.getData();
        },
        data(){
            return {
                form: {
                    'name': '',
                    'dob': '',
                    'gender': '',
                    'service': '',
                    'comments': ''
                },
                genders: [],
                services: [],
                patients: []
            }
        },
        methods: {
            getData(){
                axios.get('/api/patients')
                .then(res => {
                   console.log(res.data)
                   this.genders = res.data.genders;
                   this.services = res.data.services;
                   this.patients = res.data.patients;
                }).catch(err => {
                alert(err);
            })
            },
             format_date(value){
                    if (value) {
                    return moment(String(value)).format('DDMMYYYY')
                    }
        },
            postData(){
                // post data
                axios({
                    method: 'post',
                    url: '/api/patients',
                    data: this.form
                    })
                .then(res => {
                   this.patients = res.data.patients;
                }).catch(err => {
                alert(err);
            })
        }
    }
    }
</script>