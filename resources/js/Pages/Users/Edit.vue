<template>
    <AppLayout title="Edit user">

        <template #header>
            <Breadcrumb :href="'users'" :title="'Users'" :property="user" />
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="m-auto w-full max-w-xs">
                    <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <input v-model="form.name"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" type="text">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                E-mail
                            </label>
                            <input v-model="form.email"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" type="email">
                        </div>

                        <div class="flex items-center justify-between">
                            <Button :form="form"></Button>
                        </div>
                    </form>
                    <p class="text-center text-gray-500 text-xs">
                        &copy;2022 - <a class="text-blue-500" href="https://github.com/perisicnikola37"
                            target="_blank">@perisicnikola37</a>
                    </p>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Breadcrumb from "@/Components/Breadcrumb.vue";
import Button from "@/Components/Button.vue";

export default {
    components: {
        AppLayout,
        Breadcrumb,
        Button
    },
    props: {
        user: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
            })
        }
    },
    methods: {
        submit() {
            this.form.put(this.route('users.update', this.user.id), {
                _token: this.$page.props.csrf_token,
            })
        }
    }
}
</script>