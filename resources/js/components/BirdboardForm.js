import axios from "axios";

export default class BirdboardForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));
        Object.assign(this, data);
        this.submitted = false;
    }

    data() {
        return Object.keys(this.originalData)
            .reduce((data, attributes) => {
                data[attributes] = this[attributes]
                return data;
            }, {});
    }

    async post(endpoint) {
        return await this.submit(endpoint);
    }

    async patch(endpoint) {
        return await this.submit(endpoint, 'patch');
    }

    async delete(endpoint) {
        return await this.submit(endpoint, 'delete');
    }

    async get(endpoint) {
        return await this.submit(endpoint, 'get');
    }

    async submit(endpoint, requestType = 'post') {
        try {
            return this.OnSuccess(await axios[requestType](endpoint, this.data()));
        } catch (err) {
            this.onFail(err);
        }
    }

    onFail(error) {
        this.submitted = false;
        this.errors = {...error.response.data.errors};
        throw error;
    }

    reset() {
        Object.assign(this, this.originalData);
        this.errors.description = [];
        this.errors.title = [];
    }

    OnSuccess(response) {
        this.submitted = true;
        this.errors = {};
        return response;
    }
}
