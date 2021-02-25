<template>
    <modal
        @closed="form.reset()"
        name="new-project"
        classes="p-10 p-4 card bg-card rounded-lg"
        height="auto">
        <h1
            class="font-normal text-2xl mb-16 text-center"
        >Let's Start Something New</h1>
        <form @submit.prevent="submit">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm block mb-2">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="border p-2 text-sm block w-full rounded bg-card border-solid border-2 focus:outline-none focus:border-border-focus"
                            :class="form.errors.title && form.errors.title.length > 0 ? 'border-error' : 'border-border'"
                            v-model="form.title">
                        <span
                            class="text-sm italic text-error"
                            v-if="form.errors.title"
                        >{{ form.errors.title[0] }}</span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="text-sm block mb-2">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            class="border p-2 text-sm block w-full rounded bg-card border-solid border-2 focus:outline-none focus:border-border-focus"
                            :class="form.errors.description && form.errors.description.length > 0 ? 'border-error' : 'border-border'"
                            rows="7"
                            v-model="form.description"
                        ></textarea>
                        <span
                            class="text-sm italic text-error"
                            v-if="form.errors.description"
                        >{{ form.errors.description[0] }}</span>
                    </div>
                </div>
                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="text-sm block mb-2">Need Some Tasks?</label>
                        <input
                            type="text"
                            name="title"
                            class="border p-2 text-sm block w-full rounded mb-2 bg-card border-solid border-2 focus:outline-none border-border focus:border-border-focus"
                            placeholder="Task 1"
                            v-for="task in form.tasks"
                            v-model="task.body">
                    </div>

                    <button type="button" @click="addTask" class="inline-flex items-center text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="mr-2">
                            <g fill="none" fill-rule="evenodd" opacity=".307">
                                <path stroke="#000" stroke-opacity=".012" stroke-width="0" d="M-3-3h24v24H-3z"></path>
                                <path fill="#000" d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z"></path>
                            </g>
                        </svg>
                        <span>Add New Task Field</span>
                    </button>

                </div>
            </div>

            <footer class="flex justify-end">
                <button
                    type="button"
                    @click="$modal.hide('new-project'); form.reset();"
                    class="button-blue is-outlined mr-4"
                >Cancel</button>
                <button
                    class="button-blue"
                >Create Project</button>
            </footer>
        </form>
    </modal>
</template>

<script>
    import BirdboardForm from './BirdboardForm.js';
    export default {
        name: "NewProject.vue",
        data() {
            return {
                form: new BirdboardForm({
                    title: '',
                    description: '',
                    tasks: [
                        { body: '' }
                    ],
                    errors: {
                        description: [],
                        title: [],
                    },
                }),
            }
        },
        watch: {
            title() {
                this.form.errors.title = [];
            },
            description() {
                this.form.errors.description = [];
            }
        },
        computed: {
          title() {
              return this.form.title;
          },
          description() {
            return this.form.description;
          }
        },
        methods: {
            checkForEmptyForm() {
                if (this.form.title && this.form.description) {
                    return;
                }
                if (!this.form.description) {
                    this.form.errors.description.push('The description field is required.');
                }
                if (!this.form.title) {
                    this.form.errors.title.push('The title field is required.');
                }
                throw new Error('Please fill the required fields');
            },
            addTask() {
                this.form.tasks.push({ body: '' })
            },
             async submit() {
                try {
                    this.checkForEmptyForm();
                    if (! this.form.tasks[0].body) {
                        delete this.form.originalData.tasks;
                    }
                    const response = await this.form.post('/projects');
                    location = response.data.message;
                    this.loading = true;
                } catch (err) {
                    console.log(err);
                }
            }
        }
    }
</script>

<style scoped>

</style>
