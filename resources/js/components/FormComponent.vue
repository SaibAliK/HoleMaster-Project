<template>
    <div class="container-fluid inner-from">
        <form class="row create_form_feild_inner mb-5">
            <div class="col-lg-12 mt-5">
                <h3>Create Form</h3>
            </div>

            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="form_name">Form Name</label>
                    <input
                        type="text"
                        v-model="formData.form_name"
                        placeholder="Form Name"
                        required
                    />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form_groups">
                    <label for="category">Category</label>
                    <input
                        type="text"
                        v-model="formData.category"
                        placeholder="Category"
                        required
                    />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form_groups mr-3">
                    <label for="stage">Stage</label><br />
                    <select name="stage" v-model="formData.stage" required>
                        <option value="" selected>Select Stage</option>
                        <option
                            v-for="(option, index) in this.stages"
                            :key="index"
                            :value="option.id"
                        >
                            {{ option.name }}
                        </option>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-lg-12 inner_table">
                    <h3>Form Builder</h3>
                </div>
            </div>

            <div class="box" v-for="(item, index) in this.formData.sections">
                <div class="col-lg-6">
                    <div class="form_groups">
                        <label for="form_name"
                            >Section Name --
                            <button
                                type="button"
                                class="btn btn-danger"
                                @click="deleteSection(index)"
                            >
                                Delete Section
                            </button>
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="addQuestion(index)"
                            >
                                ADD Question
                            </button>
                        </label>
                        <input
                            type="text"
                            v-model="item.section_name"
                            placeholder="Section Name"
                            required
                        />
                    </div>
                </div>

                <div v-for="(question_item, question_index) in item.questions">
                    <div class="col-lg-6">
                        <div class="form_groups">
                            <label for="question_type">Type</label>
                            <span>
                                --
                                <button
                                    type="button"
                                    class="btn btn-danger"
                                    @click="
                                        deleteQuestion(index, question_index)
                                    "
                                >
                                    Delete Question
                                </button>
                            </span>
                            <select
                                name="question_type"
                                v-model="question_item.question_type"
                                @change="
                                    selectQuestionType(
                                        index,
                                        question_index,
                                        question_item.question_type
                                    )
                                "
                                required
                            >
                                <option disabled value="">Select Type</option>
                                <option value="text_box">Text Box</option>
                                <option value="precaution">Text</option>
                                <option value="checkBox">Checkbox</option>
                                <option value="sign_box">Sign Box</option>
                                <option value="radio">Radio Button</option>
                                <option value="image">Image</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6" v-if="question_item.is_show_ques">
                        <div class="form_groups">
                            <label for="form_name">Question</label>
                            <input
                                type="text"
                                v-model="question_item.ques"
                                placeholder="Question"
                                required
                            />
                        </div>
                    </div>

                    <div class="col-lg-6" v-if="question_item.is_show_options">
                        <div
                            class="form_groups"
                            v-for="(
                                option_item, option_index
                            ) in question_item.options"
                        >
                            <div class="questionCheckbox">
                                <input
                                    type="checkbox"
                                    class="checkboxValue"
                                    v-model="option_item.is_checked"
                                /><br />
                                <input
                                    type="text"
                                    class="checkboxValue"
                                    v-model="option_item.value"
                                    placeholder="Enter new option"
                                />
                                <button
                                    type="button"
                                    @click="
                                        addMoreOptions(index, question_index)
                                    "
                                >
                                    <span>Add more</span>
                                </button>
                                <button
                                    type="button"
                                    @click="
                                        deleteOptions(
                                            index,
                                            question_index,
                                            option_index
                                        )
                                    "
                                >
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="col-lg-6"
                        v-if="question_item.is_show_precaution"
                    >
                        <div class="form_groups">
                            <label for="form_name">Text</label>
                            <input
                                type="text"
                                v-model="question_item.precaution"
                                placeholder="Precaution"
                                required
                            />
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form_groups">
                            <label for="form_name">Is Required</label>
                            <input
                                type="checkbox"
                                checked
                                v-model="question_item.is_requred"
                                placeholder=""
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="footer_button d-flex">
                    <button
                        type="button"
                        name="add_section"
                        value="add_section"
                        @click="addSection()"
                    >
                        Add Section
                    </button>
                    <button
                        type="button"
                        name="section_save"
                        value="section_save"
                        @click="submitForm()"
                    >
                        Save Form
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: ["form_id"],
    data() {
        return {
            form_id: this.form_id,
            stages: [],
            formData: {
                form_name: "",
                category: "",
                stage: "",
                form_id: 0,
                sections: [
                    {
                        section_name: "",
                        questions: [
                            {
                                question_type: "",
                                is_show_ques: true,
                                is_show_precaution: false,
                                is_show_options: false,
                                ques: "",
                                is_requred: "",
                                precaution: "",
                                options: [],
                            },
                        ],
                    },
                ],
            },
        };
    },
    mounted() {
        if (this.form_id != 0) {
            window.axios
                .get(`${window.Laravel.apiUrl}/get-form/${this.form_id}`)
                .then(
                    (response) => (
                        (this.formData.form_name = response.data.form_name),
                        (this.formData.category = response.data.category),
                        (this.formData.stage = response.data.stage_id),
                        (this.formData.form_id = response.data.id),
                        (this.formData.sections = response.data.sections.map(
                            (section, section_key) => {
                                return {
                                    section_name: section.section_name,
                                    questions: section.questions.map(
                                        (question, question_key) => {
                                            return {
                                                question_type: question.type,
                                                ques: question.question,
                                                is_requred:
                                                    question.is_required,
                                                precaution: question.precaution,
                                                is_show_ques:
                                                    question.type ==
                                                    "precaution"
                                                        ? false
                                                        : true,
                                                is_show_precaution:
                                                    question.type ==
                                                    "precaution"
                                                        ? true
                                                        : false,
                                                is_show_options:
                                                    question.type ==
                                                        "checkBox" ||
                                                    question.type == "radio"
                                                        ? true
                                                        : false,
                                                options: question.options.map(
                                                    (option) => {
                                                        return {
                                                            is_checked: false,
                                                            value: option.question_option,
                                                        };
                                                    }
                                                ),
                                            };
                                        }
                                    ),
                                };
                            }
                        ))
                    )
                );
        }
    },

    created() {
        window.axios
            .get(`${window.Laravel.apiUrl}/stages`)
            .then((response) => (this.stages = response.data));
    },

    methods: {
        addQuestion(section_id) {
            const check_section_exist = this.formData.sections[section_id];
            if (check_section_exist) {
                const new_question = {
                    question_type: "",
                    ques: "",
                    is_show_ques: true,
                    is_show_precaution: false,
                    is_show_options: false,
                    is_requred: "",
                    precaution: "",
                    options: [],
                };
                this.formData.sections[section_id].questions.push(new_question);
            }
        },

        deleteQuestion(section_id, question_id) {
            const check_section_exist = this.formData.sections[section_id];
            if (check_section_exist) {
                this.formData.sections[section_id].questions.splice(
                    question_id,
                    1
                );
            }
        },

        addSection() {
            const new_section = {
                section_name: "",
                questions: [
                    {
                        question_type: "",
                        ques: "",
                        is_requred: "",
                        precaution: "",
                        options: [],
                    },
                ],
            };
            this.formData.sections.push(new_section);
        },

        deleteSection(section_id) {
            const check_section_exist = this.formData.sections[section_id];
            if (check_section_exist) {
                this.formData.sections.splice(section_id, 1);
            }
        },

        selectQuestionType(section_id, question_id, selected_value) {
            const check_question_exist =
                this.formData.sections[section_id].questions[question_id];
            if (selected_value == "text_box") {
                check_question_exist.is_show_options = false;
                check_question_exist.is_show_precaution = false;
                check_question_exist.is_show_ques = true;
                check_question_exist.options = [];
            } else if (selected_value == "precaution") {
                check_question_exist.is_show_options = false;
                check_question_exist.is_show_precaution = true;
                check_question_exist.is_show_ques = false;
                check_question_exist.options = [];
            } else if (
                selected_value == "checkBox" ||
                selected_value == "radio"
            ) {
                check_question_exist.is_show_precaution = false;
                check_question_exist.is_show_ques = true;
                check_question_exist.is_show_options = true;
                if (this.form_id == 0) {
                    check_question_exist.options = [];
                    const new_option = {
                        is_checked: "",
                        value: "",
                    };
                    check_question_exist.options.push(new_option);
                }
            } else if (
                selected_value == "sign_box" ||
                selected_value == "image"
            ) {
                check_question_exist.is_show_options = false;
                check_question_exist.is_show_precaution = false;
                check_question_exist.is_show_ques = true;
                check_question_exist.options = [];
            } else {
                console.log("Others");
            }
        },

        addMoreOptions(section_id, question_id) {
            const check_question_exist =
                this.formData.sections[section_id].questions[question_id];
            const new_option = {
                is_checked: "",
                value: "",
            };
            check_question_exist.options.push(new_option);
        },

        deleteOptions(section_id, question_id, option_id) {
            const check_question_exist =
                this.formData.sections[section_id].questions[question_id];
            check_question_exist.options.splice(option_id, 1);
        },

        submitForm() {
            axios.post(`${window.Laravel.apiUrl}/form-submit`, this.formData).then((res) => {
                if (res.data.success == false) {
                    toastr.error("errors", res.data.message);
                } else {
                    if (res.data.status) {
                        window.location = `${window.Laravel.baseUrl}form`;
                    }
                }
            });
        },
    },
};
</script>

<style>
.box {
    transition: box-shadow 0.3s;
    border-radius: 10px;
    padding: 2%;
}
.box:hover {
    box-shadow: 0 0 11px rgba(33, 33, 33, 0.2);
}
</style>
