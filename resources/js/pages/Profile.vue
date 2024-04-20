<template>
    <div>
        <section>
            <img style="display: inline;" width="50px" :src="detailUser.profile_pic ? 'http://localhost:8000/img/' + detailUser.profile_pic:'https://api.dicebear.com/8.x/pixel-art/svg?seed=Gizmo'" alt="Avatar">
            <h3 style="display: inline;">Hello {{ detailUser.name }}</h3>
            <h3>Email: <strong>{{ detailUser.email }}</strong></h3>
            <router-link :to="{name: 'user'}">Back</router-link>
            <router-link :to="{name: 'upload', params: {id: detailUser.id}}">Upload Foto Profile</router-link>
            <a href="" @click.prevent="deleteUser">Hapus</a>
            <router-link :to="{name: 'user-edit', params: {id: this.id}}">Edit</router-link>
        </section>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                detailUser: {},
            }
        },
        watch: {
            '$route': 'getUser'
        },
        mounted() {
            this.getUser();
        },
        methods: {
            getUser() {
                axios.get('http://localhost:8000/api/users/' + this.id).then((response) => {
                    this.detailUser = response.data;
                });
            },
            deleteUser() {
                if(confirm(`Hapus user ${this.detailUser.name} ?`)) {
                    axios.delete('http://localhost:8000/api/users/' + this.id).then((response) => {
                        if(response.data.status) {
                            this.$noty.success(response.data.message);
                            this.$router.push({name: 'user'});
                        } else {
                            this.$noty.error(response.data.message);
                        }
                    }).catch((error) => {
                        this.$noty.error(error.response.data.errors);
                    });
                }
            }
        }
    }
</script>