<template>
    <div>
        <main-section-header
                :criteria-title="criteriaTitle"
                :subCriteriaTitle="subCriteriaTitle"
                :super-sub-criteria-title="superSubCriteriaTitle"
                :instructions="instructions"
        >
        </main-section-header>

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
                        :total-unit="totalUnit"
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
                        :type="2"
                        :total-unit="totalUnit"
                >
                </remove-surcharge-reduced-form>
            </div>
            <div class="col-12">
                <remove-surcharge-standard-form
                        :table-id="tableId"
                        header-title="Scope 3 (Indirect: Embodies Carbon)"
                        header-color="background-color: #4fc47f; color: white"
                        total-label="Emission per activity for Scope 3 (transportation):"
                        template-data-model="transportation_of_material"
                        first-column-name="Transportation of Material"
                        third-column-name="Distance usage for one trip (km)"
                        fourht-column-name="Total distance (km)"
                        :productivity="productivity"
                        class="w-100"
                        v-model="scope_3_transportation"
                        :type="3"
                        :total-unit="totalUnit"
                >
                </remove-surcharge-standard-form>
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
      'totalUnit': {
        type: String,
        default: 'tCO2e/point'
      }
    }
  }
</script>
