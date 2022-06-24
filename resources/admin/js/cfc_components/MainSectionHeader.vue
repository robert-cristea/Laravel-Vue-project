<template>
    <div>
        <h4>{{ criteriaTitle }}</h4>
        <h4>{{ subCriteriaTitle }}</h4>
        <h5>{{ superSubCriteriaTitle }}</h5>

        <div><h5>&nbsp;</h5></div>
        <h5 v-if="printScopeOne">Scope 1: Direct Emissions</h5>
        <h5 v-if="printScopeTwo">Scope 2: Indirect Emissions</h5>
        <h5 v-if="printScopeThree">Scope 3: Other Indirect Emissions</h5>
        <div style="background-color: cyan;">
            {{ instructions }}
        </div>
    </div>
</template>

<script>
  export default {
    props: {
      'tableId': {
        type: String,
        default: ''
      },
      'id': {
        type: String,
        default: ''
      },
      'type': {
        type: Number,
        default: 1
      },
      'criteriaTitle': {
        type: String,
        default: ''
      },
      'subCriteriaTitle': {
        type: String,
        default: ''
      },
      'superSubCriteriaTitle': {
        type: String,
        default: ''
      },
      'instructions': {
        type: String,
        default: ''
      },
      'printScopeOne': {
        type: Boolean,
        default: false
      },
      'printScopeTwo': {
        type: Boolean,
        default: false
      },
      'printScopeThree': {
        type: Boolean,
        default: false
      }
    }
  }
</script>
