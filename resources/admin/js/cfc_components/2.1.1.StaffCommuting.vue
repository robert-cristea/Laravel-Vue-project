<template>
    <div>
        <h4>{{ criteriaTitle }}</h4>
        <h4>{{ subCriteriaTitle }}</h4>
        <h5>{{ superSubCriteriaTitle }}</h5>

        <div style="background-color: cyan;">
            {{ instructions }}
        </div>

        <div class="row">
            <div class="col-12">
                <construction-header-form
                        :table-id="tableId"
                        v-model="productivity"
                        use-period-of-report
                        with-existing-highway-percent
                ></construction-header-form>
            </div>
            <div class="col-12">
                <construction-staff-commuting-table
                        :table-id="tableId"
                        :productivity="productivity"
                        header-title="Scope 3 (Indirect: Embodies Carbon)"
                        header-color="background-color: #4fc47f; color: white"
                        class="w-100"
                        v-model="scope_1_sc"
                        :total-unit="totalUnit"
                        type="1"
                >
                </construction-staff-commuting-table>
            </div>
            <div><input type="hidden" :value="grandTotal"></div>
            <div class="col-12">
                <previous-next-button></previous-next-button>
            </div>
            <!--<div class="col-12 card construction-database">
                <construction-database
                        :table-id="tableId"
                        header-title="LLM database:"
                        header-color="background-color: white"
                        class="w-100"
                >
                </construction-database>
            </div>-->
        </div>
    </div>
</template>

<script>
  import dataHandlingMixins from '../mixins/dataHandling.js'
  import BasicConstructionTemplate from './2.2.1.RemoveSurcharge.vue'
  export default {
    extends: BasicConstructionTemplate,
    methods: {
      updateCarbonEmission () {
      },
      getRowCarbonEmission(i) {
      },
    }
  }
</script>
