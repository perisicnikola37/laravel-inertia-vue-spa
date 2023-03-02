<template>
    <div>
        <AppLayout title="Edit role">
            Edit user: {{ user.name }}
        </AppLayout>
    </div>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    props: {
        user: Object,
    },
    components: { AppLayout }
}
</script>