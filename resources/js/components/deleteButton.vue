<template>
    <div class="container">
        <div class="pb-3"><button class="btn btn-danger btn-sm" @click="deleteId">Delete Account</button></div>
    </div>
</template>

<script>
    export default {
        props: ['userId'],

        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            deleteId() {
                if (confirm("Are you sure you want to delete your account?")){
                    axios.delete('/user/'+ this.userId)
                    .then(response => {
                        console.log(response.data);
                    });
                }
            }
        },
    }
</script>
