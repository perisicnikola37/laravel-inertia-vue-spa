<template>
    <AppLayout title="User profile">
        <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
            <div class="max-w-lg w-full bg-white shadow-lg rounded-lg overflow-hidden">
                <img class="w-full h-64 object-cover" :src="user.coverImage" alt="User cover image">
                <div class="p-4">
                    <img class="h-24 w-24 rounded-full mx-auto mb-4" :src="user.profileImage" alt="User profile image">
                    <h1 class="text-2xl font-bold text-center">{{ getUser.name }}</h1>
                    <center>
                        <a :href="'mailto:' + getUser.email" class="text-gray-600 text-center">{{ getUser.email }}</a>
                    </center>
                    <hr class="my-4">
                    <div class="my-2">
                        <h2 class="text-gray-600 text-sm font-bold uppercase">About</h2>
                        <p class="mt-2 text-gray-600">{{ user.about }}</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
  
<script>
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {
        AppLayout
    },
    props: {
        getUser: Object
    },
    data() {
        return {
            user: {}
        }
    },
    mounted() {
        this.user = Object.assign(this.user, {
            profileImage: 'https://randomuser.me/api/portraits/men/10.jpg',
            coverImage: 'https://www.itnewsafrica.com/wp-content/uploads/2022/07/Software-Devs.jpg',
            about: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla at dictum est. Sed id lacus ut ipsum semper lobortis vel non metus. Duis sit amet orci metus. Suspendisse at leo est. Nullam tincidunt, tellus sed vestibulum scelerisque, nisl mauris varius mauris, in scelerisque mi orci eget tortor.',
        });
        this.$forceUpdate();
    }
}
</script>
