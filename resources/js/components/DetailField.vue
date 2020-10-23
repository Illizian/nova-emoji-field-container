<template>
    <div>
        <div
            v-for="(child, index) in field.fields"
            :key="index"
        >
            <panel-item :field="child" />
        </div>
    </div>
</template>

<script>
    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],
    }
</script>
