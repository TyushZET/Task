<template>
    <div>
        545454
    </div>
</template>

<script>
import {get} from "axios";

export default {
    name: "PostComponent",

    data(){
      return 5
    },

    mounted() {
        this.getPosts()
    },

    methods: {
        getPosts() {
            axios.get('api/test')
                .then(function data(){
                    console.log(5)
                })
        }
    }
}


</script>

<style scoped>

</style>
