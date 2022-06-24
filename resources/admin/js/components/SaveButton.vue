<template>
    <div class="w-100">
        <div class="float-right">
            <button type="button" class="btn btn-primary" v-on:click="saveProject">Save</button>
        </div>
    </div>
</template>

<script>
  import SaveProjectMixin from '../mixins/saveProject.js'
  export default {
    mixins: [SaveProjectMixin],
  }
</script>
