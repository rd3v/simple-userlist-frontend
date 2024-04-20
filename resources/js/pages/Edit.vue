<template>
    <div>
        <h1>Edit User</h1>
        <form @submit.prevent="handleUpdate" action="" method="post">
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" v-model="form.name">
                <div class="error" v-if="errors.name">
                    <span>{{ errors.name[0] }}</span>
                </div>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="text" v-model="form.email">
                <div class="error" v-if="errors.email">
                    <span>{{ errors.email[0] }}</span>
                </div>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="text" v-model="form.password">
                <div class="error" v-if="errors.password">
                    <span>{{ errors.password[0] }}</span>
                </div>
            </div>

            <router-link :to="{name: 'profile', params: {id: this.id}}">Back</router-link>
            <button type="submit">Update</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                form: {
                    name: '',
                    email: '',
                    password: ''
                },
                errors: {},
            }
        },
        methods: {
            handleUpdate() {
                axios.put('http://localhost:8000/api/users/' + this.id, this.form)
                    .then((response) => {
                        if(response.data.status) {
                            this.$noty.success(response.data.message);
                            this.$router.push({name: 'profile'});
                        }
                    })
                    .catch((error) => {
                        if(error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            },
            getUser() {
                axios.get('/api/users/' + this.id)
                    .then((response) => {
                        this.form = {
                            name: response.data.name,
                            email: response.data.email,
                            password: response.data.password,
                        }
                    })
                    .catch((error) => console.log(error));
            }
        },
        mounted() {
            this.getUser();
        }
    }
</script>

<style>
    .input-group {
        margin-bottom: 5px;
    }
</style>