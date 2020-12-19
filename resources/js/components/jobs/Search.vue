<template>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Select an option to search</div>
            <form class="pl-3">
                <div class="form-row align-items-center">
                    <div class="col-sm-3 my-2">
                        <label class="sr-only" for="position">Position</label>
                        <input type="text" v-model="job.position" class="form-control" id="position"
                               placeholder="Laravel developer">
                    </div>
                    <div class="col-sm-3 my-2">
                        <label class="sr-only" for="salary">Salary</label>
                        <input type="number" v-model="job.salary" class="form-control" id="salary"
                               placeholder="10000">
                    </div>
                    <div class="col-auto my-2">
                        <button type="submit" @click.prevent="search" :disabled="loading" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                </div>
            </form>

            <div class="container-fluid">
                <div class="progress" v-if="loading">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                         aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                </div>

                <div class="card text-center pb-2" v-for="job in jobs" :key="jobs.id" v-else>
                    <div class="card-header">
                        {{ job.position }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ job.salary }}</h5>
                        <p class="card-text">{{ job.requirements }}</p>
                        <a :href="job.vacancy_link" class="btn btn-primary" target="_blank">Go resource</a>
                    </div>
                    <div class="card-footer text-muted">
                        <p>{{ job.organization }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Search",
    data() {
        return {
            loading: false,
            job: {
                position: '',
                salary: ''
            },
            jobs: []
        }
    },
    methods: {
        async search() {
            this.loading = true;
            let {data} = await axios.get(
                `/api/jobs/search?filter[position]=${this.job.position}&filter[salary]=${this.job.salary}`);
            this.jobs = data;
            this.loading = false;
        }
    }
}
</script>

<style scoped>

</style>
