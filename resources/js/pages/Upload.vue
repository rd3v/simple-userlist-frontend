<template>
    <div>
        <h3>Upload Photo</h3>
        <img :src="previewImage" alt="Avatar">
        <div class="input-group">
            <input type="file" name="profile_pic" @change="upload">
        </div>
        <button @click="submit">Upload</button>
    </div>
</template>
<script>
    export default {
        props: ['id'],
        data() {
            return {
                previewImage: null,
                profile_pic: null
            }
        },
        methods: {
            upload(e) {
                let profile_pic = e.target.files[0];
                this.previewImage = URL.createObjectURL(profile_pic);
                this.profile_pic = profile_pic;
            },
            submit() {
                let formData = new FormData();
                formData.append('profile_pic', this.profile_pic);

                axios.post('http://localhost:8000/api/users/photo/' + this.id, formData)
                    .then((response) => {
                        if (response.status === 200) {
                            this.$noty.success(response.data.message);
                            this.$router.push({
                                name: 'profile',
                                params: {id: this.id},
                            });
                        }
                    }).catch((error) => {
                        this.$noty.error(error.response.data.message);
                    }) 
            }
        }
    }
</script>