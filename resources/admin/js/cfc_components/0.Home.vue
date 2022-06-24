<template>
    <div class="row">
        <h2>{{ criteriaTitle }}</h2>
        <h2>{{ subCriteriaTitle }}</h2>
        <h3>{{ superSubCriteriaTitle }}</h3>

        <div style="background-color: cyan;">
            {{ instructions }}
        </div>
    </div>
</template>

<script>
  import CfcMixins from '../mixins/dataHandling.js'
  import SaveProjectMixin from '../mixins/saveProject.js'
  export default {
    mixins: [CfcMixins, SaveProjectMixin],
  }
</script>
