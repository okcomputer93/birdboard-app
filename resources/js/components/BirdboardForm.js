import axios from "axios";

export default class BirdboardForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));
        Object.assign(this, data);
        this.errors = {};
        this.submitted = false;
    }

    data() {
        let data = {};

        for (let attribute in this.originalData) {
            data[attribute] = this[attribute];
        }

        return data;
    }

    async submit(endpoint) {
        try {
            this.OnSuccess(await axios.post(endpoint, this.data()));
        } catch (err) {
            this.onFail(err);
        }
    }

    onFail(error) {
        this.submitted = false;
        this.errors = error.response.data.errors;
        throw error;
    }

    reset() {
        Object.assign(this, this.originalData);
    }

    OnSuccess(response) {
        this.submitted = true;
        return response;
    }
}
