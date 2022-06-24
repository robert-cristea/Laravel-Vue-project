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
                        :use-period-of-report="usePeriodOfReport"
                        :productivity-unit="productivityUnit"
                ></construction-header-form>
            </div>
            <div class="col-12">
                <remove-surcharge-standard-form
                        :table-id="tableId"
                        :productivity="productivity"
                        class="w-100"
                        v-model="scope_1_machinery"
                        total-unit="tCO2e/point"
                >
                </remove-surcharge-standard-form>
            </div>
            <div class="col-12">
                <remove-surcharge-reduced-form
                        :table-id="tableId"
                        :productivity="productivity"
                        header-title="Scope 3 (Indirect: Embodies Carbon)"
                        header-color="background-color: #4fc47f; color: white"
                        total-label="Emission per activity for Scope 3 (transportation):"
                        template-data-model="production_material_used"
                        first-column-name="Material Used"
                        second-column-name="Total of material used (kg)"
                        v-model="scope_3_material"
                        total-unit="tCO2e/point"
                        :type="2"
                >
                </remove-surcharge-reduced-form>
            </div>
            <div class="col-12">
                <div class="w-100">
                    <table>
                        <tr>
                            <td colspan="3">All Scopes</td>
                        </tr>
                        <tr>
                            <td>Emission per activity for all Scope:</td>
                            <td><input type="text" :value="grandTotal" disabled class="form-control"></td>
                            <td>t CO2e/{{ productivityUnit }}</td>
                        </tr>
                    </table>
                </div>
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
  import dataHandlingMixins from '../mixins/dataHandling.js'
  import BasicConstructionTemplate from './2.2.1.RemoveSurcharge.vue'
  export default {
    extends: BasicConstructionTemplate,
    props: {
      'usePeriodOfReport': {
        type: Boolean,
        default: false
      }
    }
  }
</script>
