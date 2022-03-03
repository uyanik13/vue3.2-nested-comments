<template>
    <div
        class="max-w-screen-sm pb-2 lg:mx-4 lg:my-3 flex lg:justify-center items-center"
    >
        <div
            class="flex max-w-xl my-10 bg-gray-100 shadow-md rounded-lg overflow-hidden mx-auto"
        >
            <div class="flex items-center w-full">
                <div class="w-full">
                    <div class="border-b border-gray-100"></div>
                    <div
                        class="text-gray-400 font-medium text-sm mb-7 mt-6 mx-3 px-2"
                    >
                        <img
                            class="rounded"
                            src="https://picsum.photos/536/354"
                        />
                    </div>
                    <div
                        class="text-gray-600 font-semibold text-lg mb-2 mx-3 px-2"
                    >
                        Ogur Uyanik Aloware 3 layer nested comment system
                    </div>
                    <div class="text-gray-500 font-thin text-sm mb-6 mx-3 px-2">
                        Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500
                    </div>

                    <div class="flex w-full border-t border-gray-100">
                        <div class="mt-3 mx-5 flex flex-row">
                            <div
                                class="flex text-gray-700 font-normal text-sm rounded-md mb-2 mr-4 items-center"
                            >
                                Comments:
                                <div
                                    class="ml-1 text-gray-600 text-xs font-semibold"
                                >
                                    {{ comments.length }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-col w-full border-gray-100"
                        ref="scroll"
                    >
                        <div v-for="comment in comments" :key="comment.id">
                            <!-- If Parent Id not exist -->
                            <div v-if="!comment.parent_id">
                                <div
                                    class="flex-1 px-2 leading-relaxed border rounded-lg sm:px-6"
                                >
                                    <div class="">
                                        <span class="font-semibold">{{
                                            comment.name
                                        }}</span>

                                        <p class="text-sm font-light">
                                            {{ comment.comment }}
                                        </p>
                                        <span class="text-xs text-gray-400">{{
                                            getDate(comment.created_at)
                                        }}</span>
                                        <div
                                            class="flex my-2 text-xs text-gray-600"
                                        >
                                            <button
                                                class="flex items-center mr-4"
                                                @click="addParentId(comment.id)"
                                            >
                                                <svg
                                                    class="mr-2"
                                                    width="24"
                                                    height="24"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        class="text-gray-500 fill-current hover:text-gray-900"
                                                        d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.045.286.12.403.143.225.385.347.633.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.368-3.43-7.788-7.8-7.79zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.334-.75-.75-.75h-.395c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"
                                                    />
                                                </svg>

                                                <span>{{
                                                    comment.replies
                                                        ? comment.replies.length
                                                        : 0
                                                }}</span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Layer 1 Comment Form -->
                                    <comment-form
                                        v-if="
                                            commentForm.parent_id &&
                                            commentForm.sub_parent_id == null &&
                                            commentForm.parent_id == comment.id
                                        "
                                        @fetchComments="fetchComments"
                                        :comment-form-data="commentForm"
                                    />

                                    <h4
                                        class="my-1 mx-4 text-xs font-bold tracking-wide text-gray-400 uppercase"
                                    >
                                        Replies
                                    </h4>

                                    <div v-if="comment.replies">
                                        <div
                                            v-for="subComment in comment.replies"
                                            :key="subComment.id"
                                        >
                                            <div
                                                class="flex-1 px-4 leading-relaxed bg-gray-100 rounded-lg sm:px-6 sm:py-4"
                                                v-if="!subComment.sub_parent_id"
                                            >
                                                <strong>{{
                                                    subComment.name
                                                }}</strong>
                                                <p class="text-xs sm:text-sm">
                                                    {{ subComment.comment }}
                                                </p>
                                                <span
                                                    class="text-xs text-gray-400"
                                                    >{{
                                                        getDate(
                                                            subComment.created_at
                                                        )
                                                    }}</span
                                                >
                                                <div
                                                    class="flex my-2 text-xs text-gray-600"
                                                >
                                                    <button
                                                        class="flex items-center mr-4"
                                                        @click="
                                                            addSubParentId(
                                                                comment.id,
                                                                subComment.id
                                                            )
                                                        "
                                                    >
                                                        <svg
                                                            class="mr-2"
                                                            width="24"
                                                            height="24"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                class="text-gray-500 fill-current hover:text-gray-900"
                                                                d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.045.286.12.403.143.225.385.347.633.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.368-3.43-7.788-7.8-7.79zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.334-.75-.75-.75h-.395c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Layer 2 Comment Form -->
                                            <comment-form
                                                v-if="
                                                    commentForm.sub_parent_id &&
                                                    commentForm.sub_parent_id ==
                                                        subComment.id
                                                "
                                                @fetchComments="fetchComments"
                                                :comment-form-data="commentForm"
                                            />

                                            <div
                                                class="flex-1 ml-8 mt--2 bg-gray-100 rounded-lg sm:px-6 sm:py-4"
                                                v-if="subComment.sub_parent_id"
                                            >
                                                <strong>{{
                                                    subComment.name
                                                }}</strong>
                                                <p class="text-xs sm:text-sm">
                                                    {{ subComment.comment }}
                                                </p>
                                                <span
                                                    class="text-xs text-gray-400"
                                                    >{{
                                                        getDate(
                                                            subComment.created_at
                                                        )
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="relative border-t-1 border-gray-300 flex items-center self-center w-full max-w-xl p-4 overflow-hidden text-gray-600 focus-within:text-gray-400"
                    >
                        <comment-form
                            @fetchComments="fetchComments"
                            :comments="comments"
                            :comment-form-data="commentForm"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import CommentForm from "./components/comment-form.vue";

const commentForm = ref({
    comment: null,
    name: null,
    parent_id: null,
    sub_parent_id: null,
});
const comments = ref([]);

const scroll = ref(null);

onMounted(async () => {
    getAllComments();
});

const addParentId = (id) => {
    if (!commentForm.parent_id) {
        commentForm.value.parent_id = id;
    } else {
        commentForm.value.parent_id = null;
    }
};
const addSubParentId = (parentId, subParentId) => {
    if (!commentForm.sub_parent_id) {
        commentForm.value.parent_id = parentId;
        commentForm.value.sub_parent_id = subParentId;
    } else {
        commentForm.value.parent_id = null;
        commentForm.value.sub_parent_id = null;
    }
};

const fetchComments = (isFetch) => {
    if (isFetch) {
        getAllComments();
    }
    scroll.value.scrollIntoView({ behavior: "smooth", block: "end" });
};

const getAllComments = async () => {
    await axios
        .get(`/api/comment`)
        .then((res) => {
            if (res.data.success) {
                comments.value = res.data.data;
            }
        })
        .catch((err) => {
            console.log(err);
        });
};

const getDate = (date) => {
    const dateFormat = new Date(date);
    const dateFormat1 =
        dateFormat.toLocaleDateString("tr", {
            weekday: "short",
            year: "numeric",
            month: "short",
            day: "numeric",
        }) +
        " " +
        dateFormat.toLocaleTimeString("tr", {
            hour: "numeric",
            minute: "numeric",
        }); // toLocaleTime("tr-TR").substring(-3, 5);
    return dateFormat1;
};

const loadMore = () => {};
</script>
