<template>
    <div>
        product component
        <p>{{ message }}</p>
    </div>
</template>

<script>
export default {
    props: {
        message: {
        },
    },
    mounted() {
        console.log("Component mounted");
    },
};
</script>
