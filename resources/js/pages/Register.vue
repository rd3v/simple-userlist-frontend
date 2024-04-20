<template>
    <div>
        <h3>Register</h3>
        <form @submit.prevent="handleSubmit" action="" method="post">
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

            <button type="submit">Register</button>
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
            handleSubmit() {
                axios.post('http://localhost:8000/api/users', this.form)
                    .then((response) => {
                        if(response.data.status) {
                            this.$noty.success(response.data.message);
                            this.$router.push({name: 'user'});
                        }
                    })
                    .catch((error) => {
                        if(error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            }
        }
    }
</script>

<style>
    .input-group {
        margin-bottom: 5px;
    }
</style>