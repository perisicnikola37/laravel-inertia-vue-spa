<template>
    <div>
        <AppLayout title="Edit role">
            Edit role: {{ role.name }}
        </AppLayout>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    props: {
        role: Object,
    },
    components: { AppLayout }
}
</script>