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
                        :productivity-unit="productivityUnit"
                ></construction-header-form>
            </div>
            <div class="col-12">
                <remove-surcharge-standard-form
                        :table-id="tableId"
                        :productivity="productivity"
                        class="w-100"
                        v-model="scope_1_machinery"
                        total-unit="tCO2e/km"
                >
                </remove-surcharge-standard-form>
            </div>
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
  import BasicConstructionTemplate from './2.2.1.RemoveSurcharge.vue'
  export default {
    extends: BasicConstructionTemplate
  }
</script>
