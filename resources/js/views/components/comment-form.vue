<template>
    <div class="flex flex-wrap">
        <h2 class="lg:px-4 pb-2 text-4 text-gray-800">Add a new comment</h2>
        <div class="w-full lg:px-3 mt-2 mb-2 md:w-full">
            <input
                v-model="commentFormData.name"
                type="text"
                class="w-full h-8 px-3 py-2 text-gray-800 font-medium leading-normal border-gray-400 rounded-lg resize-none border-1 focus:outline-none focus:ring-1 focus:indigo-500rounded focus:bg-white"
                placeholder="Name*"
                required
            />
            <error-alert
                :message="errors && errors['name'] ? errors['name'][0] : null"
            />
        </div>
        <div class="w-full lg:px-3 mt-2 mb-2 md:w-full">
            <textarea
                v-model="commentFormData.comment"
                class="w-full h-20 px-3 py-2 text-gray-800 font-medium leading-normal border-gray-400 rounded-lg resize-none border-1 focus:outline-none focus:ring-1 focus:indigo-500rounded focus:bg-white"
                name="body"
                placeholder="Type Your Comment"
                required
            ></textarea>

            <error-alert
                :message="
                    errors && errors['comment'] ? errors['comment'][0] : null
                "
            />
        </div>
        <div class="flex items-start justify-end w-full px-3 md:w-full">
            <div class="-mr-1">
                <button
                    class="px-12 py-1 font-bold text-white transition duration-500 ease-in-out rounded-lg focus:outline-none bg-secondary hover:bg-primary text-4"
                    @click="addComment"
                >
                    Send
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import ErrorAlert from "./error-alert.vue";

const props = defineProps({
    commentFormData: Object,
    comments: Array,
});
const emit = defineEmits(["fetchComments"]);

const errors = ref(null);

const addComment = async (id) => {
    try {
        await axios.post("/api/comment", props.commentFormData).then((res) => {
            if (res.data.success) {
                resetForm();
                emit("fetchComments", true);
            } else {
                console.log(res.data);
            }
        });
    } catch (err) {
        errors.value = err.response.data.error;
    }
};

const resetForm = () => {
    props.commentFormData.name = "";
    props.commentFormData.comment = "";
    props.commentFormData.parent_id = null;
    props.commentFormData.sub_parent_id = null;
};
</script>
