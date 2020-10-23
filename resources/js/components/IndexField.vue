<template>
    <div>
        <div
            v-for="(child, index) in field.fields"
            :key="index"
        >
            <span>{{ field.value }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
