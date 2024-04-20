<template>
    <div>
        <section>
            <h3>List of Users</h3>
            <router-link to="/user/create">Add User+</router-link>
            <ul>
                <li v-for="user in users" :key="user.id">
                    <img width="25px" :src="user.profile_pic ? 'http://localhost:8000/img/' + user.profile_pic:'https://api.dicebear.com/8.x/pixel-art/svg?seed=Gizmo'" alt="avatar">
                    <a href="" @click.prevent="lihatuser(user.id)">{{ user.name }}</a>
                </li>
            </ul>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users: [],
            }
        },
        watch: {
            '$route': 'getUsers',
        },
        mounted() {
            this.getUsers();
        },
        methods: {
            getUsers() {
                axios.get('http://localhost:8000/api/users').then((response) => {
                    this.users = response.data;
                });
            },
            profile_url(id) {
                return '/user/' + id;
            },
            lihatuser(id) {
                this.$router.push({
                    name: 'profile',
                    params: {id: id}
                })
            }
        }
    }
</script>