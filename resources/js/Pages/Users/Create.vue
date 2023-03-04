<template>
    <AppLayout title="Create user">

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create user
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="m-auto w-full max-w-xs">

                    <form @submit.prevent="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 m-auto">

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.name"
                                class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name" type="text">
                            <span class="text-red-500">{{ errors.name }}</span>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                                E-mail <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.email"
                                class="mb-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email" type="email">
                            <span class="text-red-500">{{ errors.email }}</span>
                        </div>

                        <div class="mb-4">
                            <div class="mb-3 xl:w-96">
                                <select disabled v-model="form.role_id"
                                    class="form-select appearance-none block text-base font-normal text-gray-700  bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    aria-label="Default select example">
                                    <option value="2">Subscriber</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input v-model="form.password"
                                class="mb- 2shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="password" type="password">
                            <span class="text-red-500">{{ errors.password }}</span>
                        </div>

                        <div class="flex items-center justify-between">
                            <Button :form="form"></Button>
                        </div>
                    </form>

                    <p class="text-center text-gray-500 text-xs">
                        &copy;2023 - <a class="text-blue-500" href="https://github.com/perisicnikola37"
                            target="_blank">@perisicnikola37</a>
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Button from '@/Components/Button.vue';

export default {
    components: {
        AppLayout,
        Button,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                role_id: 2,
                password: '',
            })
        }
    },
    methods: {
        submit() {
            this.form.post(this.route('users.store'), {
                _token: this.$page.props.csrf_token,
            });
        }
    }
}
</script>